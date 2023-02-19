<?php
include 'newsfeed-controller.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="nav.css">
    
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>

    <link rel="icon" href="images/Logo1-122722.png" sizes="16x16 32x32" type="image/jpeg">

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <title>Adventour</title>
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
    
    <!--side nav bar-->
    <main>

        <div class="container-fluid">
            <div class="row">

                <!--==================== Left Section =================-->
                    <div class="left col-12 col-md-0 col-lg-3 col-xl-2 col-xxl-2">
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
                                        <h6><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></h6>
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
                                <a class="menu-item" href="about.php">
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
                                <a class="menu-item active" href="newsfeed.php">
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
                    <div class="middle col-12 col-md-9 col-lg-7 col-xl-8 col-xxl-8">
                        <div class="feedcage container mt-1 mb-5">

                            <div class="feeds d-flex justify-content-center">
                                        <div class="col-lg-10">
                                            <div class="create-post shadow mb-2 card">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <div class="user-id-post">
                                                            <?php $ProfilePic = new Profile();
                                                            $GetProfilePic = $ProfilePic->GetUserProfPic();
                                                            if(isset($GetProfilePic)){
                                                            foreach($GetProfilePic as $profpic){ ?>
                                                                <img src="uploads/<?php echo $profpic['picname']; ?>" class="post-pic">
                                                            <?php }}
                                                            else{?>
                                                                <img src="images/pp.png" class="post-pic">
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <div class="user-mini-pic">
                                                        <input type="text" class="post-text" name="post-txt" id="post-txt" placeholder="Write Something..." required>
                                                            <input type="file" class="btn post-photo" name="buttonPostPhoto" id="photo_post" hidden/>
                                                            <label class="user-mini-pic-label" for="photo_post"><i class="bi bi-image-fill" id="img-post-btn"></i></label>
                                                            <button class="btn post-location"><i class="bi bi-geo-alt-fill"></i></button>
                                                            <button type="submit" class="btn post-btn" data-userid ="<?php echo $_SESSION['userid']; ?>" name="buttonSubmit" id="btn_sub" value="submit">Post</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>       


                                            <?php
                                            $NewsFeedPosts = new NewsFeed();
                                            $GetNewsFeedPosts = $NewsFeedPosts->GetAllPost();
                                            foreach($GetNewsFeedPosts as $GetNewsFeedPost){
                                            if(isset($GetNewsFeedPost['pid'])){?>
                                            <div class="profile-post shadow card">
                                                <div class="user-post">
                                                    
                                                    <img src="uploads/<?php echo $GetNewsFeedPost['picname']; ?>" class="post-pic">
                                                    
                                                    <a href="" data-userid="<?php echo $GetNewsFeedPost['userid']; ?>" class="user-direct-profile"><h5 class="user-post-name"><?php echo $GetNewsFeedPost['firstname'].' '.$GetNewsFeedPost['lastname']; ?></h5></a>
                                                    &nbsp; -  &nbsp;<p class="text-muted"><?php echo $GetNewsFeedPost['dateposted'];?></p>
            
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-title">
                                                        <input type="text" class="edit-title-post" id="edit-title-post-<?php echo $GetNewsFeedPost['pid'];?>" value="<?php echo $GetNewsFeedPost['body']; ?>" hidden/>
                                                        <input type="text" id="old-title-post-<?php echo $GetNewsFeedPost['pid'];?>" value="<?php echo $GetNewsFeedPost['body']; ?>"  hidden/>
                                                        <h3 class="user-post-title" id="user-post-title-<?php echo $GetNewsFeedPost['pid'];?>"><?php echo $GetNewsFeedPost['body']; ?></h3> <p>-<i class="bi bi-geo-alt"></i><?php echo $GetNewsFeedPost['postlocation']; ?></p>
                                                    </div>
                                                    <div class="post-body">
                                                    <input type="file" class="btn img-edit-post-input" name="buttonEditPhoto" id="img_edit_post_<?php echo $GetNewsFeedPost['pid']; ?>" hidden/>
                                                            <label class="btn img-edit-post" for="img_edit_post_<?php echo $GetNewsFeedPost['pid']; ?>" id="img-edit-post-<?php echo $GetNewsFeedPost['pid'];?>" hidden><i class="bi bi-camera-fill"></i></label>
                                                        <?php if(isset($GetNewsFeedPost['postpicname'])){?>
                                                            <img src="uploads/<?php echo $GetNewsFeedPost['postpicname'];?>" class="post-user-pc">
                                                        <?php }?>
                                                    </div>
                                                    <div class="submit-comment">
                                                        <input type="text" class="comment-body" id="comment-body-<?php echo $GetNewsFeedPost['pid']; ?>" placeholder="Write comment here...">
                                                        <button type="submit" class="btn btn-sm comment-btn"  data-postid="<?php echo $GetNewsFeedPost['pid']; ?>" data-userid ="<?php echo $_SESSION['userid']; ?>">Submit</button>
                                                    </div>
                                                    <hr>
                                                    <?php 
                                                    $NewsFeedComments = new NewsFeed();
                                                    $GetNewsFeedComments = $NewsFeedComments->GetAllComments();
                                                    foreach($GetNewsFeedComments as $GetNewsFeedComment){
                                                        if($GetNewsFeedPost['pid'] == $GetNewsFeedComment['postid']){
                                                        ?>
                                                            <div class="comment-content">
                                                                <div class="own-comment">
                                                                    <div class="user-comment">
                                                                        <img src="uploads/<?php echo $GetNewsFeedComment['picname'];?>" class="post-pic">
                                                                        <a href="" data-userid="<?php echo $GetNewsFeedComment['userid']; ?>" class="user-direct-profile">
                                                                            <h5 class="user-name2"><?php echo $GetNewsFeedComment['firstname'].' '.$GetNewsFeedComment['lastname']; ?></h5>
                                                                        </a>
                                                                    </div>
                                                                    <div class="user-comment-content">
                                                                        <p class="user-comment1">-<?php echo $GetNewsFeedComment['content']?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php }}?>
                                                </div>
                                            </div>
                                            <br>
                                        <?php }} ?>
                                        </div>
        
                            </div>
    
                            <div class="bottom-filler mb-5 d-flex align-items-center justify-content-center">

                                <p>You've caught up for now</p>

                            </div>
    
    
                        </div>

                    </div>
                <!--==================== End of Middle Section =================-->


                <!--==================== Right Section =================-->
                    <div class="right col-12 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                        
                        <!---Weather-->
                        <div class="mt-2">
                            <div class="wrapper shadow">
                                <header><i class="bi bi-arrow-left-circle"></i>Weather</header>
                                <section class="input-part">
                                    <p class="info-txt"></p>
                                    <input type="text" class="city" placeholder="Enter city name" spellcheck="false" required>
                                    <div class="separator"></div>
                                    <button class="city-btn">Get device Location</button>
                                </section>
                                <section class="weather-part">
                                    <img src="#" alt="Weather icon">
                                    <div class="temp">
                                        <span class="numb">_</span>
                                        <span class="deg">°C</span>
                                    </div>
                                    <div class="weather">_ _</div>
                                    <div class="location">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>_, _</span>
                                    </div>
                                    <div class="bottom-details">
                                        <div class="column feels">
                                            <div class="row">
                                                <div class="col-12 col-xl-5">
                                                    <i class="bi bi-thermometer-high"></i>
                                                </div>
                                            <div class="col-12 col-xl-3 details">
                                                <div class="temp">
                                                    <span class="numb-2">_</span>
                                                    <span class="deg">°C</span>
                                                </div>
                                                <p>Climate</p>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        <div class="column humidity">
                                            <div class="row">
                                                <div class="col-12 col-xl-5">
                                                    <i class="bi bi-droplet-half"></i>
                                                </div>

                                                <div class="col-12 col-xl-3">
                                                    <div class="details">
                                                        <span>_</span>
                                                        <p>Humidity</p>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!--realtime clock-->
                        <div class="clock shadow-lg">
                            <div id="MyClockDisplay" class="card"></div>
                        </div>
                    </div>
                <!--==================== End of Right Section =================-->

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

    
    <!--calendar-->
   <!-- Modal Post Tag Location -->
<div class="modal fade hide" id="post-tag-location-modal" tabindex="-1" aria-labelledby="postTagLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="postTagLocationModalLabel">Get Location Tag</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div id='map' style='width: 450px; height: 350px;'></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</div>
    







    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="navjs.js"></script>
    <script src="post-controller.js"></script>
    <script src="post-tag-location.js"></script>
    <script src="profile-controller.js"></script>
    <script src="viewprofile-controller.js"></script>
    <script src="site-search.js"></script>
</body>
</html>