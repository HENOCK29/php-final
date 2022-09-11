<?php
session_start();
include('config.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result =$bdd->query("SELECT * FROM `products` WHERE `code`='$code'" );
$row=$result->fetch(PDO::FETCH_ASSOC);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];
 
$cartArray = array(
 $code=>array(
 'name'=>$name,
 'code'=>$code,
 'price'=>$price,
 'quantity'=>1,
 'image'=>$image)
);
 
if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) {
 $status = "<div class='box' style='color:red;'>
 Produit deja ajouter!</div>"; 
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Produit ajouter au Pagner!</div>";
 }
 
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/produits.css">
    <title>Page Principale</title>
</head>
<body>
<div class="headder">
    <div class="logo">
      <h2>Horizon Corp</h2>
    </div>
    <div class="navbar">
      <ul>
        <li><a href="index.php" class="btn">Deconnexion</a></li>
        <li><a href="index.php" class="btn">Connexion</a></li>
        <li><a href="register_form.php" class="btn">S'enregistrer</a></li>
        <li><a href="#">About us</a></li>
        <li><a href="cart.php"><img src="images/cart-icon.png" /><?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
 Cart</a><span>
<?php echo $cart_count; ?></span>
<?php
}
?></li>

      </ul>
    </div>
    

  </div>
<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<br>
    

<h2 class="mobiles">Produits Vivriers</h2>
<?php
$result =$bdd->query("SELECT * FROM `products` LIMIT 0,8");
while($row=$result->fetch(PDO::FETCH_ASSOC)){
    ;
    
    echo "<div class='product_wrapper'>
              <form method='post' action=''>
                    <input type='hidden' name='code' value=".$row['code']." />
                        <div class='image'><img src='".$row['image']."'></div>
                        <div class='name'>".$row['name']."</div>
                        <div class='price'>FC ".$row['price']."</div>
                        <button type='submit' class='buy'>AJOUTER AU PAGNER</button>
              </form>
          </div>";
        }
    
?>
<?php
$result = $bdd->query("SELECT * FROM `products` LIMIT 8,16");
while($row=$result->fetch(PDO::FETCH_ASSOC)){
    
    echo "<div class='product_wrapper'>
              <form method='post' action=''>
                    <input type='hidden' name='code' value=".$row['code']." />
                        <div class='image1'><img src='".$row['image']."'></div>
                        <div class='name'>".$row['name']."</div>
                        <div class='price'>FC ".$row['price']."</div>
                        <button type='submit' class='buy'>AJOUTER AU PAGNER</button>
              </form>
          </div>";
        }
    

?>
<?php
$result = $bdd->quer("SELECT * FROM `products` LIMIT 16,24");
while($row=$result->fetch(PDO::FETCH_ASSOC)){
    
    echo "<div class='product_wrapper1'>
              <form method='post' action=''>
                   <input type='hidden' name='code' value=".$row['code']." />
                   <div class='image2'><img src='".$row['image']."'></div>
                  <div class='name'>".$row['name']."</div>
                  <div class='price'>FC ".$row['price']."</div>
                  <button type='submit' class='buy1'>AJOUTER AU PAGNER</button>
              </form>
          </div>";
        }
    
if ($bdd) {
    $bdd=NULL;
}
?>

 
<div style="clear:both;"></div>
 
<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>

</body>
</html>