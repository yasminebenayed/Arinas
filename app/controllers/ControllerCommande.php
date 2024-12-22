<?php

require_once __DIR__ . '/../models/ModelProduit.php';
require_once __DIR__ . '/../models/ModelDetailCommande.php';
require_once __DIR__ . '/../models/ModelUser.php';
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/ModelCommande.php';
require_once __DIR__ . '/../models/ModelPanier.php';
require_once __DIR__ . '/../controllers\ControllerHome.php';




class ControllerCommande 
{
    private $model;

    public function __construct()
    {
        $db = Database::getInstance()->getConnection();
        $this->model = new ModelCommande($db);
    }

    public function index()
    {$userCode = $_SESSION["user_id"];
        $produits = $this->model->getCommande($userCode); // Passez l'argument $userCode ici
        include("app/views/Commande/Commande.php");
    }

    public function getCommande()
    {
        $userCode = $_SESSION["user_id"];
        $produits = $this->model->getProduit($userCode);
        include("app/views/Commande/Commande.php");
        return $produits;
    }

    public function create()
    {
        ControllerHome::loggedOnly();
        $db = Database::getInstance()->getConnection();
        include("app/views/Commande/commande.php");
    }
    public function createCommande()
    {
        $userCode = $_SESSION["user_id"];
        $db = Database::getInstance()->getConnection();
        $panier = new ModelPanier($db);
        $produit = new ModelProduit($db);
        $produits = $panier->getCartProducts($userCode);

        if (isset($_POST['commander'])) {
            $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
            $pays = isset($_POST["pays"]) ? $_POST["pays"] : "";
            $ville = isset($_POST["ville"]) ? $_POST["ville"] : "";
            $code_postal = isset($_POST["code_postal"]) ? $_POST["code_postal"] : "";
            $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
            $payment_method = isset($_POST["paymentMethod"]) ? $_POST["paymentMethod"] : "";
            $status = ($payment_method == 'Carte de crédit') ? 'Accepté' : 'En cours';
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $userCode = $_SESSION["user_id"];
            $montant_total = $panier->getMontantTotal($userCode);
            $current_date = date('Y-m-d H:i:s');
            $data = [
                'code_client' => $userCode,
                'status' => $status,
                'montant' => $montant_total,
                'date' => $current_date,
                'adresse_livraison' => $adresse
            ];

            $this->model->create($data);

            $total_quantity = 0;
            $total_amount = 0;
            $last_inserted_id = $db->lastInsertId();

            foreach ($produits as $p) {
                $sous_total = ($p->prix * (100 - $p->promotion) / 100) * $p->qte;
                $total_quantity += $p->qte;
                $total_amount += $sous_total;
                $detailsData = [
                    'code_commande' => $last_inserted_id,
                    'code_produit' => $p->code,
                    'quantite' => $p->qte,
                    'sous_total' => $sous_total
                ];
                $details = new ModelDetailCommande($db);
                $details->create($detailsData);
                $currentQuantity = $produit->getCurrentQuantity($p->code); // Récupère la quantité actuelle
                $newQuantity = $currentQuantity - $p->qte; // Calcule la nouvelle quantité
                if ($newQuantity < 0) {
                    $newQuantity = 0; // Assure que la quantité ne devienne jamais négative
                }
                $produit->update($p->code, ['qte' => $newQuantity]); // Met à jour la nouvelle quantité
                                $panier->deleteCart($userCode, $p->code);
            }
            
            $this->displayOrderConfirmationModal($produits,$nom,$status, $email, $adresse, $ville, $pays, $code_postal, $payment_method, $total_quantity, $total_amount,$montant_total);
            header("Location: index.php?action=produit");
            exit();
        }
        #header("Location: indexcreatecommande.php");

    }

    public function displayOrderConfirmationModal($produits,$nom,$status, $email, $adresse, $ville, $pays, $code_postal, $payment_method, $total_quantity, $total_amount,$montant_total)
    {
        $productDetailsHTML = '';
        foreach ($produits as $p) {
            $sous_total = ($p->prix * (100 - $p->promotion) / 100) ;
            $productDetailsHTML .= "{$p->nomProduit} - {$p->qte} x {$sous_total} TND<br>";
        }
        $paymentMethod = $_POST["paymentMethod"];
        $paidAmount = $montant_total + 7;

        $placeholders = array(
            '{PRODUCT_DETAILS}',
            '{TOTAL_AMOUNT}',
            '{PAID_AMOUNT}',
            '{PAYMENT_METHOD}'
        );

        $replaceValues = array(
            $productDetailsHTML,
            $total_amount,
            $paidAmount,
            $paymentMethod
        );

        echo "<script>
            var totalAmount = {$total_amount};
            var paymentMethod = '{$paymentMethod}';
            var paidAmount = {$paidAmount};
            console.log('Valeur de totalAmount :', totalAmount);
            console.log('Valeur de paymentMethod :', paymentMethod);
            console.log('Valeur de paidAmount :', paidAmount);


            function replacePlaceholders(content) {
            var placeholders = " . json_encode($placeholders) . ";
            var replaceValues = " . json_encode($replaceValues) . ";

            for (var i = 0; i < placeholders.length; i++) {
                content = content.replace(placeholders[i], replaceValues[i]);
            }
            return content;
            }

            function submitMail(content) {
            Email.send({
                SecureToken: '236674ad-6c21-4da6-aab1-b2cdbddb79a6',
                To: '{$email}',
                From: 'mounabenayed5@gmail.com',
                Subject: 'Confirmation de paiement de votre commande chez Arinas',
                Body: content
            }).then(
                message => alert(message)
            );
            }

            function openOrderModal() {
            if ('$status' === 'Accepté') {
                var mailContentURL = 'index.php?url=mail';
                fetch(mailContentURL)
                .then(response => response.text())
                .then(content => {
                    content = replacePlaceholders(content);
                    submitMail(content);
                })
                .catch(error => console.error('Error fetching email content:', error));
            }

            document.getElementById('orderQuantity').innerText = '{$total_quantity}';
            document.getElementById('orderAmount').innerText = '{$total_amount}';
            document.getElementById('orderName').innerText = '{$nom}';
            document.getElementById('orderEmail').innerText = '{$email}';
            document.getElementById('orderAddress').innerText = '{$adresse}, {$ville}, {$pays}, {$code_postal}';
            document.getElementById('orderPayment').innerText = '{$payment_method}';

            document.getElementById('orderModal').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            document.body.classList.add('overlay-active');
            }

            function closeOrderModal() {
            document.getElementById('orderModal').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
            document.body.classList.remove('overlay-active');
            }

            window.onload = openOrderModal;
    </script>";
    }
}
?>