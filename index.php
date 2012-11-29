<?php
	session_start ();	
		$Status = '';
		$LoginLink = '';
		
			if(isset($_SESSION['login'])) {
				$Status = 'Ingelogd als <b>' .$_SESSION['login']. '</b>';
				$LoginLink .= '<a href="winkelLogout.php">Uitloggen</a>';
			}
			else
			{
				$Status = 'Niet ingelogd!';
				$LoginLink = '<a href="winkelLogin.php">Inloggen</a>';
			}

?>
<html>
<head>
	<title>Winkelmand DB</title>
        <link href="css/style.css" rel="stylesheet" >
</head>
<body>

	<h2>Webshop</h2>

		<?php
		
			echo $Status;
		
		?>

			<ul>       	
                        <li><?php echo $LoginLink; ?></li>
                        </ul>
        
        	<hr />
<ul>
<?php
     include_once ('includes/Product.php');
     $product = new Product;
     $items = $product->getAll();
     foreach($items as $key => $value) { ?>
    <li>
        <img width="50px;" src="<?php echo "images/img".trim($value['ID']).".jpeg"; ?>" />
         <?php echo($value['Naam']); ?>
        <a href="basket.php?type=add&id=<?php echo($value['ID']);?>">bestel</a>
    </li>
<?php } ?>
</ul>
</body>
</html>