<?php
session_start();
include_once __DIR__ ." /class/class.User.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <title>Coders Chat | login</title>
</head>

<body>

<div class="wrapper">
 <section class="users">
      
        <header>
     <div class="content">
      
      <?php
      
      $user = new User();
      $r = $user->getUserData($_SESSION['unique_ID']);
      



      ?> 

       <img src="images/<?php echo $r['img']; ?>">
       <div class="details">
           <span><?php echo $r['username']; ?></span>
           <p><?php echo $r['status']; ?></p>

        </div>
       </div>



     <!--a href="">Logout</a>-->
     <form action="#" method="POST">
     <button class="lg" type="submit" name="logout">Logout</button>
    </form>
     <?php
      
      if(isset($_POST['logout'])){
          $user->logOut();
      }
      
     

     ?>
     
     


</header>

<div class="users-list">

<span class="text">Users</span>
  <?php

 $user->getUsers();



?>

</div>

 </section>

</div>







</body>
</html>