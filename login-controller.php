<?php
require_once('connect.php');
session_start();

class Login Extends Database{

    public function VerifyUserLogin(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $_POST['txt_uname'];
            $password = $_POST['txt_pwd'];
        
            //Check user Credentials
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $this->connect()->query($sql);
            $numRows = $result->num_rows;
        
            if($numRows == 1){
                while($row=mysqli_fetch_assoc($result)){
                    if(password_verify($password, $row['password'])){
                        $login = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['lastname'] = $row['lastname'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['gender'] = $row['gender'];
                        $_SESSION['birthday'] = $row['birthday'];
                        $_SESSION['phonenumber'] = $row['phonenumber'];
                        $_SESSION['profpic'] = $row['profpic'];
                        $_SESSION['userid'] = $row['id'];
                        header("location: home.php");
                    }else{
                        $_SESSION['showError'] = "Invalid Credentials!";
                        header("location: index.php");
                    }
                }
            }else{
                $_SESSION['showError'] = "User Already Exist!";
                header("location: index.php");
            }
        
        }//end if
    }

}


?>