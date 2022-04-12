<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <title>Coders Chat | sign up</title>
</head>

<body>

    <div class="wrapper">

        <section class="form signup">

            <header>Coders Chat</header>

            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">

                <div class="error-text"></div>

                <div class="field input">
                    <label>Username</label>
                    <input type="text" name="uname" placeholder="Username" required>

                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Email" required>

                </div>

                <div class="field input">
                    <label>Passwort</label>
                    <input type="password" name="password" placeholder="Passwort" required>

                </div>
                <div class="field image">
                    <label>Bild auswählen</label>
                    <input type="file" name="image" accept="image/x-png, image/gif, image/jpg, image/jpeg" required>
                </div>

                <div class="field button">
                    <input type="submit" name="submit" value="Sign UP">


                </div>

            </form>

            <?php

            if(isset($_POST['submit'])){
                include_once __DIR__ ." /class/class.User.php";

                $user = new User();
                $check = $user->signup($_POST['uname'], $_POST['email'], $_POST['password']);
                if($check == true){
                    echo 'Erfolgreich registriert!';
                    header("Refresh:3; url=login.php");

                }
                else {
                    echo 'Registrierung fehlgechlagen';
                }

            }





             ?>


            <div class="link">Bereits registriert? <a href="login.php">Login</a></div>

            

        </section>



    </div>




















</body>

</html>