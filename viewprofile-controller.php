<?php
require_once 'viewprofile-class.php';

//Condition to Call PHP Class Post functions
if(isset($_POST['func'])){

    $ViewProfile = new ViewProfile();
    $userid = $_POST['userid'];

    switch($_POST['func']){
        case 'viewuserprof' : $ViewProfile->ViewUserProfile($userid);
        break;
        case 'viewuserphotos' : $ViewProfile->ViewUserProfile($userid);
        break;
    }
}


?>