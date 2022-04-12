<?php

session_start();
if(isset($_SESSION['unique_ID'])){
    include_once __DIR__."/../class/class.chat.php";
    $myid = $_SESSION['unique_ID'];
    $oid = $_POST['incoming_id'];
    $message = $_POST['message'];
    $chat = new Chat();
    $chat->insertChat($myid, $oid, $message);
}
else {
    header("Location: ../login.php");
}





?>