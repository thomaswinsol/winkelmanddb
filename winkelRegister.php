<?php
include_once ('includes/User.php');
include_once ('includes/Connection.php');
session_start ();

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$Url = 'winkelConfirm.php';
			$user = new User;
                        $Bericht = $user->register($_POST);
			if (empty($Bericht)){
                            $Redirect = "location: ".$Url;
                            header ($Redirect);
                        }
		}
?>
<html>
<head>
	<title>Webshop -> Registratie</title>
</head>
<body>

	<h2>Registratie</h2>

	Registreer nu bij onze <strong>Webshop</strong>
	
        <a href="index.php">Terug naar Home</a>
        	<hr />
            
            	<form method="POST" action="<?php basename ($_SERVER['PHP_SELF']) ?>" />
                
                	<table>
                    	
                        <tr>
                        	<td>Voornaam </td><td><input type="text" name="Voornaam" size="30" /></td>
                        </tr>

                        <tr>
                        	<td>E-mailadres </td><td><input type="text" name="Email" size="30" /></td>
                        </tr>

                        <tr>
                        	<td>Login </td><td><input type="text" name="Login" size="30" /></td>
                        </tr>

                        <tr>
                        	<td>Wachtwoord </td><td><input type="password" name="Wachtwoord" size="30" /></td>
                        </tr>
                        
                        <tr>
                        	<td><input type="submit" value="Registreren" /></td>
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
        
</body>
</html>