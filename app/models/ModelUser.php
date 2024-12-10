<?php
require_once 'app/models/Model.php';
class ModelUser extends Model
{
    public function __construct($db) //pour recupere tous de la classe Model il save ,update ,create,delete 
    {
        parent::__construct($db, 'users');

    }

    public function getUserByUsername($username, $password)
    {
        $db = Database::getInstance()->getConnection();
        $statement = $db->prepare("SELECT * FROM users WHERE mail = ? and mot_passe = ?");
        $statement->execute(array($username, $password));
        return $statement->fetch();
    }
    
}
?>