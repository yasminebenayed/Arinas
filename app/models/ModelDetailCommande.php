<?php
require_once("Model.php");

class ModelDetailCommande extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'details_commande');

    }
    
}