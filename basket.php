<?php
ini_set('display_errors', 1);
require_once 'includes/Winkelmand.php';
require_once 'includes/Product.php';
session_start();

if($_GET['type'] === 'add') {
       if (!isset($_SESSION['id']) && !isset ($_SESSION['login'])){
	   $header = "location: winkelLogin.php";
	   header ($header);
	}
   
    $winkelmand = new Winkelmand;
    $product = new Product;
    $items = $product->getAll();
    $gsm = array();
    foreach ($items as $item) {
        if((int)$item['ID']===(int)$_GET['id']) {
            $gsm = $item;
            break;
        }
    }
    $winkelmand->toevoegenAanMand($_SESSION['loginID'],$gsm);
}
?>

<html>
<head>
<title>
  Basket
</title>
</head>
<body>
<?php
            $totaalAantal = 0;
            $totaalPrijs = 0;
            $ii=0;
            $basket = '<ul>';
            $itemswinkelmand=$winkelmand->mandWeergeven($_SESSION['loginID']);
            print_r($itemswinkelmand);
            die("ok");
            foreach( $itemswinkelmand as $product) {
                $totaalAantal += $product['aantal'];
                $totaalPrijs += $product['aantal'] * $product['prijs'];

                $basket .= '<li>Product:' . $product['Naam'] . ' - aantal:' .
                        $product['Aantal'] . ' - prijs' . $product['Prijs'] . '&euro;<li>';
                $ii++;
            }
            $basket .= '</ul>';

            echo '<hr />Totale prijs voor : ' . $totaalAantal . 'stuk(s) is '. $totaalPrijs . '&euro;';
            echo $basket;
            echo $ii;
        ?>
<?php
            if(isset($_POST['email'])) {
                $subject='test';
                $description='test';
                if(mail($_POST['email'], $subject, $description)) {
                    unset($_SESSION['winkelmand']);
                }
                echo 'Bestelling werd geplaatst';

                header('refresh: 5; url=/shop');
            }
        ?>
<hr>
<form method="post" action="#">
       E-mail: <input type="text" name="email" size="50" />
       <input type="submit" value="Bestellen" />
</form>
</body>
</html>