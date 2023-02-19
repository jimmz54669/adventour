<?php
require_once 'login-controller.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $newLogin = new Login();
    $newLogin->VerifyUserLogin();
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/Logo1-122722.png" sizes="16x16 32x32" type="image/jpeg">
    <title>Adventour</title>
</head>
<body>
<div>
    <?php 
        if(isset($_SESSION['showAlert'])){
            echo '<div class="alert alert-success" role="alert">
                <strong>Success!</strong> Your account is now created and you can login
            </div> ';
            unset($_SESSION['showAlert']);
        }
        if(isset($_SESSION['showError'])){
            echo ' <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> '. $_SESSION['showError'].'
            </div> ';

            unset($_SESSION['showError']);
        }
    ?> 
    </div> 
    <div class="container" id="bukaspa">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <img src="images/logobanner.png" class="img-logo" width="100%" height="100%">
            </div>
            <div class="col-sm-12 col-md-4 card">
                <form method="post" action="<?php echo $_SERVER['PHP_SElF']?>" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col">
                            <div class="container mt-3">
                                <h1 class="fw-bold">Log<span class="text-success"> in</span></h1>
                            </div>
                            <div class="form-floating">
                                <input type="email" class="form-control my-2" id="txt_uname" name="txt_uname" placeholder="Enter email" required>
                                <label for="email" class="form-label">Email <i class="bi bi-envelope-fill"></i></label>
                                <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Please enter a valid email.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <input type="password" class="form-control my-2" id="txt_uname" name="txt_pwd" placeholder="Enter password" required>
                                <label for="password" class="form-label">Password <i class="bi bi-lock-fill"></i></label>
                                <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Your password must contain between 4 and 60 characters.</div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" value="submit" id="but_submit" class="btn btn-outline-success fw-bold w-100 mt-3">Log in</button>
                    <hr class="mt-3">
                    <div class="container-fluid mb-3" id="container">
                        <a href="sign-up.php" class="w-100">
                            <button type="button" class="btn btn-outline-primary w-100 fw-bold mt-1">Create new account</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>


    </footer>







    <script src="login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>