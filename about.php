<?php
include 'profile-controller.php';
include 'shop-class.php';
session_start();
//CHECK IF THE USER IS LOGGED IN WITH CORRECT CREDENTIALS
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventour</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!--BS 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--End of BS 5 CDN-->
    <link rel="icon" href="images/Logo1-122722.png" sizes="16x16 32x32" type="image/jpeg">
    <!--CSS-->
    <link rel="stylesheet" href="style2.css">
    <!--End of CSS-->

</head>
<body>
    <div class="container-fluid">
        <nav class="row navbar navbar-expand-sm" id="navbar">
            <div class="col-md-5 col-xl-3 col-lg-4 col-sm-12 nav-left container">
                <a class="navbar-brand" href="home.php">
                    <img src="images/Logo1-122722.png" width="50" height="40"><i class="fw-bold" id="logospell">Adventour</i>
                </a>
                <div class="col nav-back-forward">
                    <button class="btn" id="btnb" onclick="history.back()"><i class="bi bi-caret-left-fill backward"></i></button>
                    <button class="btn" id="btnf" onclick="history.forward()"><i class="bi bi-caret-right-fill forward"></i></button>
                </div>
            </div>
            <div class="col nav-right container-fluid">
                <div class="input-box">
                    <input type="text" class="site-search" placeholder="Search for Adventour">
                    <div id="searchlist"></div>
                    <button type="submit" class="search">
                        <i class="bi bi-search search-icon"></i>
                    </button>
                    <i class="bi bi-x-circle close-icon"></i>
                </div>
                <div class="nav-user-right">
                    <div class="nav-user-cart mx-2">
                        <?php $Shop = New Shop();
                        $GetCartCnt = $Shop->GetCartCnt();
                        ?>
                        <a href="cart.php"><i class="bi bi-cart3 cart"></i><span class="cart-count"><?php if(sizeof($GetCartCnt[0]['cartcnt']) > 0){ echo $GetCartCnt[0]['cartcnt'];} else{ echo "0";} ?></span></a>
                        
                    </div>
                    <div class="nav-user-icon online" onclick="settingsMenuToggle()">
                        <?php $ProfilePic = new Profile();
                        $GetProfilePic = $ProfilePic->GetUserProfPic();
                        if(sizeof($GetProfilePic[0]['picname']) > 0){
                        foreach($GetProfilePic as $profpic){ ?>
                            <img src="uploads/<?php echo $profpic['picname']; ?>" class="mini-pic">
                        <?php }}
                        else{?>
                            <img src="images/pp.png" class="mini-pic">
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="settings-menu">
                <div id="dark-btn">
                    <span></span>
                </div>
                <div class="settings-menu-inner">
                    <div class="user-profile">
                        <?php $ProfilePic = new Profile();
                        $GetProfilePic = $ProfilePic->GetUserProfPic();
                        if(sizeof($GetProfilePic[0]['picname']) > 0){
                        foreach($GetProfilePic as $profpic){ ?>
                            <img src="uploads/<?php echo $profpic['picname']; ?>" class="user-dp">
                        <?php }}
                        else{?>
                            <img src="images/pp.png" class="user-dp">
                        <?php }?>
                        <div>
                            <?php $UserInfo = New Profile();
                                $GetUserInfo = $UserInfo->GetUserInfo();
                                foreach($GetUserInfo as $row){
                                ?>
                                <p class="user-profile-name fw-bold"><?php echo $row['firstname'].' '.$row['lastname']; ?></p>
                            <?php }?>
                            <a href="profile.php">See your profile</a>
                        </div>
                    </div>
                    <hr>
                    <div class="user-profile">
                        <img src="images/logout.png">
                        <div>
                            <a href="logout.php"><p>Log out</p></a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    
    <!--============================================= RND OF NAV BAR ========================================-->


    <main>

        <div class="container-fluid">
 
            

            <div class="row">

                <!--==================== Left Section =================-->
                

                    <div class="left col-1 col-sm-0 col-md-1 col-lg-3 col-xl-2 col-xxl-2">
                        
                        <div class="side-menu-toggle">
                            <div class="hamburger">
                                <span></span>
                            </div>
                        </div> 

                        <aside class="sidenav" id="leftnav">

                            <a href="profile.php" class="profile shadow-sm" id="sideprofile">
                                <div class="logo-profile-photo">
                                    <?php $ProfilePic = new Profile();
                                    $GetProfilePic = $ProfilePic->GetUserProfPic();
                                    if(isset($GetProfilePic)){
                                    foreach($GetProfilePic as $profpic){ ?>
                                        <img src="uploads/<?php echo $profpic['picname']; ?>" class="post-pic">
                                    <?php }}
                                    else{?>
                                        <img src="images/pp.png" class="user-dp">
                                    <?php }?>
                                </div>
                                <div class="username">
                                    <div class="handle">
                                        <h6><?php echo $row['firstname'].' '.$row['lastname']; ?></h6>
                                        <div class="sub-handle">
                                            <p>
                                                View profile
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
            
                            <!---------------SIDE BAR----------------->
                            <div class="sidebar align-items-center shadow-sm" >
                                <a class="menu-item" href="home.php">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
                                        </svg>
                                    </span>
                                        <h3>Home</h3>
                                </a>
            
                                <a class="menu-item active" href="about.php">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                        </svg>
                                    </span>
                                        <h3>About</h3>
                                </a>
            
                                <a class="menu-item" href="messages.php" id="message-notifications">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                            <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                            <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                        </svg>
                                    </span>
                                    
    
                                        <h3>Messages</h3>
    
                                </a>
            
                                <a class="menu-item" href="newsfeed.php">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                            <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                                            <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                                        </svg>
                                    </span>
                                        <h3>Newsfeed</h3>
                                </a>
            
                                <div type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" class="menu-item">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-compass" viewBox="0 0 16 16">
                                            <path d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016zm6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                            <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z"/>
                                        </svg>
                                    </span>
                                        <h3>Maps</h3>
                                        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                                            <div class="offcanvas-header">
                                                <h1 class="offcanvas-title" id="offcanvasBottomLabel">Maps</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body small">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="calamity.php" class="btn" id="calamity-btn">Calamity Maps/Jeepney routes</a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="travelmaps.php" class="btn" id="costume-map">Travel map</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
            
                                <a class="menu-item" href="utilities.php">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                            <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/>
                                        </svg>
                                    </span>
                                        <h3>Utilities</h3>
                                </a>
            
                                <a class="menu-item" href="shop.php">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                        </svg>
                                    </span>
                                        <h3>Shop</h3>
                                </a>
            
                                <a class="menu-item" id="theme">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-palette" viewBox="0 0 16 16">
                                            <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                            <path d="M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8zm-8 7c.611 0 .654-.171.655-.176.078-.146.124-.464.07-1.119-.014-.168-.037-.37-.061-.591-.052-.464-.112-1.005-.118-1.462-.01-.707.083-1.61.704-2.314.369-.417.845-.578 1.272-.618.404-.038.812.026 1.16.104.343.077.702.186 1.025.284l.028.008c.346.105.658.199.953.266.653.148.904.083.991.024C14.717 9.38 15 9.161 15 8a7 7 0 1 0-7 7z"/>
                                        </svg>
                                    </span>
                                        <h3>Theme</h3>
                                </a>
            
                                <a class="menu-item" href="settings.php">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                        </svg>
                                    </span>
                                        <h3>Settings</h3>
                                </a>
                            </div>
                            <!-------------END OF SIDE BAR------------>
    
                            <div class="mb-5"></div>
                        </aside>

                    </div>
                <!--==================== End of Left Section =================-->

                <!--==================== Middle Section =================-->
                    <div class="middle col-12 col-md-11 col-lg-9 col-xl-10 col-xxl-10">
                        
                        <div class="carousel-container">
                            <div class="carousel-tuyok">

                                <div id="carouselExampleCaptions" class="carousel slide" style="width: 100%;" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="7" aria-label="Slide 8"></button>
                                    </div>
                                    <div class="carousel-inner">
                                    <div class="carousel-item active bg-cover" style="background: linear-gradient(rgba(1, 1, 27, 0.014),rgba(0, 0, 0, 0.041),rgba(0, 0, 0, 0.178)), url(images/davaowelcomebanner1.png);" data-bs-interval="5000">
                                    </div>
                                    <div class="carousel-item bg-cover" style="background: linear-gradient(rgba(1, 1, 27, 0.055),rgba(0, 0, 0, 0.719),rgb(0, 0, 0)), url(images/kadayawan.jpg)" data-bs-interval="5000">
                                        <div class="carousel-content d-flex text-start align-items-center" id="carcontent2">
                                            <div class="row">
                                                <div class="col-12">  
                                                    <h4 class="text-white fw-bold">Learn the culture and diversity of the</h4>
                                                    <h3 class="display-4 text-white fw-bold"> King City of the <span style="color: var(--color-adventour); font-weight: bold;">South</span></h3>
                                                    <a href="home.php" class="btn btn-carousel btn-sm fw-bold mt-2 mb-2">Learn about Davao City's history</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item bg-cover" style="background: linear-gradient(rgba(1, 1, 27, 0.11),rgba(0, 0, 0, 0.671),rgba(0, 0, 0, 0.925)), url(images/ppark.jpg)" data-bs-interval="5000">
                                        <div class="carousel-content text-end" id="carcontent3">
                                            <div class="row">
                                                <div class="col-12">  
                                                    <h4 class="text-white fw-bold">Discover and start your journey into the heart of </h6>
                                                    <h2 class="display-4 text-white fw-bold">Davao <span style="color: var(--color-adventour); font-weight: bold;">City</span></h2>
                                                    <a href="maps.php" class="btn btn-carousel btn-sm fw-bold mt-2 mb-2">Explore, Unwind, Adventure</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item bg-cover" style="background: linear-gradient(rgba(1, 1, 27, 0.055),rgba(0, 0, 0, 0.671),rgb(0, 0, 0)), url(images/sanped.jpg)" data-bs-interval="5000">
                                        <div class="carousel-content text-start" id="carcontent4">
                                            <div class="row">
                                                <div class="col-12">  
                                                    <h4 class="text-white fw-bold">Feeling Lost? Reach out to </h6>
                                                    <h2 class="display-4 text-white fw-bold">Fellow <i>Adven</i><span style="color: var(--color-adventour); font-weight: bold;"><i>tourers</i></span></h2>
                                                    <a href="newsfeed.php" class="btn btn-carousel btn-sm fw-bold mt-2 mb-2">See Newsfeed</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item bg-cover" style="background: linear-gradient(rgba(1, 1, 27, 0.11),rgba(0, 0, 0, 0.671),rgba(0, 0, 0, 0.925)), url(images/hiking.jpg)" data-bs-interval="5000">
                                        <div class="carousel-content text-end" id="carcontent8">
                                            <div class="row">
                                                <div class="col-12">  
                                                    <h5 class="text-white fw-bold">Emergency first aid kits and survival tools?  </h6>
                                                    <h4 class="display-4 text-white fw-bold">Visit <i>Adven</i><span style="color: var(--color-adventour); font-weight: bold;"><i>store</i></span> </h4>
                                                    <a href="shop.php" class="btn btn-carousel btn-sm fw-bold mt-2 mb-2">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item bg-cover" style="background: linear-gradient(rgba(1, 1, 27, 0.11),rgba(0, 0, 0, 0.671),rgba(0, 0, 0, 0.925)), url(images/digong.jpg)" data-bs-interval="5000">
                                        <div class="carousel-content" id="carcontent5">
                                            <div class="row">
                                                <div class="col-12">  
                                                    <h4 class="text-white fw-bold">Be versatile and efficient in </h6>
                                                    <h2 class="display-4 text-white fw-bold"> Every<span style="color: var(--color-adventour); font-weight: bold;"> Situation</span></h2>
                                                    <a href="utilities.php" class="btn btn-carousel btn-sm fw-bold mt-2 mb-2">See Utilities</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item bg-cover" style="background: linear-gradient(rgba(1, 1, 27, 0.007),rgba(0, 0, 0, 0.671),rgba(0, 0, 0, 0.925)), url(images/baha.jpg)" data-bs-interval="5000">
                                        <div class="carousel-content text-end" id="carcontent6">
                                            <div class="row">
                                                <div class="col-12">  
                                                    <h4 class="text-white fw-bold">Above everything </h6>
                                                    <h2 class="display-4 text-white fw-bold"> We value <span style="color: var(--color-adventour); font-weight: bold;"> Life</span> the most</h2>
                                                    <a href="community.html" class="btn btn-carousel btn-sm fw-bold mt-2 mb-2"> Learn about the hazard zones within Davao City</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item bg-cover" style="background: linear-gradient(rgba(1, 1, 27, 0.11),rgba(0, 0, 0, 0.671),rgba(0, 0, 0, 0.925)), url(images/bata.jpg)" data-bs-interval="5000">
                                        <div class="carousel-content" id="carcontent7">
                                            <div class="row">
                                                <div class="col-12">  
                                                    <h4 class="text-white fw-bold">More fun awaits for you in the </h6>
                                                    <h2 class="display-4 text-white fw-bold">Crown Jewel of<span style="color: var(--color-adventour); font-weight: bold;"> Mindanao</span></h2>
                                                    <a href="home.php" class="btn btn-carousel btn-sm fw-bold mt-2 mb-2">Learn More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    </div>
                                    
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
    
                            </div>
                            
                        </div>

                        <div class="feedcage container mb-1">

                            <div class="feeds">
                                

                                    <!--Hero-->

                                    <div id="sectioninfo">
                                        <div class="container">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-lg-8 col-xl-8 col-md-8 col-xxl-6">
                                                        <div class="row">
                                                            <div class="col-12 info-box">
                                                                <h2 class="text-center fw-bold mb-2 display-5">Welcome to <i>Adven</i><span style="color: var(--color-adventour); font-weight: bold;"><i>tour</i></span></h2>
                                                                <p class="lead text-center mb-4">"Explore and get lost in paradise within the durian capital of the Philippines"</p>
                                                                <div class="d-grid gap-3 mb-3 d-sm-flex justify-content-center">
                                                                    <a class="btn btn-outline-success btn-large btn-sm text-uppercase" href="#about"> Learn, Explore, Discover
                                                                        <span class="material-icons-outlined ms-2">help_outline</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-box-image col-lg-4 col-xl-3 col-xxl-3 col-md-4 mb-1 justify-content-center">
                                                        <img src="./images/Logo1-122722.png">
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <!--End Hero -->

                                <hr>

                                    
                                    <!--About-->
                                    <div id="about" class="text-center">
                                            <div class="container py-5">
                                                <div class="row justify-content-center">
                                                    <h1 class="fw-bold mb-3"> <i>Adven<span style="color: var(--color-adventour); font-weight: bold;">tour</span></i></h1>
                                                    <!--<p class="lead text-muted mb-2">We intended to connect and engage the residents and the visitors to explore, learn and discover the natural beauty, 
                                                        culture, and diversity of the people of Davao City.
                                                    </p>-->

                                                    <p class="lead mb-5">
                                                        This platform aims to disseminate important information readily available to the public through the innovation of the online technology and 
                                                        for everyone to become a responsible and well prepared citizens of the King City of the South in times of need.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="container mb-5">
                                                <div class="row">
                                                    <div class="col-lg-4 mx-auto mb-5">
                                                        <div class="d-flex mb-5 about">
                                                            <span class="material-icons-outlined m-auto" style="color: var(--color-adventour);">sports_kabaddi</span>
                                                        </div>
                                                        <h2>Mission</h2>
                                                        <p class="mb-0">Our mission is to connect and engage the residents and visitors of Davao City, no matter the age, gender, 
                                                            ethnicity, beliefs, culture, diversity, politics, and principles.
                                                        </p>            
                                                        <br>
                                                        <p class="mb-0">To provide every important information needed in this platform, we aim to inform, provide, prepare, 
                                                            and educate everyone about disaster mitigation, risk location, survivability and disaster preparedness. 
                                                        </p>          
                                                    </div>
                                                    <div class="col-lg-4 mx-auto mb-5">
                                                        <div class="d-flex mb-5 about">
                                                            <span class="material-icons-outlined m-auto" style="color: var(--color-adventour);">query_stats</span>
                                                        </div>
                                                        <h2>Vision</h2>
                                                        <p class="mb-0">We envision a world where the residents of Davao City are connected together and is well equiped with knowledge and prepared for any calamity that might struck the region, minimizing the damages and casualties that might help and improve the efficiency of search and rescue missions of NDRRMC. </p>
                                                        <br>
                                                        <p class="mb-0"> We aim to provide the city with timely updates, and whereabouts of the victims of calamities through the location of their recent posts on the platform and their social media, and to provide general information to the public about the risk and safe zones within the city and the location of evacuation areas close to their vicinity. </p>                
                                                    </div>
                                                    <div class="col-lg-4 mx-auto mb-5">
                                                        <div class="d-flex mb-5 about">
                                                            <span class="material-icons-outlined m-auto" style="color: var(--color-adventour);">sports_score</span>
                                                        </div>
                                                        <h2>Goal</h2>
                                                        <p class="mb-0">With the advancement of the technology and innovation, <i><b>Adven</b></i><span style="color: var(--color-adventour);"><b><i>tour</i></b></span> aim's to educate tourists, families, and the entire community, and bringing everyone closer together, keeping everyone engaged to interact, explore, and discover the hidden beauty of the Crown Jewel of the South in Mindanao</p>                      
                                                    </div>
                                                </div>
                                            </div>

                                            
                                    </div>
                                    <!--End About-->

                                <hr>

                                    <!--Courses-->
                                <div id="courses" class="py-5 align-items-center justify-content-center">
                                    <div class="container text-center align-items-center py-5">
                                        <div class="row justify-content-center">
                                            <h2 class="fw-bold">About the Deve<span style="color: var(--color-adventour)">lopers</span></h2>
                                            <p class="lead text-muted mb-5">Meet the bright minds behind this platform reponsible for the idea and making this amazing website</p>
                                        </div>
                                    </div>
                                    <div class="container text-center mb-5">
                                            
                                        <div class="col-12 ">

                                            <div class="row d-flex align-items-center">

                                                <div class="dev-image-container col-12 col-sm-12 col-md-5">
                                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                          <div class="carousel-item active">
                                                            <img src="./images/jimmyserious.jpg" class="d-block w-100" alt="...">
                                                          </div>
                                                          <div class="carousel-item">
                                                            <img src="./images/jimmybuang1.jpg" class="d-block w-100" alt="...">
                                                          </div>
                                                          <div class="carousel-item">
                                                            <img src="./images/jimmybuang2.jpg" class="d-block w-100" alt="...">
                                                          </div>
                                                        </div>
                                                      </div>
                                                </div>
    
                                                <div class="dev-info col-12 col-sm-12 col-md-7 mt-5">
                                                    <h3 class="text-muted text-start">Jimmy D. <span style="color: var(--color-adventour);">Ortiz</span> III, RMT</h3>
                                                    <hr>
                                                    <p class="lead ">
                                                        "A boy from Barangay 21-C, who grew up in the slums of Boulevard, Downtown, Davao City, Now living his life to the fullest 
                                                        with a dream for his beloved city and country."
                                                    </p>

                                                    <p class=" text-start">
                                                        Jimmy is a graduate of Bachelor of Medical Laboratory Science from the Davao Doctor's College, and passed the Board Exams last September 2018. 
                                                        Since then, He worked on his profession and became a Medical Technologist on duty at Surelab Diagnostic Center, Davao City last 2018 up to 2019 and a Clinical Instructor at the 
                                                        Davao Doctor's College last 2019 - 2020. 
                                                    </p>

                                                    <p class=" text-start">
                                                        He also served as a Covid-19 Swabber and Responder during the height of the pandemic starting from 2022 up to 2021, and been reassigned to Los Amigos 
                                                        Molecular Laboratory as a Molecular Laboratory Analyst starting 2021 up to present day.
                                                    </p>

                                                    <p class="text-muted text-start">
                                                        He dreams of uniting the people of land of promise as one, despite the differences in <span class="fw-bold">ethnicity, gender, race, beliefs, perspective, 
                                                        ages, status, and diversity</span>. 
                                                        Each and everyone shares the same gene and are brothers and sisters in God's eye.
                                                    </p>

                                                    <h5 class="fw-bold text-muted text-start">
                                                       <i> "If there is no more pig under your house, nothing will eat the scum that stick on your walls"</i>
                                                    </h5>
                                                </div>
    

                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <br>
                                            <br>
                                            <br>

                                            <div class="row d-flex align-items-center">
    
                                                <div class="dev-info col-12 col-sm-12 col-md-7">
                                                    <h3 class="text-muted text-end">Sied Jeremiah C. <span style="color: var(--color-adventour);">Ibarra</span>, RMT</h3>
                                                    <hr>
                                                    <p class="lead text-muted">
                                                        "A boy from Tagum City, who grew in Kabacan, North Cotabato, Now living his life to the fullest with a dream for 
                                                        his beloved city and country."
                                                    </p>

                                                    <p class="text-muted text-end">
                                                        Sied is a graduate of Bachelor of Medical Laboratory Science from the University of the Immaculate Concepcion, and passed the Board Exams last August 2017. 
                                                        Since then, He worked on his profession and became a Clinical Instructor at the University of the Immaculate Conception last 2017 up to 2019 and at the 
                                                        Davao Doctor's College last 2019 - 2020. 
                                                    </p>

                                                    <p class="text-muted text-end">
                                                        He also served as a Covid-19 Swabber and Responder during the height of the pandemic starting from 2022 up to 2021, and been reassigned to Los Amigos 
                                                        Molecular Laboratory as a Molecular Laboratory Analyst starting 2021 up to present day.
                                                    </p>

                                                    <p class="text-muted text-end">
                                                        He dreams of uniting the people of land of promise as one, despite the differences in <span class="fw-bold">ethnicity, gender, race, beliefs, perspective, 
                                                        ages, status, and diversity</span>. 
                                                        Each and everyone shares the same gene and are brothers and sisters in God's eye.
                                                    </p>

                                                    <h5 class="fw-bold text-muted text-end">
                                                       <i> "Time is gold when watching bold."</i>
                                                    </h5>
                                                </div>
    
                                                <div class="dev-image-container col-12 col-sm-12 col-md-5">
                                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                          <div class="carousel-item active">
                                                            <img src="./images/siedseious.jpg" class="d-block w-100" alt="...">
                                                          </div>
                                                          <div class="carousel-item">
                                                            <img src="./images/siedbuang1.jpg" class="d-block w-100" alt="...">
                                                          </div>
                                                          <div class="carousel-item">
                                                            <img src="./images/siedbuang2.jpg" class="d-block w-100" alt="...">
                                                          </div>
                                                        </div>
                                                      </div>
                                                </div>

                                            </div>

                                        </div>

                                        <br>
                                        <br>
                                        <br>
                                        <br>    

                                        <div class="col-12">

                                            <div class="dev-image-container">
                                                <div id="carouselExampleSlidesOnly1" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner-bottom">
                                                      <div class="carousel-item bottom active">
                                                        <img src="./images/IMG20230210112125 (1).jpg" class="d-block w-100" alt="..." style="object-fit: cover;" height="500px">
                                                      </div>
                                                      <div class="carousel-item bottom">
                                                        <img src="./images/IMG20230210112047 (1).jpg" class="d-block w-100 " alt="...">
                                                      </div>
                                                      <div class="carousel-item bottom">
                                                        <img src="./images/IMG20230210112158 (1).jpg" class="d-block w-100" alt="...">
                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <br>
                                            <br>

                                            <div class="dev-info">
                                                
                                                <h4 class="text-muted">
                                                    <i>"Tough times don't last when you live for the moments you can't put into words."</i>
                                                </h4>

                                                <p class="text-muted">
                                                    Sticks in a bundle is quite unbreakable. The same is true to both Jimmy and Sied. They have been buddies 
                                                    since 2014 along with their sqaud, sharing the same pains,sufferings and sucess of college life. 
                                                </p>

                                                <p class="text-muted">
                                                    With nothing else to loose and only have each other's back, Sied and Jimmy's squad were founded at the 
                                                    UIC Bankerohan Campus. Having different set of goals, dreams, classrooms, and class schedules, they still 
                                                    manage to create an unbreakable bond, unique from the other friends they have.
                                                </p>

                                                <p class="text-muted">
                                                    Under the same school, they shared each other's secret, achievements, and goals. Now, time flies fast, everyone are starting 
                                                    their own family, but for Jimmy and Sied, Life is only beginning to unfold on their very eyes.
                                                </p>

                                                <p class="text-muted">
                                                    They dreamt of having a happier and safer city for their children to live in, and also for the next generations to come. 
                                                    They wanted to make every important information available to the public and catch up with the extremely fast changes of the seasons and of the innovation
                                                    of the technology.
                                                </p>

                                                <p class="text-muted">
                                                    With this platform, they aim to engage the masses in a positive revolution towards a better future for their country and city.
                                                </p>

                                            </div>
                                        </div>

                                        <br>
                                        <hr>

                                        <div class="row mt-5">

                                            <div class="container-image col-12 col-md-5">
                                                <div class="dev-bottom-image">
                                                    <div class="img-wrapper">
                                                        <img src="./images/devimgbottom1.jpg" alt="Devs">
                                                        <div class="overlay">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="courses" class="col-12 col-md-7 align-items-center justify-content-center">
                                                <div class="container text-center align-items-center py-5">
                                                    <div class="row justify-content-center">
                                                        <h2 class="fw-bold">Thank you for Joining the <i>Adven<span style="color: var(--color-adventour)">tour</span></i> family</h2>
                                                        <p class="lead text-muted mb-5">Let us make Davao City great, starting from you</p>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                            
                                    </div>
                              
                                </div>

                                
                            </div>
    
                            <div class="bottom-filler mb-1"></div>
    
    
                        </div>

                    </div>
                <!--==================== End of Middle Section =================-->


            </div>

        </div>

    </main>

    <!--======================== Theme Customization =========================-->

    <div class="customize-theme">
        <div class="card">
            <div class="theme-title">
                <h3 class="fw-bold">Theme Preferences</h3>
            </div>
            

            <!------ FONT SIZE CUSTOMIZATION ------->

            <div class="font-size">
                <h5 class="mb-3">Font Size</h5>
                <div>
                    <h6>Aa</h6>
                    <div class="choose-size">
                        <span class="font-size-1 active"></span>
                        <span class="font-size-2"></span>
                        <span class="font-size-3"></span>
                        <span class="font-size-4"></span>
                        <span class="font-size-5"></span>
                    </div>
                    <h3>Aa</h3>
                </div>
            </div>

            <!------ END OFFONT SIZE CUSTOMIZATION ------->

            <!------ THEME COLORS ------->

            <div class="color">
                <h5 class="mb-3">Theme Color</h5>
                <div class="choose-color">
                    <span class="color-1 active"></span>
                    <span class="color-2"></span>
                    <span class="color-3"></span>
                    <span class="color-4"></span>
                    <span class="color-5"></span>
                    <span class="color-6"></span>
                </div>
            </div>

            <!------ END OFFONT THEME COLORS ------->




        </div>
    </div>

    <!--======================== End of Theme Customization =========================-->




    
    <script src="navjs.js"></script>
    <script src="post-controller.js"></script>
    <script src="post-tag-location.js"></script>
    <script src="profile-controller.js"></script>
    <!--KGL JSON-->
    <script src="./Downtown.kgl.json"></script>
    <script src="./Downtown.json"></script>
    <!--END OF KGL JSON-->
    <script src="site-search.js"></script>
</body>
</html>

    