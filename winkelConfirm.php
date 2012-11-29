<?php
      $Bericht = '<h2>Registratie succesvol!</h2>';
      $Bericht .= 'Uw account is geactiveerd, u kunt nu inloggen met uw e-mailadres en wachtwoord';
?>
<html>
<head>
	<title></title>
</head>
<body>

    	<?php
		echo $Bericht;	
	?>
        
            <ul>
                <li><a href="winkelIndex.php">Terug naar homepage</a></li>
                <li><a href="winkelLogin.php">Inloggen</a></li>            
            </ul>    
</body>
</html>