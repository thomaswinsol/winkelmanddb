<?php

/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
require_once ('Connection.php');
/**
* Description of Product
*
* @author webmaster
*/
class Product {
    //put your code here

    private $_db;

    public function __Construct()
    {
        $this->_db = new Connection;
        $this->_db = $this->_db->connect();

    }

    public function getAll ()
    {        
            $st = $this->_db->prepare('select ID, Naam, Prijs from producten');
            $st->execute();
            $result = $st->fetchAll();
            return $result;
    }

}

?>