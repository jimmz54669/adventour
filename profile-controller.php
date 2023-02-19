<?php

require_once 'connect.php';
session_start();

//QUERY ALL PROFILE DATA THROUGH AJAX Response
class Profile extends Database{


//Query for Get User Info
function GetUserInfo(){
    $UserId = $_SESSION['userid'];

    $sql = "SELECT * FROM users WHERE id = '$UserId'";
    $execute = $this->connect()->query($sql);
    $numRows = $execute->num_rows;

    if($numRows > 0){
        $result = $execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}//end function


function UpdateFirstName(){

    $UserId = $_POST['userid'];
    $newfirstname = $_POST['newfname'];
    print_r($newfirstname);
    $sql = "UPDATE users SET firstname = '$newfirstname' WHERE id='$UserId'";
    $execute = $this->connect()->query($sql);

    if($execute == TRUE){
        $_SESSION['showAlert'] = true;
        print_r($sql);
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
            . $this->connect()->connect_error;
            header("location: sign-up.php");
    }

}//End Function

function UpdateLastName(){
    
    $UserId = $_POST['userid'];
    $newlastname = $_POST['newlname'];
    print_r($newlastname);
    $sql = "UPDATE users SET lastname = '$newlastname' WHERE id='$UserId'";
    $execute = $this->connect()->query($sql);

    if($execute == TRUE){
        $_SESSION['showAlert'] = true;
        print_r('Updated Lname');
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
            . $this->connect()->connect_error;
            header("location: sign-up.php");
    }

}//End Function

function UpdatePhoneNumber(){
    
    $UserId = $_POST['userid'];
    $newphonenumber = $_POST['newphonenumber'];
    print_r($newphonenumber);
    $sql = "UPDATE users SET phonenumber = '$newphonenumber' WHERE id='$UserId'";
    $execute = $this->connect()->query($sql);

    if($execute == TRUE){
        $_SESSION['showAlert'] = true;
        print_r('Updated PhoneNumber');
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
            . $this->connect()->connect_error;
            header("location: sign-up.php");
    }

}//End Function

function UpdateBirthDay(){
    
    $UserId = $_POST['userid'];
    $newbirthday = $_POST['newbirthday'];
    print_r($newbirthday);
    $sql = "UPDATE users SET birthday = '$newbirthday' WHERE id='$UserId'";
    $execute = $this->connect()->query($sql);

    if($execute == TRUE){
        $_SESSION['showAlert'] = true;
        print_r('Updated Bday');
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
            . $this->connect()->connect_error;
            header("location: sign-up.php");
    }

}//End Function


//Query for Posts for timeline
function GetUserPost(){

$UserId = $_SESSION['userid'];

    $sql = "SELECT `posts`.`id` AS pid, `posts`.`body`, `posts`.`userid`, `posts`.`dateposted`, `postpics`.`name` AS postpicname, `users`.`firstname`, `users`.`lastname`, `posts`.`postlocation` FROM `users` LEFT JOIN `posts` on `posts`.`userid` = `users`.`id` LEFT JOIN `postpics` on `postpics`.`userid` = `users`.`id` and `postpics`.`postid` = `posts`.`id` WHERE `users`.`id` = '$UserId' ORDER BY `posts`.`id` DESC";
    $execute = $this->connect()->query($sql);
    $numRows = $execute->num_rows;
    if($numRows > 0){
        $_SESSION['showAlert'] = true;
        $result = $execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
            . $this->connect()->connect_error;
            header("location: sign-up.php");
    }

}


function GetUserComments(){

    $sql = "SELECT `comments`.`id` AS cid, `comments`.`content`, `comments`.`postid`, `comments`.`userid`, `users`.`firstname`, `users`.`lastname`, `users`.`profpic` AS picname FROM comments LEFT JOIN posts ON `posts`.`id` = `comments`.`postid` LEFT JOIN users on `users`.`id` = `comments`.`userid` ORDER BY `comments`.`id` DESC";
    $execute = $this->connect()->query($sql);

    if($execute == TRUE){
        $_SESSION['showAlert'] = true;
        $result = $execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
            . $this->connect()->connect_error;
            header("location: sign-up.php");
    }


}


function GetUserProfPic(){
    $UserId = $_SESSION['userid'];
    $sql = "SELECT profpic AS picname FROM users WHERE id = '$UserId'";

    $execute = $this->connect()->query($sql);
    if($execute == TRUE){
        $result = $execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
        . $this->connect()->connect_error;
        header("location: sign-up.php"); 
    }

}



function GetUserCoverPic(){
    $UserId = $_SESSION['userid'];
    $sql = "SELECT coverpic AS picname FROM users WHERE id = '$UserId'";

    $execute = $this->connect()->query($sql);
    if($execute == TRUE){
        $result = $execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
        . $this->connect()->connect_error;
        header("location: sign-up.php"); 
    }
}//End of function



function GetUserPhotoPosts(){

    $UserId = $_SESSION['userid'];
    $sql = "SELECT name AS picname FROM postpics WHERE userid = '$UserId' ORDER BY id DESC LIMIT 4";

    $execute = $this->connect()->query($sql);
    if($execute == TRUE){
        $result = $execute->fetch_all(MYSQLI_ASSOC);
        $profpic = $this->GetUserProfPic();
        $coverpic = $this->GetUserCoverPic();

        $final_result = array_merge($result,$profpic,$coverpic);

        return $final_result;
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
        . $this->connect()->connect_error;
        header("location: sign-up.php"); 
    }

}//End of Function


//Photo Gallery
function GetUserPhotos(){

    $UserId = $_SESSION['userid'];
    $sql = "SELECT name AS picname FROM postpics WHERE userid = '$UserId' ORDER BY id DESC";

    $execute = $this->connect()->query($sql);
    if($execute == TRUE){
        $result = $execute->fetch_all(MYSQLI_ASSOC);
        $profpic = $this->GetUserProfPic();
        $coverpic = $this->GetUserCoverPic();

        $final_result = array_merge($result,$profpic,$coverpic);

        return $final_result;
    }else{
        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
        . $this->connect()->connect_error;
        header("location: sign-up.php"); 
    }

}//End of Function



    //Site Search includes Users and Products
    function SiteSearch(){
        $keysearch = $_GET['keysearch'];
        //sql query to select the search key for users and products.
        $sql1 = "SELECT CONCAT('shop.php') as link, CONCAT('images/',prodimg) as searchimg,CONCAT(prodname,',', prodprice) AS stringsearch FROM products WHERE prodname LIKE '%$keysearch%' OR prodcode  LIKE '$%keysearch%' LIMIT 4 ";
        $sql2 = "SELECT CONCAT('viewprofile.php?uid=',id) as link, CONCAT('uploads/',profpic) as searchimg,CONCAT(firstname, ' ', lastname) AS stringsearch FROM users WHERE firstname LIKE '%$keysearch%' OR lastname LIKE '%$keysearch%' LIMIT 4";
        $execute1 = $this->connect()->query($sql1);
        $execute2 = $this->connect()->query($sql2);
        
        $result1 = $execute1->fetch_all(MYSQLI_ASSOC);
        $result2 = $execute2->fetch_all(MYSQLI_ASSOC);

        $searchlist = array_merge($result1, $result2);
            
        echo json_encode($searchlist);
        
    }//end of Function


}//END CLASS
?>