<?php
require_once('connect.php');
session_start();

class SignUp extends Database {

   public function CreateUser(){
    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $firstname   = $_POST['firstname'];
            $lastname    = $_POST['lastname'];
            $email       = $_POST['email'];
            $password    = $_POST['password'];
            $gender      = $_POST['gender'];
            $phonenumber = $_POST['phonenumber'];
            $birthday    = $_POST['birthday'];
        
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        
            //CHECK IF FORM DATA EXIST ON DATABASE
            $IfUserExist = "SELECT * FROM users WHERE email = '$email'";
            $res = $this->connect()->query($IfUserExist);
            $numIfUserExistRows = mysqli_num_rows($res);
        
            
            if($numIfUserExistRows > 0){
                //If user already exist in the database
                $_SESSION['showError'] = "User Already Exist!";
                // Close connection
                $this->connect()->close();
                header("location: sign-up.php");
            }
            else{
                //IF user not exist in the database
                // INSERT FORM DATA INTO DATABASE
                    if(isset($_POST['create'])){
                        $sql = "INSERT INTO users (firstname, lastname, email, password, gender, phonenumber, birthday) VALUES ('$firstname','$lastname','$email','$pass_hash','$gender','$phonenumber','$birthday')";
                        if($this->connect()->query($sql)){
                            $_SESSION['showAlert'] = true;
                        }else{
                            echo 'asa mani';
                            $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                                . $this->connect()->close();
                                header("location: sign-up.php");
                        }
                    } else{
                        echo 'diri';
                        $_SESSION['showError'] = "ERROR: Hush! Sorry "
                            . $this->connect()->close();
                            header("location: sign-up.php");
                    }
                        // Close connection
                       $this->connect()->close();
                    header("location: index.php");
        
            }//Else
        }//end if
    }//End of Function



}// End of Class


?>