<?php

session_start();
if(isset($_SESSION['unique_ID'])){
    include_once __DIR__."/../class/class.chat.php";
    $myid = $_SESSION['unique_ID'];
    $oid = $_POST['incoming_id'];
    $chat = new Chat();
    $chat->getChat($myid, $oid);
}
else {
    header("Location: ../login.php");
}





?>

