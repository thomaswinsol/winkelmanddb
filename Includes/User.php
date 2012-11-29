<?php
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
require_once ('Connection.php');
/**
* Description of User
*
* @author webmaster
*/
class User {
    //put your code here

    private $_db;

    public function __Construct()
    {
        $this->_db = new Connection;
        $this->_db = $this->_db->connect();

    }

    public function login ($login, $wachtwoord)
    {
        $Bericht = array ();
	$LoggedIn = FALSE;
        if (isset($login) && !empty ($login))	{
            if (isset($_POST['wachtwoord']) && !empty ($_POST['wachtwoord'])) {
                 $st = $this->_db->prepare('select * from users where login = :login and wachtwoord = :wachtwoord');
                 $st->execute(array('login'=>$login, 'wachtwoord'=> $wachtwoord));
                 if ($st->rowCount() == 1) {
                       $LoggedIn = TRUE;
                 }
                 else {
                     $Bericht[] = 'Foutieve gebruikersnaam en / of wachtwoord of uw account is nog niet geactiveerd!';
                 }
            }
            else {
                $Bericht[] = 'U heeft geen geldig wachtwoord ingevoerd!';
            }
        }
        else {
            $Bericht[] = 'Login verplicht in te vullen!';
        }  
        return $Bericht;
    }

    public function getOne ($login)
    {
        $st = $this->_db->prepare('select * from users where login = :login');
        $st->execute(array('login'=>$login));
        $result = $st->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


     public function register ($data)
    {
      $Bericht = array ();
      if (isset($login) && !empty ($login))	{
	$st = $this->_db->prepare('select * from users where login = :login');
        $st->execute(array('login'=>$data['Login']));
        if ($st->rowCount() == 0) {        
            if (!empty($data['Wachtwoord']))
            {
                if ($this->check_email($data['Email'])) {
                      $st = $this->_db->prepare('insert into users (Voornaam , Email , Login , Wachtwoord) values( :voornaam , :email , :login , :wachtwoord )');
                      $st->execute(array(':login'=>$data['Login'], ':wachtwoord'=> $data['Wachtwoord'], ':voornaam'=> $data['Voornaam'], ':email' => $data['Email']));   
                }
                else {
                    $Bericht[] = 'Uw e-mail adres is ongeldig!';
                }
              
            }
            else{
                $Bericht[] = 'U heeft geen geldig wachtwoord ingevoerd!';
            }
        }
        else {
            $Bericht[] = 'Er bestaat al een gebruiker met deze login';
        }
        }
      else {
          $Bericht[] = 'Login verplicht in te vullen!';
      }
        return $Bericht;
    }

    private function check_email ($email)
    {
	return true;
    }
}

?>