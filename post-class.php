<?php

require_once 'connect.php';
include 'SimpleImage.php';
session_start();

class Post extends Database{

    function SavePost(){
            //if($_SERVER['REQUEST_METHOD'] == "POST"){

                $PostTxt = $_POST['post-txt'];
                $UserId = $_POST['userid'];
                $PostLocation = $_POST['post-location'];
                $DatePosted = date("Y-m-d h:i:sa");
                $post_id = '';
                //DB SAVE POST AND UPLOAD
                //Save Post
                if(isset($_POST['post-txt'])){
                    $sql = "INSERT INTO posts (body, dateposted, userid, postlocation) VALUES ('$PostTxt', '$DatePosted', '$UserId', '$PostLocation')";
                    $execute = $this->connect()->query($sql);
                    if($execute == TRUE){
                        $_SESSION['showAlert'] = true;

                        $sqlstr = "SELECT MAX(id) FROM posts WHERE userid='$UserId'";
                        $get_post_id = $this->connect()->query($sqlstr);
                        while($row = $get_post_id->fetch_row()){
                            $post_id = $row[0];
                            echo $PostTxt.' - '.$DatePosted.' - '.$UserId.' - '.$post_id;
                        }

                    }else{
                        $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. ". $this->connect()->connect_error;
                            //header("location: profile.php");
                        echo $this->connect()->connect_error;
                    }
                }
                //Save Post Photo

                if($_FILES["photo_post"]["name"] != '' || $_FILES["photo_post"]["name"] != NULL){
                    //LOCAL FILE UPLOAD
                    $PostPic = explode('.', $_FILES["photo_post"]["name"]);
                    $ext = end($PostPic);
                    $name = rand(100, 999) . '.' . $ext;
                    $location = 'uploads/' . $name;
                    $image = new SimpleImage();
                    $image->createResizedImage($_FILES["photo_post"]["tmp_name"],$location,500,500);

                    $sqlstr = "SELECT MAX(id) FROM posts WHERE userid='$UserId'";
                    $get_post_id = $this->connect()->query($sqlstr);
                    while($row = $get_post_id->fetch_row()){
                        $post_id = $row[0];
//                         echo $PostTxt.' - '.$DatePosted.' - '.$UserId.' - '.$post_id;
                    }
                    
                    
                    //CHECK IF POST ID EXIST ON DATABASE
                    $IfPostExist = "SELECT * FROM Posts WHERE id = '$post_id'";
                    $res = $this->connect()->query($IfPostExist);
                    $numIfPostExistRows = $res->num_rows;
                    print_r($numIfPostExistRows);
                    
                    
                    
                    if($numIfPostExistRows > 0){
                        $sql = "INSERT INTO postpics (name, userid, postid) VALUES ('$name', '$UserId', '$post_id')";
                        if($this->connect()->query($sql)){
                            $_SESSION['showAlert'] = true;
                            echo 'Uploaded';
                        }else{
                            $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                            . $this->connect()->connect_error;
                            //header("location: profile.php");
                            // Close connection
                            $this->connect()->close();
                        }
                    }
                }

            //}
        }//end function SavePost


    function DeletePost(){
   
            $postid = $_POST['postid'];
            $userid = $_POST['userid'];
            $picname = $_POST['picname'];

            $sql = "DELETE FROM posts WHERE id = '$postid' AND userid = '$userid'";
            $sql2 = "DELETE FROM postpics WHERE postid = '$postid' AND userid = '$userid'";
            if($this->connect()->query($sql)){
                $_SESSION['showAlert'] = true;
                
                if($this->connect()->query($sql2)){
                    $_SESSION['showAlert'] = true;

                    $file_pointer = 'uploads/'.$picname;
                    if($file_pointer !== ''){
                        if(!unlink($file_pointer)){
                            echo $file_pointer." Cannot be deleted due to an Error";
                        }else{
                            echo $file_pointer." Photo has been Deleted";
                        }
                    }
                }
                echo ' Post Deleted';

            }else{
                $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                . $this->connect()->connect_error;
                //header("location: profile.php");
                // Close connection
                $this->connect()->close();
            }

    }//end function DeletePost




    function EditPost(){
        
        $postid = $_POST['postid'];
        $userid = $_POST['userid'];
        $picname = $_POST['picname'];
        $EditedPost = $_POST['editedpost'];
        $DateUpdated = date("Y-m-d h:i:sa");

        if(isset($_POST['editedpost'])){
            $sql = "UPDATE posts SET body = '$EditedPost', dateupdated = '$DateUpdated' WHERE id = '$postid' AND userid = '$userid'";

            if($this->connect()->query($sql)){
                $_SESSION['showAlert'] = true;

                echo ' Post Updated ';

            }else{
                $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                . $this->connect()->connect_error;
                // Close connection
                $this->connect()->close();
            }
        }// end isset($_POST['editedpost'])



        if($_FILES["editedpic"]["name"] != '' || $_FILES["editedpic"]["name"] != NULL){
            print_r(', sulod sa 1st cond');
            //LOCAL FILE UPLOAD
            $PostPic = explode('.', $_FILES["editedpic"]["name"]);
            $ext = end($PostPic);
            $name = rand(100, 999) . '.' . $ext;
            $location = 'uploads/' . $name;
            $image = new SimpleImage();
            $image->createResizedImage($_FILES["editedpic"]["tmp_name"],$location,500,500);

            //CHECK IF POSTPICS ID EXIST ON DATABASE
            $IfPostExists = "SELECT * FROM postpics WHERE postid = '$postid' AND userid = '$userid'";
            $reslt = $this->connect()->query($IfPostExists);
            $numIfPostExistRow = $reslt->num_rows;
            
            if($numIfPostExistRow > 0){
                print_r(', sulod sa second cond');
                //UPDATE postpic if record exist on Database
                $sql = "UPDATE postpics SET name = '$name' WHERE userid = '$userid' AND postid = '$postid'";
                if($this->connect()->query($sql)){
                    $_SESSION['showAlert'] = true;
                    echo ' Uploaded ';
                }else{
                    $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                    . $this->connect()->connect_error;
                    // Close connection
                    $this->connect()->close();
                }

                //DELETE the old pic from Directory
                $file_pointer = 'uploads/'.$picname;
                    if($file_pointer != ''){
                        if(!unlink($file_pointer)){
                            echo $file_pointer." Cannot be deleted due to an Error";
                        }else{
                            echo $file_pointer." Photo has been Deleted";
                        }
                    }
            }else{  
                print_r(', sulod sa third cond');
                //INSERT postpic if no record found on Database
                $sql = "INSERT INTO postpics (name, userid, postid) VALUES ('$name', '$userid', '$postid')";
                if($this->connect()->query($sql)){
                    $_SESSION['showAlert'] = true;
                    echo ' Uploaded ';
                }else{
                    $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                    . $this->connect()->connect_error;
                    // Close connection
                    $this->connect()->close();
                }
            }
        }

    }//end Function EditPost




    // Funtion for Save Comment
    function SaveComment(){
        
        $postid = $_POST['postid'];
        $userid = $_POST['userid'];
        $commenttxt = $_POST['commenttxt'];

        if($commenttxt !== ''){
            //INSERT COMMENT IN DATABASE
            $sql = "INSERT INTO comments (content, userid, postid) VALUES('$commenttxt', '$userid', '$postid')";
            if($this->connect()->query($sql)){
                $_SESSION['showAlert'] = true;
                echo ' Comment Posted ';
            }else{
                $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                . $this->connect()->connect_error;
                // Close connection
                $this->connect()->close();
            }
        }
    }//End of Function




    //Function for Save Prof Pic
    function SaveProfPic(){
        $userid = $_POST['userid'];
        $oldprofpic = $_POST['oldprofpic'];
        
        if($_FILES["profpic"]["name"] != '' || $_FILES["profpic"]["name"] != NULL){
            //LOCAL FILE UPLOAD
            $ProfPic = explode('.', $_FILES["profpic"]["name"]);
            $ext = end($ProfPic);
            $name = rand(100, 999) . '.' . $ext;
            $location = 'uploads/' . $name;
            $image = new SimpleImage();
            $image->createResizedImage($_FILES["profpic"]["tmp_name"],$location,500,500);


            //CHECK IF USERS ID EXIST ON DATABASE
            $IfUserExist = "SELECT * FROM users WHERE id = '$userid'";
            $res = $this->connect()->query($IfUserExist);
            $numIfUserExistRows = $res->num_rows;

            if($numIfUserExistRows > 0){
                $sql = "UPDATE users SET profpic = '$name' WHERE id='$userid'";
                if($this->connect()->query($sql)){
                    $_SESSION['showAlert'] = true;
                    echo ' Uploaded ';
                }else{
                    $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                    . $this->connect()->connect_error;
                    //header("location: profile.php");
                    // Close connection
                    $this->connect()->close();
                }
            }


            //DELETE the old pic from Directory
            $file_pointer = 'uploads/'.$oldprofpic;
            if($file_pointer != ''){
                if(!unlink($file_pointer)){
                    echo $file_pointer." Cannot be deleted due to an Error";
                }else{
                    echo $file_pointer." Photo has been Deleted";
                }
            }

        }

    }//end of function




    //Function for Save Cover Pic
    function SaveCoverPic(){
        $userid = $_POST['userid'];
        $oldcoverpic = $_POST['oldcoverpic'];
        
        if($_FILES["coverpic"]["name"] != '' || $_FILES["coverpic"]["name"] != NULL){
            //LOCAL FILE UPLOAD
            $CoverPic = explode('.', $_FILES["coverpic"]["name"]);
            $ext = end($CoverPic);
            $name = rand(100, 999) . '.' . $ext;
            $location = 'uploads/' . $name;
            move_uploaded_file($_FILES["coverpic"]["tmp_name"], $location);
            

            //CHECK IF USERS ID EXIST ON DATABASE
            $IfUserExist = "SELECT * FROM users WHERE id = '$userid'";
            $res = $this->connect()->query($IfUserExist);
            $numIfUserExistRows = $res->num_rows;
          
            if($numIfUserExistRows > 0){
                $sql = "UPDATE users SET coverpic = '$name' WHERE id='$userid'";
                if($this->connect()->query($sql)){
                    $_SESSION['showAlert'] = true;
                    echo 'Uploaded';
                }else{
                    $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                    . $this->connect()->connect_error;
                    //header("location: profile.php");
                    // Close connection
                    $this->connect()->close();
                }
            }

            //DELETE the old pic from Directory
            $file_pointer = 'uploads/'.$oldcoverpic;
            if($file_pointer != ''){
                if(!unlink($file_pointer)){
                    echo $file_pointer." Cannot be deleted due to an Error";
                }else{
                    echo $file_pointer." Photo has been Deleted";
                }
            }

        }

    }//end of function




}// End of Class Post

?>
