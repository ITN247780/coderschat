<?php
session_start();
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

        <section class="form login">

            <header>Coders Chat Login</header>

            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">

                <div class="error-text"></div>

                <div class="field input">
                    <label>Username</label>
                    <input type="text" name="uname" placeholder="Username" required>

                </div>
                

                <div class="field input">
                    <label>Passwort</label>
                    <input type="password" name="password" placeholder="Passwort" required>

                </div>
               
                <div class="field button">
                    <input type="submit" name="submit" value="Login">


                </div>

            </form>

            <?php

            if(isset($_POST['submit'])){
                include_once __DIR__ ." /class/class.User.php";

                $user = new User();
                $check = $user->signin($_POST['uname'], $_POST['password']);
                if($check == true){
                    echo 'Erfolgreich eingeloggt!';
                    header("Refresh:3; url=users.php");

                }
                else {
                    echo 'Login fehlgechlagen';
                }

            }





             ?>


            <div class="link">Noch kein Mitglied? <a href="index.php">Sign Up</a></div>

        </section>



    </div>




















</body>

</html>
