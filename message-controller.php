<?php
require_once 'message-class.php';

//Condition to Call PHP Class Post functions
if(isset($_POST['func'])){

    $Message = new Message();
    $from_userid = $_POST['fromuserid'];
    $to_userid = $_POST['touserid'];

    switch($_POST['func']){
        case 'directmessage' : $Message->FetchUserMessage($from_userid, $to_userid);
        break;
        case 'sendmessage' : $Message->SendMessage();
        break;
        case 'fetchmessage' : $Message->FetchUserMessage($from_userid, $to_userid);
        break;
    }
}


?>