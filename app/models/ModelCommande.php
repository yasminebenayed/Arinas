<?php
require_once("Model.php");

class ModelCommande extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'commande');

    }
    public function index()
    {
        $controller = "Commande";
        include("app/views/Panier/Commande.php");
    }
    public function addCommande($userCode, $productCode)
    {
        try {
            $sql = "INSERT INTO $this->table (code_user, code_produit, qte) VALUES (:userCode, :productCode, 1)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode, 'productCode' => $productCode]);
        } catch (PDOException $e) {
            die("Error adding product to cart: " . $e->getMessage());
        }
    }
    public function getProduit($userCode)
    {
        $sql = "SELECT produit.*, panier.qte, categorie.nomCategorie AS nom_cat
                        FROM produit
                        JOIN panier ON produit.code = panier.code_produit
                        JOIN categorie ON produit.code_categorie = categorie.code
                        WHERE panier.code_user = :user_id";
        $stmt4 = $this->db->prepare($sql);
        $stmt4->execute(['user_id' => $userCode]);
        return $stmt4->fetchAll(PDO::FETCH_OBJ);
    }
    public function getCommande($userCode)
    {
        $sql = "SELECT produit.*, panier.qte, categorie.nomCategorie AS nom_cat
                        FROM produit
                        JOIN panier ON produit.code = panier.code_produit
                        JOIN categorie ON produit.code_categorie = categorie.code
                        WHERE panier.code_user = :user_id";
        $stmt4 = $this->db->prepare($sql);
        $stmt4->execute(['user_id' => $userCode]);
        return $stmt4->fetchAll(PDO::FETCH_OBJ);
    }
    public function updatecom($code, $data)
    { //pour creeer UPDATE table_name SET name = :name, age = :age WHERE code = :code
        try {
            $data['code'] = $code;//recupere l'id 
            $columns = array_keys($data); //recupere les keys de data
            $sets = [];//bech y7ot fiha name = :name, age = :age
            $i = 0;
            foreach ($columns as $column) {
                $sets[$i] = "$column = :$column";
                $i++;
            }
            $setString = implode(', ', $sets);
            $sql = "UPDATE $this->table SET $setString WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
        } catch (PDOException $e) {
            die("Error updating data: " . $e->getMessage());
        }
    }
    

}
?>