<?php 

require_once 'connect.php';
session_start();


class Message extends Database {

    function FetchUserMessage($from_userid, $to_userid){
        
        $sql = "SELECT `chat_message`.`id` AS chat_id, `chat_message`.`from_user_id`, `chat_message`.`to_user_id`, `chat_message`.`chat_message`, `chat_message`.`status`, `chat_message`.`time_stamp`, `users`.`profpic`, `users`.`id` AS userid FROM `chat_message` LEFT JOIN `users` ON `users`.`id` = `chat_message`.`from_user_id` WHERE (`chat_message`.`from_user_id` = '$from_userid' AND `chat_message`.`to_user_id` = '$to_userid') OR (`chat_message`.`to_user_id` = '$from_userid' AND `chat_message`.`from_user_id` = '$to_userid') ORDER BY `chat_message`.`id`";
        
        $execute = $this->connect()->query($sql);
        
        if($execute == TRUE){
            
            $numRows = $execute->num_rows;
            //Check if Messages Exists Return Messages
            
            if($numRows > 0){
                $result = $execute->fetch_all(MYSQLI_ASSOC);
                //if the user is in the message page set status to 0 which is seen
                $setstatus = "UPDATE chat_message SET status = '0' WHERE from_user_id = '$from_userid' AND to_user_id = '$to_userid' AND status = '1'";
                $executes = $this->connect()->query($setstatus);
        
                if($executes == TRUE){
                    return $result;
                }
            }
        }else{
            $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                . $this->connect()->connect_error;
                header("location: sign-up.php");
        }
        
    }//end function


    function GetUserWithMessage($userid){
        $sql = "SELECT DISTINCT `users`.`profpic`, `users`.`id`, `users`.`firstname`, `users`.`lastname` FROM `chat_message` lEFT JOIN `users` on `users`.`id` = `chat_message`.`from_user_id` OR `users`.`id` = `chat_message`.`to_user_id`  WHERE `chat_message`.`to_user_id` = '$userid' OR `chat_message`.`from_user_id` = '$userid'";
        $execute = $this->connect()->query($sql);
        
        if($execute == TRUE){
            
            $numRows = $execute->num_rows;
            //Check if Messages Exists Return Messages
            
            if($numRows > 0){
                $result = $execute->fetch_all(MYSQLI_ASSOC);
            
                    return $result;
            }
        }else{
            $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                . $this->connect()->connect_error;
                header("location: sign-up.php");
        }
    
    }//end Function


    function SendMessage(){
        $from_userid = $_POST['fromuserid'];
        $to_userid = $_POST['touserid'];
        $chat_message = $_POST['chat_message'];
        $message_date = date("Y-m-d h:i:sa");

        //status = 0 is not seen , 1 = seen, 2 == deleted message
        $sql = "INSERT INTO chat_message (from_user_id, to_user_id, chat_message, time_stamp, status) VALUES ('$from_userid', '$to_userid', '$chat_message', '$message_date','1')";
        $execute = $this->connect()->query($sql);
        
        if($execute == TRUE){
            $FetchUserMessage = $this->FetchUserMessage($from_userid, $to_userid);
            return $FetchUserMessage; 
        }else{
            $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                . $this->connect()->connect_error;
                header("location: sign-up.php");
        }
    }//end Function




    function DelMessage(){

    }//end Function





}//End Class

?>