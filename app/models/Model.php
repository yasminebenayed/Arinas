<?php
class Model
{
    protected $table;
    protected $db;
    public function __construct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }
    public function save($data)
    {
        try {
            if (isset($data['code'])) {//keno il code mawjoud
                $columns = array_keys($data);//pour recuperer les keys 
                $sets = [];//bech nistoki fiha ili bech n7tou  ba3d values
                $i = 0;
                foreach ($columns as $column) {
                    $sets[$i] = "$column = :$column";
                    $i++;
                }
                $setString = implode(', ', $sets);//pour creer une chaine de caractere de sets separer par des virgule
                $sql = "UPDATE $this->table SET $setString WHERE code = :code"; //UPDATE table_name SET name = :name, age = :age WHERE code = :code
            } else {
                // Insert a new record
                $columns = implode(', ', array_keys($data));
                $placeholders = ':' . implode(', :', array_keys($data));//pour creer la forme INSERT INTO table_name (name, age) VALUES (:name, :age)
                $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
            }
            $stmt = $this->db->prepare($sql); //pour executer la requete
            $stmt->execute($data);
        } catch (PDOException $e) {
            die("Error saving data: " . $e->getMessage());
        }
    }
    public function find($code)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $code]);
            return $stmt->fetch(PDO::FETCH_ASSOC);//code inique c'est pourquoi il fait fetch
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function findAll()
    {
        try {
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function create($data)
    {
        try {   // pour creer INSERT INTO table_name (name, age) VALUES (:name, :age)
            $columns = implode(', ', array_keys($data)); // pour creer name, age
            $placeholders = ':' . implode(', :', array_keys($data));//pour creer :name, :age
            $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            return $this->db->lastInsertId();//revoit le code de l'ajouter
        } catch (PDOException $e) {
            die("Error creating data: " . $e->getMessage());
        }
    }
    public function update($code, $data)
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
}