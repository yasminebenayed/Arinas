<?php
require_once 'app/models/Model.php';
class ModelProduit extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'produit');
    }
    public function findAll()
    {

        try {
            $sql = "SELECT produit.*, categorie.nomCategorie AS categorie_nom FROM produit
            JOIN categorie ON produit.code_categorie = categorie.code";
            ;
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function create($data)
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO produit($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die("Error creating data: " . $e->getMessage());
        }
    }
    public function delete($code)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $code]);
        } catch (PDOException $e) {
            die("Error deleting data: " . $e->getMessage());
        }
    }
    public function update($code, $data)
    {
        try {
            $data['code'] = $code;
            $columns = array_keys($data);
            $sets = [];
            $i = 0;
            foreach ($columns as $column) {
                $sets[$i] = "$column = :$column";
                $i++;
            }
            $setString = implode(', ', $sets);
            $sql = "UPDATE produit SET $setString WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
        } catch (PDOException $e) {
            die("Error updating data: " . $e->getMessage());
        }
    }
    public function getCurrentQuantity($productCode)
{
    $query = $this->db->prepare("SELECT qte FROM produit WHERE code = :code");
    $query->execute(['code' => $productCode]);
    return $query->fetchColumn();
}

    public function findByDesignation($c)
    {
        $query = "SELECT produit.*, categorie.nom AS categorie_nom FROM produit
        JOIN categorie ON produit.code_categorie = categorie.code
         WHERE designation LIKE :term";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':term' => "%$c%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function rechercher($search_query)
    {
        $req_search = "
            SELECT produit.*, 
                   categorie.nomCategorie AS nom_cat, 
                   marque.nomMarque AS nom_mar, 
                   sous_categorie.nom_sous_cat AS nom_sous_cat
            FROM produit
            JOIN categorie ON produit.code_categorie = categorie.code
            JOIN sous_categorie ON produit.code_sous_cat = sous_categorie.code
            JOIN marque ON produit.code_marque = marque.code
            WHERE nomProduit LIKE :search_query 
               OR description LIKE :search_query 
               OR categorie.nomCategorie LIKE :search_query 
               OR marque.nomMarque LIKE :search_query 
               OR sous_categorie.nom_sous_cat LIKE :search_query
        ";
    
        $stmt_search = $this->db->prepare($req_search);
        $stmt_search->execute(['search_query' => $search_query . '%']);  // Le % permet de trouver tous les produits qui commencent par la lettre
        return $stmt_search->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getCategoryProducts($category_id)
    {
        $req_categorie_product = "SELECT produit.*, categorie.nomCategorie AS categorie_nom 
                                  FROM produit
                                  JOIN categorie ON produit.code_categorie = categorie.code
                                  WHERE produit.code_categorie = :category_id";

        $stmt_category_products = $this->db->prepare($req_categorie_product);
        $stmt_category_products->execute(['category_id' => $category_id]);

        return $stmt_category_products->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoryInfo($category_id)
    {
        $req_category = "SELECT sous_categorie.code, sous_categorie.nom_sous_cat AS sous_cat_nom 
                         FROM sous_categorie
                         WHERE sous_categorie.code_categorie = :category_id";

        $stmt_category = $this->db->prepare($req_category);
        $stmt_category->execute(['category_id' => $category_id]);

        return $stmt_category->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryIdByName($name)
{
    // Exemple de requête SQL
    $stmt = $this->db->prepare("SELECT code FROM categorie WHERE nomcategorie = :nom");
    $stmt->bindParam(':nom', $name);
    $stmt->execute();

    return $stmt->fetchColumn(); // Retourne l'ID ou false
}

    public function getFilteredProducts($category_id, $sous_categorie_id)
    {
        $req_filter_products = "SELECT produit.*, categorie.nomCategorie AS categorie_nom 
                                FROM produit
                                JOIN categorie ON produit.code_categorie = categorie.code
                                WHERE produit.code_categorie = :category_id
                                AND produit.code_sous_cat = :sous_categorie_id";

        $stmt_filter_products = $this->db->prepare($req_filter_products);
        $stmt_filter_products->execute(['category_id' => $category_id, 'sous_categorie_id' => $sous_categorie_id]);

        return $stmt_filter_products->fetchAll(PDO::FETCH_OBJ);
    }
    public function getPromoProducts()
    {
        $req_promo_product = "SELECT produit.*, categorie.nomCategorie AS categorie_nom 
                              FROM produit
                              JOIN categorie ON produit.code_categorie = categorie.code
                              WHERE produit.promotion > 0";

        $stmt_promo_products = $this->db->prepare($req_promo_product);
        $stmt_promo_products->execute();

        return $stmt_promo_products->fetchAll(PDO::FETCH_OBJ);
    }
    public function updatestock($code, $quantite)
    {
        try {
            $sql = "UPDATE $this->table SET qte = qte + :quantite WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $code, 'quantite' => $quantite]);
        } catch (PDOException $e) {
            die("Error updating data: " . $e->getMessage());
        }
    }
    public function getProduitByCode($code)
    {
        $req4 = "SELECT produit.*, categorie.nomCategorie AS nom_cat, marque.nomMarque AS nom_mar, sous_categorie.nom_sous_cat AS nom_sous_cat
        FROM produit
        JOIN categorie ON produit.code_categorie = categorie.code
        JOIN sous_categorie ON produit.code_sous_cat = sous_categorie.code
        JOIN marque ON produit.code_marque = marque.code
        WHERE produit.code = :code";
        $stmt = $this->db->prepare($req4);
        $stmt->execute(['code' => $code]);

        $produit = $stmt->fetch(PDO::FETCH_OBJ);
        return $produit;
    }
    public function randomProducts($product_count)
    {
        $req_random = "SELECT produit.*, categorie.nomCategorie AS categorie_nom 
        FROM produit
        JOIN categorie ON produit.code_categorie = categorie.code
        ORDER BY RAND()
        LIMIT :product_count";
        $stmt_random = $this->db->prepare($req_random);
        $stmt_random->bindValue(':product_count', $product_count, PDO::PARAM_INT);
        $stmt_random->execute();
        $random_products = $stmt_random->fetchAll(PDO::FETCH_OBJ);
        return $random_products;
    }
}
?>