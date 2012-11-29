<?php

	function create_regcode ()
	{
	
		return (sha1 (microtime () . rand (10000 , 320000) ) );
		
	}
	
	
	
	function send_confirmation($email, $gebruiker_code = '')
	{
		
		if(!empty($_POST['email']))
		{
			
			$headers  		= 'MIME-Version: 1.0' . "\r\n";
			$headers 		.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$pagina 		= "http://kvt-webdevelopment.nl/fotoWinkel/showWinkel/winkelConfirm.php?user=" . $email . "&code=" . $gebruiker_code;
			$onderwerp 		= "fotoWinkel -> Registratie";
			$ontvanger 		= $email;
				
				$bericht 		= '
					<html>
						<head>
							<title>fotoWinkel - > Registratie</title>
						</head>
						<body>
							<b>Bedankt voor uw registratie bij onze foto winkel</b><br /><br />
							Uw account is geregistreerd met het volgende emailadres: <u>'.$email.'</u><br />
							Klik <a href="'.$pagina.'">hier</a> om uw account te activeren.<br /><br />
							Met vriendelijk groeten, <br /><br />
							De webmaster<br /><br />
						</body>
					</html>
								   ';
		}
		else
		{
			
				return false;
		
		}
			
		if(!mail($ontvanger, $onderwerp, $bericht, $headers))
		{
				
			return false;
				
		}
		else
		{
					
			return true;
					
		}
		
	}
?>