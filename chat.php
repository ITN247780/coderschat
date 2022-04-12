<?php
session_start();
include_once __DIR__ . " /class/class.User.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <title>Chat</title>


</head>

<body>

   

    <div class="wrapper">
    <a class="text" href="users.php">zurück alle Nachrichten sehen</a>
        <section class="chat-area">
        
        <header>


                <?php

                $ouser_id = $_GET['user_id'];
                $user = new User();
                $row = $user->getUserData($ouser_id);




                ?>


                <img src="images/<?php echo $row['img']; ?>">

                <div class="details">
                    <span><?php echo $row['username']; ?></span>
                    <p><?php echo $row['status']; ?></p>



                </div>

            </header>

            <div class="chat-box">

            </div>

            <form action="#" class="typing-area">

                <input type="hidden" class="incoming_id" name="incoming_id" value="<?php echo $ouser_id; ?>">
                <input type="text" class="input-field" name="message" placeholder="Nachricht schreiben..." autocomplete="off">
                <button>></button>


            </form>



        </section>

    </div>

    <script src="js/chat.js"></script>











</body>

</html>