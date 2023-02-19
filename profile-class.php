<?php
require_once 'profile-controller.php';

//Condition to Call PHP Class Post functions
if(isset($_POST['func'])){

    $newProfile = new Profile();

    switch($_POST['func']){
        case 'updatefname' : $newProfile->UpdateFirstName();
        break;
        case 'updatelname' : $newProfile->UpdateLastName();
        break;
        case 'updatephonenumber' : $newProfile->UpdatePhoneNumber();
        break;
        case 'updatebday' : $newProfile->UpdateBirthDay();
        break;
    }
}



//Condition to Call PHP Class GET functions
if(isset($_GET['func'])){

    $newProfile = new Profile();

    switch($_GET['func']){
        case 'sitesearch' : $newProfile->SiteSearch();
        break;
    }
}


?>