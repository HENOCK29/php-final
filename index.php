<?php

session_start();
include('config.php');



if(isset($_POST['submit'])){

   if(!empty($_POST['email']) AND !empty($_POST['password'])){


      $email = htmlspecialchars($_POST['email']);
      $pass = sha1($_POST['password']);

      $select =$bdd->prepare( " SELECT * FROM user_form WHERE email = '$email' && password = '$pass'");
      $select->execute(array($email, $password));

      if($select->rowCount() > 0){
              $_SESSION['email'] = $email;
              $_SESSION['password'] = $mdp;
              $_SESSION['id'] = $select->fetch()['id'];
                        
              header("location: user_page.php");
      
      }else{
         $erreur='le mot de passe ou email incorrecte';
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
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style2.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
       if(isset($erreur)){
            echo $erreur;
         }
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>T'as pas un compte mon pote? <a href="register_form.php">Crées en un </a></p>
   </form>
   <div class="rond_one">

   </div>
   <div class="rond_two">

   </div>

</div>

</body>
</html>