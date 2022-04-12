


<?php

include __DIR__ . "/class.db.php";

class User extends Connection
{


    public function signup($uname, $email, $pw)
    {

        if (isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extension = ["jpeg", "png", "jpg", "gif"];
            if (in_array($img_ext, $extension) === true) {
                $types = ["image/jpeg", "image/jpg", "image/png", "image/gif"];

                if (in_array($img_type, $types) === true) {
                    $time = time();
                    $new_img_name = $time . $img_name;

                    if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                        $ran_id = rand(time(), 10000000);
                        $status = "Active now";
                        $encrypt_pass = sha1($pw);
                        $stmt = $this->connect()->prepare("INSERT INTO users (unique_ID, username, email, password, img, status)
                        VALUES (?,?,?,?,?,?)");
                        $stmt->execute([$ran_id, $uname, $email, $encrypt_pass, $new_img_name, $status]);
                       
                    }
                } else {
                    echo "Dateityp ungültig!";
                }
            } else {
                echo "Dateiformat ungültig!";
            }
           return true; 
        }
    }

    public function signin($uname, $pw){


        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$uname]);
        $rows = $stmt->rowCount();

        if($rows > 0){
            $result = $stmt->fetch();
            $user_pass = sha1($pw);
            $enc_pass = $result['password'];

            if($user_pass === $enc_pass){
                $status ="Active now";
                $stmt2 = $this->connect()->prepare("UPDATE users SET status = '$status' WHERE unique_ID = ?");
                $stmt2 ->execute([$result['unique_ID']]);
                $_SESSION['unique_ID'] = $result['unique_ID'];
                return true;

            } 
            else {
                echo 'Username oder Passwort falsch!';

            }
        }
        else {
             echo 'Username exestiert nicht';
        }
    } 





    public function getUserData($unique_id){
        $stmt =$this->connect()->prepare("SELECT * FROM users WHERE unique_ID = ?");
        $stmt->execute([$unique_id]);
        $rows = $stmt->rowCount();
        if($rows > 0){
            $res = $stmt->fetch();
            return $res;
        }
    }


   public function getUsers(){
       $outgoing_id = $_SESSION['unique_ID'];
       $stmt = $this->connect()->prepare("SELECT * FROM users WHERE NOT unique_ID = ? ORDER BY user_ID DESC");
       $stmt->execute([$outgoing_id]);
       $output = "";

       if($stmt->rowCount() == 0){
           $output .= "Keine User verfügbar";

       }
       elseif($stmt->rowCount() > 0){
           while($row = $stmt->fetch()){
               //$stmt2 =$this->connect()->prepare("SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_ID']} OR outgoing_msg_id = {$row['unique_ID']}) AND (outgoing_msg_id = '$outgoing_id' OR incoming_msg_id = '$outgoing_id') ORDER BY msg_id DESC LIMIT 1");
               $stmt2 = $this->connect()->prepare("SELECT * FROM messages 
               WHERE (incoming_msg_id = {$row['unique_ID']} OR outgoing_msg_id ={$row['unique_ID']}) 
               AND (outgoing_msg_id = '$outgoing_id' OR incoming_msg_id = '$outgoing_id') 
               ORDER BY msg_id 
               DESC LIMIT 1");
              
              
              
               $stmt2->execute();
               $row2 = $stmt2->fetch();
               ($stmt2->rowCount() > 0) ? $result = $row2['msg'] : $result = "Keine Nachrichten verfügbar!";
               (strlen($result) > 28) ? $msg = substr($result, 0,28) . '...' :$msg = $result;

               if(isset($row2['outgoing_msg_id'])){
                   ($outgoing_id == $row2['outgoing_msg_id']) ? $you ="Du: " :$you = "";


               }
               else{
                   $you ="";
               }
               ($row['status'] == "offline now") ? $offline ="offline" : $offline = "";

               $output .= '
               <a href="chat.php?user_id='.$row['unique_ID'].'">
                
               <div class="content">
               <img src="images/'.$row['img'].'">
               <div class="details">
                   <span>'.$row['username'].'</span>
                   <p>'.$you . $msg.'</p>
                </div>
                </div>

               </a>

               ';



           }
       }

     echo $output;

   }


     public function logOut(){
      
     
            session_destroy();
            header("Refresh: 3; url=login.php");
            print '<h6> Ausgeloggt</h6>';
        

     }



}






?>
