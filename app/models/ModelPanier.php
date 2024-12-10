<?php
require_once("Model.php");

class ModelPanier extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'panier');
    }

    public function isProductInCart($userCode, $productCode)
    {
        try {
            $sql = "SELECT COUNT(*) FROM $this->table WHERE code_user = :userCode AND code_produit = :productCode";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode, 'productCode' => $productCode]);
            return $stmt->fetchColumn() >= 1;
        } catch (PDOException $e) {
            die("Error checking if product is in cart: " . $e->getMessage());
        }
    }
    public function getProductFromCart($userCode, $productCode)
{
    try {
        // SQL query to check if the product exists in the user's cart
        $sql = "SELECT * FROM panier WHERE code_user = :userCode AND code_produit = :productCode";  // Correction ici
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['userCode' => $userCode, 'productCode' => $productCode]);
        
        // Fetch the product if it exists
        $product = $stmt->fetch(PDO::FETCH_OBJ);
        
        return $product ? $product : null; // Return the product object or null if not found
    } catch (PDOException $e) {
        die("Error retrieving product from cart: " . $e->getMessage());
    }
}



    public function updateQuantity($userCode, $productCode)
    {
        try {
            $sql = "UPDATE $this->table SET qte = qte + 1 WHERE code_user = :userCode AND code_produit = :productCode";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode, 'productCode' => $productCode]);
        } catch (PDOException $e) {
            die("Error updating quantity in cart: " . $e->getMessage());
        }
    }
    public function updateQuantitymoins($userCode, $productCode)
    {
        try {
            $sql = "UPDATE $this->table SET qte = qte -1 WHERE code_user = :userCode AND code_produit = :productCode";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode, 'productCode' => $productCode]);
        } catch (PDOException $e) {
            die("Error updating quantity in cart: " . $e->getMessage());
        }
    }

    public function addToCart($userCode, $productCode, $qte)
    {
        try {
            $sql = "INSERT INTO $this->table (code_user, code_produit, qte) VALUES (:userCode, :productCode, :qte)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode, 'productCode' => $productCode, 'qte' => $qte]);
        } catch (PDOException $e) {
            die("Error adding product to cart: " . $e->getMessage());
        }
    }
    public function deleteProduct($userCode, $productCode)
    {
            $query = "DELETE FROM panier WHERE code_user = :userCode AND code_produit = :productCode";
            $stmt = $this->db->prepare($query);

            // Lier les paramètres
            $stmt->bindParam(':userCode', $userCode, PDO::PARAM_INT);
            $stmt->bindParam(':productCode', $productCode, PDO::PARAM_INT);

            // Exécuter la requête
            $stmt->execute();

            
       
    }

    public function getCartProducts($userCode)
    {
        try {
            $sql = "SELECT produit.*, panier.qte, categorie.nomCategorie AS nom_cat
            FROM produit
            JOIN panier ON produit.code = panier.code_produit
            JOIN categorie ON produit.code_categorie = categorie.code
            WHERE panier.code_user = :userCode";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error getting cart products: " . $e->getMessage());
        }
    }
    public function getMontantTotal($userCode)
    {
        $produits = $this->getCartProducts($userCode);
        $total = 0;
        foreach ($produits as $produit) {
            $total += $produit->prix * $produit->qte;
        }
        return $total;
    }
    public function deleteCart($userCode, $productCode)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE code_user = :userCode AND code_produit = :productCode";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode, 'productCode' => $productCode]);
        } catch (PDOException $e) {
            die("Error deleting cart: " . $e->getMessage());
        }
    }

}
?>
