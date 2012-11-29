<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'includes/User.php';
require_once 'includes/Product.php';
?>
<html>
<head>
<title>Winkelmand Db</title>
<link rel="Stylesheet" type="text/css" href="css/style.css" ></link>
</head>
<body>


<div class="link">
    <a href="registreer.php">Registreer</a>
    <?php
        if ($_SERVER['REQUEST_METHOD']=='POST'){
         if(!empty($_POST)){

            $user = new User;
            if (!$user->login($_POST['login'], $_POST['wachtwoord']) ) {
                echo "Login foutief";
             }
             else {
                echo "U bent ingelogd";
            }
    }
}
?>    
</div>
<div class="login">
    <form method="post" action="#">
        <label>Login</label><input type="text" name="login">
        <br/>
        <label>Wachtwoord</label><input type="password" name="wachtwoord">
        <br/>
        <input type="submit" value="Inloggen">
    </form>
</div>
<?php
    $product = new Product;
    $items=$product->getProductenlijst();
?>
    <div class="producten">
        <?php
            foreach($items as $key => $value) { ?>
                <div class="item">
                    <img width="100" src="images/img<?= $value['ID'];?>.jpeg" />
                    <p><a href="basket.php?type=add&id=<?php echo($value['ID']);?>">bestel</a> <br/><br/> <?php echo ($value['Naam']);?></p>
                </div>
        <?php  } ?>
    </div>

</body>
</html>
