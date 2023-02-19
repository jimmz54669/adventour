<?php 

require_once 'connect.php';
session_start();


class ViewProfile extends Database {


    //Function Will View the user profile
    function ViewUserProfile($userid){
     
       if($userid != ''){

        return $userid;
        }

    }//end function



    function ViewUserProfileInfo($userid){
        $sql = "SELECT * FROM users WHERE id='$userid'";
        $execute = $this->connect()->query($sql);
        $numRows = $execute->num_rows;

        if($numRows > 0){
            $result = $execute->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
    }


    //Query for Posts for timeline
function ViewUserPost($userid)
{  
        $sql = "SELECT `posts`.`id` AS pid, `posts`.`body`, `posts`.`userid`, `posts`.`dateposted`, `postpics`.`name` AS postpicname, `users`.`firstname`, `users`.`lastname`, `posts`.`postlocation` FROM `users` LEFT JOIN `posts` on `posts`.`userid` = `users`.`id` LEFT JOIN `postpics` on `postpics`.`userid` = `users`.`id` and `postpics`.`postid` = `posts`.`id` WHERE `users`.`id` = '$userid' ORDER BY `posts`.`id` DESC";
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
    
    
    function ViewUserComments(){
    
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
    
    
    function ViewUserProfPic($userid){
         
        $sql = "SELECT profpic AS picname, firstname, lastname FROM users WHERE id = '$userid'";
    
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
    
    
    
    function ViewUserCoverPic($userid){

        $sql = "SELECT coverpic AS picname FROM users WHERE id = '$userid'";
    
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
    
    
    
    function ViewUserPhotoPosts($userid){
        
        $sql = "SELECT name AS picname FROM postpics WHERE userid = '$userid' ORDER BY id DESC LIMIT 4";
    
        $execute = $this->connect()->query($sql);
        if($execute == TRUE){
            $result = $execute->fetch_all(MYSQLI_ASSOC);
            $profpic = $this->ViewUserProfPic($userid);
            $coverpic = $this->ViewUserCoverPic($userid);
    
            $final_result = array_merge($result,$profpic,$coverpic);
    
            return $final_result;
        }else{
            $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
            . $this->connect()->connect_error;
            header("location: sign-up.php"); 
        }
    
    }//End of Function
    
    
    //Photo Gallery
    function ViewUserPhotos($userid){
    
        $sql = "SELECT name AS picname FROM postpics WHERE userid = '$userid' ORDER BY id DESC";
    
        $execute = $this->connect()->query($sql);
        if($execute == TRUE){
            $result = $execute->fetch_all(MYSQLI_ASSOC);
            $profpic = $this->ViewUserProfPic($userid);
            $coverpic = $this->ViewUserCoverPic($userid);
    
            $final_result = array_merge($result,$profpic,$coverpic);
    
            return $final_result;
        }else{
            $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
            . $this->connect()->connect_error;
            header("location: sign-up.php"); 
        }
    
    }//End of Function
    




}// End Of Class
?>