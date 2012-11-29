<?php
include_once ('includes/User.php');
//include_once ('includes/Winkelmand.php');
include_once ('includes/Connection.php');
session_start ();

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$Url = 'index.php';
			$user = new User;
                        $Bericht = $user->login($_POST['login'], $_POST['wachtwoord']);
			if (empty($Bericht)){
                            $userinfo= $user->getOne($_POST['login']);
                            $_SESSION['id'] = $userinfo['ID'];
                            $_SESSION['login'] = $userinfo['Login'];
                            $_SESSION['loginID'] = $userinfo['ID'];
												
                            if (!empty($_SESSION['id']) && !empty ($_SESSION['email'])){
                            /*if (!isset($_SESSION['wagen']))	{
                            $_SESSION['wagen'] = new Winkelmand();
                            }
                            $_SESSION['wagen']->getOpgeslagenWagen ();*/
                            }
                            $Redirect = "location: ".$Url;
                            header ($Redirect);
                        }
		}
?>
<html>
<head>
	<title>Webshop -> Inloggen</title>
</head>
<body>

	<h2>Webshop -> Inloggen</h2>

	    
    	<form method="POST" action="<?php basename ($_SERVER['PHP_SELF']) ?>">
        
        	<table>
            	
                <tr>
                	<td>Login </td><td><input type="text" name="login" size="30" /></td>
                </tr>
                
                <tr>
                	<td>Wachtwoord </td><td><input type="password" name="wachtwoord" size="30" /></td>
                </tr>
                
                <tr>
                	<td><input type="submit" value="Inloggen" /></td>
                </tr>
            
            </table>  	
        
        </form>
        
        	<?php 
			
				if (!empty($Bericht))
				{
				
					foreach ($Bericht as $Melding)
					{
					
						echo $Melding;
					
					}
				
				}
			
		?>
        
           <hr/>
            Nieuwe gebruiker? U kunt <a href="winkelRegister.php">hier</a> registreren

</body>
</html>