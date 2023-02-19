<?php
require_once 'signup-controller.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $newSignUp = new SignUp();
    $newSignUp->CreateUser();
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
                <img src="images/logobanner.png" class="img-logo" width="90%" height="90%">
            </div>
            <div class="col-sm-12 col-md-4 card">
                <form method="post" action="<?php echo $_SERVER['PHP_SElF']?>" class="needs-validation" novalidate>
                <div class="row">
            <div class="col" id="sign-form">
                <h2 class="mt-3">Sign <span class="text-success">Up</span></h2>
                <form action="sign-up.php" method="post" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <input type="textbox" class="form-control" id="fname" name="firstname" placeholder="First name" required>
                                <label for="firstname" class="form-label">First name</label>
                                <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Please fill in</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="textbox" class="form-control" id="lname" name="lastname" placeholder="Last name" required>
                                <label for="lastname" class="form-label">Last name</label>
                                <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Please fill in</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                    <label for="email" class="form-label">Email</label>
                                    <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                    <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Please fill in</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                    <label for="password" class="form-label">Password</label>
                                    <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                    <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Please fill in</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-floating">
                                <select class="form-select" id="gender" name="gender" required>
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Prefer not to say</option>
                                </select>
                                <label for="gender" class="form-label">Gender</label>
                                <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Please fill in</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                <input type="number" class="form-control" id="phonenumber" name="phonenumber" placeholder="Enter your phone number" required>
                                <label for="phonenumber" class="form-label">Phone number</label>
                                <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Please fill in</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <h5>Birthday</h5>
                                <input type="date" id="txtDate"/>
                                <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Please fill in</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="check1" name="check" required>
                                    <label class="form-check-label" for="check1">Agree to <a type="button" class="terms" data-bs-toggle="modal" data-bs-target="#termsCon">terms and condition</a></label>
                                    <div class="valid-feedback"><i class="bi bi-hand-thumbs-up"></i></div>
                                    <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i>Check this checkbox to continue.</div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="create" value="Sign up" class="btn btn-outline-success w-100 mt-3 mb-3">
                </form>
            </div>
        </div>
    </div>
        

















        





<script src="login.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
</body>
        <div class="modal fade" id="termsCon">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Checkout</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            We don’t charge you to use Adventour or the other products and services covered by these Terms, unless we state otherwise. Instead, businesses and organizations, and other persons pay us to show you ads for their products and services. By using our Products, you agree that we can show you ads that we think may be relevant to you and your interests. We use your personal data to help determine which personalized ads to show you.

                            We don’t sell your personal data to advertisers, and we don’t share information that directly identifies you (such as your name, email address or other contact information) with advertisers unless you give us specific permission. Instead, advertisers can tell us things like the kind of audience they want to see their ads, and we show those ads to people who may be interested. We provide advertisers with reports about the performance of their ads that help them understand how people are interacting with their content. See Section 2 below to learn more about how personalized advertising under these terms works on the Meta Products.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</html>