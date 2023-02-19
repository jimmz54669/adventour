<?php
require_once 'post-class.php';

//Condition to Call PHP Class Post functions
if(isset($_POST['func']) || $_FILES["photo_post"]){

    $newPost = new Post();

    switch($_POST['func']){
        case 'savepost' : $newPost->SavePost();
        break;
        case 'deletepost' : $newPost->DeletePost();
        break;
        case 'editpost' : $newPost->EditPost();
        break;
        case 'savecomment' : $newPost->SaveComment();
        break;
        case 'saveprofpic' : $newPost->SaveProfPic();
        break;
        case 'savecoverpic' : $newPost->SaveCoverPic();
        break;
    }
}


?>