<?php
include __DIR__ ."/class.db.php";

class Chat extends Connection {


    public function insertChat($myid, $oid, $message){

     if(!empty($message)){
         $stmt = $this->connect()->prepare("INSERT INTO  messages (incoming_msg_id, outgoing_msg_id, msg) VALUES (?, ?, ?)");
         $stmt->execute([$oid, $myid, $message]);
     }





    }



    public function getChat($myid, $oid){
     
        $output = "";
        $stmt = $this->connect()->prepare("SELECT * FROM messages
        LEFT JOIN users ON users.unique_ID = messages.outgoing_msg_id
        WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?) OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY msg_id");
        $stmt->execute([$myid, $oid, $oid, $myid]);

        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                if($row['outgoing_msg_id'] === $myid){
                    $output .= '
                    <div class="chat outgoing">
                    <div class="details">
                    <p>'.$row['msg'] . '</p>
                    </div>
                    </div>';

                }
                else {
                    $output .= '
                    <div class="chat incoming">
                    <img src="images/'.$row['img'].'">
                    <div class="details">
                    <p>'.$row['msg'] . '</p>
                    </div>
                    </div>';
                }
            }
        }
       else {
           $output .= '<div class="text">Keine Nachrichten verfügbar!</div>';
       }

      echo $output;

    }

}







?>