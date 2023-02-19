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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="nav.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" type="text/css">
    <link rel="icon" href="images/Logo1-122722.png" sizes="16x16 32x32" type="image/jpeg">
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
                                        <h6><?php echo $row['firstname'].' '.$row['lastname']; ?></h6>
                                    </div>
        
                                    <div class="sub-handle">
                                        <p>
                                            View profile
                                        </p>
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
                                        <small class="notification-count">6</small>
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
            
                                <div type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" class="menu-item active">
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
                            <button type="submit" class="side-footer btn fw-bold rounded-pill mb-5">Create Post</button>
    
                            <div class="mb-5"></div>
                        </aside>

                    </div>
                <!--==================== End of Left Section =================-->
                    <div class="middle col-12 col-md-9 col-lg-7 col-xl-8 col-xxl-8">
                            
                            <div class="feedcage container mb-5">

                                <div class="feeds">
                                
                                    <div class="feed">
                                        
                                        <div class="head">
                                            <div class="user">
                                                <div class="profile-photo">
                                                    <img src="images/Logo1-122722.png">
                                                </div>
                                                <div class="user-info">
                                                    <h3> Davao City Border</h3>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="map-photo">
                                            <div class="container" id="map-main-photo">
                                                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1A3inty7sxqEvf_GpowuyjGiaf-JV2Yk&ehbc=2E312F" width="100%" height="100%"></iframe>
                                            </div>
                                        </div>
            
                                        <div class="caption">
                                            <h6 style="color: var(--color-adventour); font-weight: bold;">Physical Characteristics</h6>

                                            <p>Davao City has a total land area of 2,444 sq.km., making it the<span style="color: var(--color-adventour); font-weight: bold;"> 
                                                largest city in the Philippines in terms of land area</span> .
                                            </p>

                                            <p>
                                                It is divided into 3 congressional districts and further divided into 11 administrative districts. Poblacion and 
                                                Talomo Districts comprise District I, while Congressional District II is composed of the following administrative 
                                                districts, namely: Agdao, Buhangin, Bunawan and Paquibato. District III includes Toril, Tugbok, Calinan, Baguio 
                                                and Marilog.
                                            </p>

                                            <p>
                                                Davao City is geographically situated in the southeastern part of Mindanao, lying in the grid squares of 6°58' to 7°34' 
                                                N latitude, and 125°14' to 125°40' E longitude. It is bounded on the north by Agusan del Sur Province; on the east,
                                                partly by Davao del Norte Province and Davao Gulf; on the south, by Davao del Sur; and on the west1 by Bukidnon Province, 
                                                the Provinces of North and South Cotabato, and Sarangani Province. Davao City Proper is approximately 946 aerial kilometers 
                                                or 588 statute miles, southeast of Manila.
                                            </p>

                                            <p>
                                                Because of its strategic location and being the administrative center of Davao Region, the City serves as the main entry 
                                                point for the Brunei Darussalam – Indonesia – Malaysia – Philippines East ASEAN Growth Area (BIMP-EAGA), making it the 
                                                primary center of development in Mindanao (www.davaocity.gov.ph).
                                            </p>
                                            
                                            <span class="fw-bold"> #DavaoCity<br>#Largestcityintermsoflandarea</span>
                                        </div>
            
                                    </div>

                                    <div class="feed">
                                        
                                        <div class="head">
                                            <div class="user">
                                                <div class="profile-photo">
                                                    <img src="images/Logo1-122722.png">
                                                </div>
                                                <div class="user-info">
                                                    <h3> Davap City Flood Map</h3>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="map-photo">
                                            <div class="container" id="map-main-photo">
                                                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1ipys20K5bbRGLCB3XpYgw70KTABBEE4&ehbc=2E312F" width="100%" height="100%"></iframe>
                                            </div>
                                        </div>
                                        <div class="caption">

                                            <b style="color: var(--color-adventour);">The Davao River Basin</b>
                                            
                                            <p> 
                                                is located in the southern part of Mindanao. It is considered as the 15th
                                                largest river basin in the Philippines. It is also considered as the largest of Davao City's nine
                                                (9) principal catchments, namely Lasang, Bunawan, Panacan, Matina, Davao, Talomo, Lipadas
                                                and portions of Inawayan and Sibulan. It covers an estimated basin area of 1,623 square kilometers. 
                                            </p>

                                            <p>
                                                It traverses from as far as the Salug River in San Fernando, Bukidnon and flows outward
                                                through the provinces of Bukidnon, Davao del Sur, Davao del Norte and North Cotabato. It
                                                opens eastward and drains into Gulf of Davao. 
                                            </p>

                                            <p>
                                                Those who are living in flood prone areas and landslide danger zones should prepare for pre-emptive 
                                                evacuation whenever ordered by the City Government or conduct their own evacuation when they perceive 
                                                that their safety is at risk. 
                                            </p>

                                            <br>

                                            <h5 style="color: var(--color-adventour); font-weight: bold;">Identified areas</h5>

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseone" aria-expanded="false" aria-controls="collapseone">
                                                        <p class="accordion-title">River System: Lipadas River</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapseone" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Lubogan</p>


                                                                <ul>
                                                                    <li>Purok - 16</li>
                                                                    <li>Purok - 2</li>
                                                                    <li>Kristina Homes</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Toril Poblacion</p>


                                                                <ul>
                                                                    <li>Old Toril public market</li>
                                                                    <li>Manambulan - Tagakpan road with Toril Poblacion</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Crossing Bayabas</p>


                                                                <ul>
                                                                    <li>Crossing Bayabas National High School</li>
                                                                    <li>Riverside</li>
                                                                    <li>Venus Street</li>
                                                                    <li>Purok - 1</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Lizada</p>


                                                                <ul>
                                                                    <li>Sitio Samuel</li>
                                                                    
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Marapangi</p>


                                                                <ul>
                                                                    <li>Near Barangay Hall</li>
                                                                    <li>Purok - 1</li>
                                                                    <li>Purok - 4</li>
                                                                    <li>Purok - 9</li>
                                                                    
                                                                </ul>

                                                            </div>

                                                            

                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <p class="accordion-title">River System: Talomo River</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Talomo Proper</p>


                                                                <ul>
                                                                    <li>- San Juan Village</li>
                                                                    <li>- Sunny Ville</li>
                                                                    <li>- San Agustin Village</li>
                                                                    <li>- Teacher's Village</li>
                                                                    <li>- Ulas</li>
                                                                    <li>- Portion of NHA Bangkal Bulusan</li>
                                                                    <li>- Morio Morio</li>
                                                                    <li>- Muslim Village</li>
                                                                    <li>- Taal 1 & 2</li>
                                                                    <li>- Ortega Village</li>

                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Los Amigos</p>


                                                                <ul>
                                                                    <li>- Purok - 20</li>
                                                                    <li>- Graceland Village</li>
                                                                    <li>- Purok - 1</li>
                                                                    <li>- Purok - 2</li>
                                                                    <li>- Purok - 3</li>
                                                                    <li>- Purok - 4</li>
                                                                    <li>- Purok - 7</li>
                                                                    <li>- Pantatan</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Catalunan Pequeño</p>


                                                                <ul>
                                                                    <li>- Purok Gulayan (Keith Williams)</li>
                                                                    
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Tugbok</p>


                                                                <ul>
                                                                    <li>- St. Benedict Church</li>
                                                                    
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Riverside</p>


                                                                <ul>
                                                                    <li>- Along Talomo Riverbanks</li>
                                                                </ul>

                                                            </div>

                                                            

                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethree" aria-expanded="false" aria-controls="collapseTwo">
                                                        <p class="accordion-title">River System: Matina River</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapsethree" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Matina Pangi</p>


                                                                <ul>
                                                                    <li>- Purok - 1A</li>
                                                                    <li>- Purok - 7a</li>
                                                                    <li>- Purok - 9</li>
                                                                    <li>- Purok - 11A</li>
                                                                    <li>- Km 6</li>
                                                                    <li>- Km 6.5</li>
                                                                    <li>- Km 7</li>
                                                                    <li>- Km 9</li>
                                                                    <li>- Samantha Homes</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Matina Crossing</p>


                                                                <ul>
                                                                    <li>- Arroyo Compound</li>
                                                                    <li>- Golden Alley</li>
                                                                    <li>- Purok Santiago</li>
                                                                    <li>- Purok Concepcion</li>
                                                                    <li>- Lower part of Santiago village</li>
                                                                    <li>- Matina - Balusong</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Catalunan Pequeño</p>


                                                                <ul>
                                                                    <li>- Purok Gulayan (Keith Williams)</li>
                                                                    
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Tugbok</p>


                                                                <ul>
                                                                    <li>- St. Benedict Church</li>
                                                                    
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Riverside</p>


                                                                <ul>
                                                                    <li>- Along Talomo Riverbanks</li>
                                                                </ul>

                                                            </div>

                                                            

                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>  

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapseTwo">
                                                        <p class="accordion-title">River System: Davao River</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Tamugan</p>


                                                                <ul>
                                                                    <li>- Sabang</li>
                                                                    <li>- Purok Acacia</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Callawa</p>


                                                                <ul>
                                                                    <li>- Callawa Elementary School</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Mandug</p>


                                                                <ul>
                                                                    <li>- DDF Village Phase 3</li>
                                                                    
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Tigatto</p>


                                                                <ul>
                                                                    <li>- Jade Valley Phase 1 & Phase 2</li>
                                                                    <li>- NCCC Relocation</li>
                                                                    <li>- Purok Uyanguren</li>
                                                                    <li>- Tigatto Relocation</li>
                                                                    <li>- Narra Park Residence</li>
                                                                    <li>- Deca Homes Esperanza Phase 1 & Phase 2</li>
                                                                    <li>- Juliville Subdivision Phase 1 & Phase 2</li>
                                                                    
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay 19</p>


                                                                <ul>
                                                                    <li>- El Rio Phase 5</li>
                                                                    <li>- Purok 8 Riverview Bacaca</li>
                                                                    <li>- San Antonio Bacaca</li>
                                                                    <li>- Purok Alonzo Terassas</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Ma-a</p>


                                                                <ul>
                                                                    <li>- Purok - 1</li>
                                                                    <li>- Purok - 2</li>
                                                                    <li>- Purok - 3</li>
                                                                    <li>- Purok - 4</li>
                                                                    <li>- Purok - 5</li>
                                                                    <li>- Purok - 13B Dapsa at the back of Bachelor Express Base</li>
                                                                    <li>- Purok - 17 Datu Luho</li>
                                                                    <li>- Purok - 17 New Argao</li>
                                                                    <li>- Purok - 20 Sangilangan</li>
                                                                    <li>- Purok - 27 (Riverside Camarin, Riverside Padaman, Riverside Caymato)</li>
                                                                    <li>- Purok - 49 JPMI</li>
                                                                    <li>- Don Julian Village</li>
                                                                    <li>- Gem Village</li>
                                                                    <li>- Duha Village</li>
                                                                    <li>- San Rafael Village Dapsa</li>
                                                                    <li>- Diho 3 Subdivision</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Matina Crossing</p>


                                                                <ul>
                                                                    <li>- Matina Gravahan near Sandawa</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Bucana</p>


                                                                <ul>
                                                                    <li>- SIR New Matina Phase 1 along Davao River Bank</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay 1A</p>


                                                                <ul>
                                                                    <li>- Along the Davao Riverbanks</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay 2A</p>


                                                                <ul>
                                                                    <li>- Purok - 1</li>
                                                                    <li>- Purok - 2 at the back of Shell</li>
                                                                    <li>- Purok - 3 at the back of CHDC</li>
                                                                    <li>- Purok - 7 Bankerohan</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay 5A</p>


                                                                <ul>
                                                                    <li>- Lower Pagasa</li>
                                                                    <li>- Portion of Madapo</li>
                                                                    <li>- Purok - 2 Bryco</li>
                                                                    <li>- Purok - 3 Bryco</li>
                                                                    <li>- Purok - 4 Pagasa</li>
                                                                    <li>- Purok - 5 Pagasa</li>
                                                                    <li>- Purok - 6A Gumamela</li>
                                                                    <li>- Purok - 6B Pagasa</li>
                                                                    <li>- Purok - 7 Cattleya</li>
                                                                    <li>- Purok - 17A Lower Madapo</li>
                                                                    <li>- Purok - 17B Lower Madapo</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay 8A</p>


                                                                <ul>
                                                                    <li>- Purok - 7</li>
                                                                    <li>- Purok - 9</li>
                                                                    <li>- Purok - 10A</li>
                                                                    <li>- Purok - 11B</li>
                                                                    <li>- Purok - 11A</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay 9A</p>


                                                                <ul>
                                                                    <li>- Purok - 9 (Domsat, Sitio Balite, Camella)</li>
                                                                    <li>- Purok - 10</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay 10</p>


                                                                <ul>
                                                                    <li>- Purok - 6</li>
                                                                    <li>- Purok - 7</li>
                                                                    <li>- Purok - 8</li>
                                                                    <li>- Purok - 9</li>
                                                                </ul>

                                                            </div>

                                                            

                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapseTwo">
                                                        <p class="accordion-title">River System: Bunawan River</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapsefive" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Bunawan</p>


                                                                <ul>
                                                                    <li>- Purok - 4A</li>
                                                                    <li>- Purok - 9 - Magkabu</li>
                                                                    <li>- Purok - 7</li>
                                                                    <li>- Inabanga</li>
                                                                    <li>- Sto. Niño</li>
                                                                    <li>- Bonaply</li>
                                                                    <li>- Km 18 (Iglesia ni Kristo and under the Bunawan bridge)</li>
                                                                </ul>

                                                            </div>


                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="false" aria-controls="collapseTwo">
                                                        <p class="accordion-title">River System: Lasang River</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapsesix" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Lasang</p>


                                                                <ul>
                                                                    <li>- San Juan Bautista New Chapel</li>
                                                                    <li>- The Church of Jesus Christ (Mormons)</li>
                                                                    <li>- St. John Parish</li>
                                                                    <li>- Church of God</li>
                                                                    <li>- Purok - Bucana</li>
                                                                </ul>

                                                            </div>


                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven" aria-expanded="false" aria-controls="collapseTwo">
                                                        <p class="accordion-title">River System: Panacan River</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapseseven" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Panacan</p>


                                                                <ul>
                                                                    <li>- Purok - 26 Malagamot</li>
                                                                    <li>- Luzville Subdivision</li>
                                                                    <li>- Pizzaro</li>
                                                                    <li>- San Miguel</li>
                                                                    <li>- Doña Mercedez</li>
                                                                </ul>

                                                            </div>


                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeight" aria-expanded="false" aria-controls="collapseTwo">
                                                        <p class="accordion-title">River System: Bago Creek</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapseeight" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Bago Gallera</p>


                                                                <ul>
                                                                    <li>- Samantha Homes</li>
                                                                    <li>- Mega Homes</li>
                                                                    <li>- Calle Raya Village</li>
                                                                    <li>- Lower Libby</li>
                                                                    <li>- Purok Lumansok</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Bago Aplaya</p>


                                                                <ul>
                                                                    <li>- Gallera de Oro</li>
                                                                    <li>- Goldland Village</li>
                                                                    <li>- Castro Village</li>
                                                                    <li>- PHILOAI</li>
                                                                    <li>- Catotal Subdivision</li>
                                                                    <li>- Cartagena Village</li>
                                                                </ul>

                                                            </div>


                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item accordion-borderless">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenine" aria-expanded="false" aria-controls="collapseTwo">
                                                        <p class="accordion-title">River System: Mintal Creek</p>
                                                      </button>
                                                    </h2>
                                                    <div id="collapsenine" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                                                                               
                                                        <div class="row">
                                                                                                                   
                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Mintal</p>


                                                                <ul>
                                                                    <li>- Purok - 11</li>
                                                                    <li>- Purok - 14</li>
                                                                    <li>- Purok - 15</li>
                                                                </ul>

                                                            </div>

                                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                                <p style="color: var(--color-adventour); font-weight: bold;">Barangay Sto. Niño</p>


                                                                <ul>
                                                                    <li>- Purok - 23, Talipapa, fronting Camella Homes</li>
                                                                    <li>- Purok - 15, Green Meadows</li>
                                                                </ul>

                                                            </div>


                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <br>

                                            <p>
                                                "In case of strong earthquake that will cause tsunami and typhoon that will cause storm surge, follow the evacuation route near to your area going to
                                                 the designated evacuation site. Orient yourself to the map we provide for your reference."
                                            </p>

                                            </p>
                                            <span class="fw-bold"> #DavaoRivers<br>#Adventour2023</span>
                                        </div>
            
                                    </div>

                                    <div class="feed">
                                        
                                        <div class="head">
                                            <div class="user">
                                                <div class="profile-photo">
                                                    <img src="./images/Logo1-122722.png">
                                                </div>
                                                <div class="user-info">
                                                    <h3> Davao City Tsunami Risk Map</h3>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="map-photo">

                                            <div class="container" id="map-main-photo">
                                                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1--Ze77qJWMs5dtm5UFh0yVgvR0UWUCg&ehbc=2E312F" width="100%" height="100%"></iframe>
                                            </div>
                                        </div>
            
                                        <br>

                                        <div class="caption">
                                            <p>
                                                <span class="fw-bold">Region XI (Davao Region)</span>
                                                is classified as high tsunami hazard. This means that there is more than a 40% chance of a potentially-damaging tsunami 
                                                occurring in the next 50 years. 
                                            </p>

                                            <p>
                                                the impact of tsunami must be considered in different phases of the project for any activities located near the coast.
                                            </p>

                                            <p>
                                                Project planning decisions, project design, and construction methods must take into account the level of tsunami hazard. Further 
                                                detailed information should be obtained to adequately account for the level of hazard.
                                            </p>

                                            <p>
                                                Climate change impact: The areas at risk of tsunami will increase as global mean sea level rises. According to the IPCC (2013), 
                                                global mean sea level rise depends on a variety of factors, and estimates for 2100 range from ~20 cm to nearly 1 m. However, 
                                                regional changes in sea level are difficult to predict. Projects in low-lying coastal areas such as deltas, or in island states 
                                                should be designed to be robust to projected increases in global sea level.
                                            </p>

                                            <p>
                                                "In case of strong earthquake that will cause tsunami and typhoon that will cause storm surge, follow the evacuation route near 
                                                to your area going to the designated evacuation site. Orient yourself to the map we provide for your reference."
                                            </p>

                                            <br>

                                            <span class="fw-bold"> #DavaoTsunamiArea<br>#Adventour2023</span>
                                        </div>
            
                                    </div>

                                    <div class="feed">
                                        
                                        <div class="head">
                                            <div class="user">
                                                <div class="profile-photo">
                                                    <img src="./images/Logo1-122722.png">
                                                </div>
                                                <div class="user-info">
                                                    <h3> Davao City Fault System</h3>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="map-photo">

                                            <div class="container" id="map-main-photo">
                                                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1_db_8thrrLGTZ5fDXMkNp2TMC8I6MJ8&ehbc=2E312F" width="100%" height="100%"></iframe>
                                            </div>
                                        </div>
            
                                        <br>
            
                                        <div class="caption">
                                            <p>
                                                <span class="fw-bold">THE Department of Science and Technology (DOST)-Philippine Institute of Volcanology and Seismology (Phivolcs) </span>
                                                listed a total of 60 barangays in Davao City that transect in the Central Davao Fault System, which is comprised of five segments.
                                            </p>

                                            <p>
                                                The Central Davao Fault System has five segments,, including the Tamugan Fault with 25 kilometers (kms) length and can produce 
                                                6.7-magnitude earthquake; Lacson Fault with 33 kms and can trigger a 6.8-magnitude quake; 18-kilometer Dacudao Fault with 6.5-magnitude 
                                                quake; Pangyan-Biao with 33 kms and 6.8-magnitude quake; and the 12-kilometer New Carmen Fault that may cause a 6.3-magnitude earthquake.
                                            </p>

                                            <p>
                                                "In case of strong earthquake that will cause tsunami and typhoon that will cause storm surge, follow the evacuation route near 
                                                to your area going to the designated evacuation site. Orient yourself to the map we provide for your reference."
                                            </p>
                                            <span class="fw-bold"> #DavaoFaultLines<br>#Adventour2023</span>
                                        </div>
            
                                    </div>
            
                                </div>
        
                                <div class="bottom-filler mb-5"></div>
        
        
                            </div>

                        </div>
                    <!--==================== End of Middle Section =================-->
                    <!--==================== Right Section =================-->
                        <div class="right col-12 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                            
                            

                            <div class="route-container card">

                                <h5 class="mx-3 mt-2" style="color: var(--color-adventour); font-weight: bold;">Davao City Jeepney Routes</h5>

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseone-side" aria-expanded="false" aria-controls="collapseone">
                                            <p class="accordion-title">Bago Aplaya Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapseone-side" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Bago Aplaya</li>
                                                <li>- Central Park, Bangkal</li>
                                                <li>- Tahimik Avenue</li>
                                                <li>- Matina Crossing</li>
                                                <li>- ABS-CBN Junction</li>
                                                <li>- Ecoland Terminal Crossing</li>
                                                <li>- Almendras Gym</li>
                                                <li>- Roxas Avenue</li>
                                                <li>- Tulip Drive</li>
                                                <li>- Sabungan Gallera, Matina</li>
                                                <li>- Matina Crossing</li>
                                                <li>- Tahimik Avenue</li>
                                                <li>- Central Park, Bangkal</li>
                                                <li>- Ulas </li>
                                                <li>- Puan Crossing</li>
                                                <li>- Bago Crossing</li>

                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo-side" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Bangkal Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapseTwo-side" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Bangkal</li>
                                                <li>- McArthur Hi-way, Balusong</li>
                                                <li>- GSIS</li>
                                                <li>- Davao Executives Homes</li>
                                                <li>- SM City Davao</li>
                                                <li>- Agro College</li>
                                                <li>- Almendras Gym</li>
                                                <li>- BPI Claveria</li>
                                                <li>- Roxas</li>
                                                <li>- Guerrero cor., Magsaysay Ave.</li>
                                                <li>- F. Bangoy cor., Magsaysay Ave.</li>
                                                <li>- Ramon Magsaysay Park</li>
                                                <li>- PLDT Ponciano</li>
                                                <li>- Fabie Hospital (Rizal St.)</li>
                                                <li>- Sandawa Crossing</li>
                                                <li>- Ma-a Crossing</li>
                                                <li>- ABS-CBN (Bantay Bata 163)</li>
                                                <li>- Matina Crossing</li>
                                                <li>- DENR</li>
                                                <li>- Davao Adventist Hospital</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>
                                
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethree-side" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">BO. Obrero Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapsethree-side" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- New Burgos St.</li>
                                                <li>- Victoria Plaza Car Park</li>
                                                <li>- Mercury Drug (Lacson)</li>
                                                <li>- Gaisano Mall of Davao (Front)</li>
                                                <li>- BDO Davao (Bangoy)</li>
                                                <li>- Ateneo de Davao University (Jacinto)</li>
                                                <li>- 7-Eleven (Blvd cor E. Jacinto St.)</li>
                                                <li>- Moonlight Pharmacy</li>
                                                <li>- San Pedro Church</li>
                                                <li>- Mercury Drug Claveria</li>
                                                <li>- Ateneo de Davao University (Claveria)</li>
                                                <li>- Gaisano Mall of Davao (Front)</li>
                                                <li>- Davao Street Food Park</li>
                                                <li>- Sacred Heart of Jesus Parish</li>
                                                <li>- Messy Burger N. Torres</li>
                                                <li>- New Burgos St.</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>  

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour-side" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Buhagin Via Dacudao Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapsefour-side" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                            
                                            <ul>
                                                <li>- Buhangin District Hall</li>
                                                <li>- Orange Grove Hotel</li>
                                                <li>- Watusi Street</li>
                                                <li>- Dacudao Fly Over (TOYOBAC)</li>
                                                <li>- Vinzon Corner, Cabaguio Ave. </li>
                                                <li>- Leon Garcia St. (Sunrise)</li>
                                                <li>- Ramon Magsaysay Park</li>
                                                <li>- Bangoy Cor. Sta. Ana Ave.</li>
                                                <li>- Agdao Flyover</li>
                                                <li>- Dacucao Ave. Cor. Ruby St. (RGA VIII)</li>
                                                <li>- Dacudao Fly Over</li>
                                                <li>- Watusi Street, Buhagin</li>
                                                <li>- Orange Groove Hotel</li>
                                                <li>- Buhangin District Hall</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive-side" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Buhangin via JP Laurel Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapsefive-side" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Orange Grove Hotel</li>
                                                <li>- McDonald's Davao (Buhangin)</li>
                                                <li>- Abreeza Mall</li>
                                                <li>- NCCC Mall (Victoria Plaza)</li>
                                                <li>- Gaisano Mall of Davao (Front)</li>
                                                <li>- Bangko Sentral ng Pilipinas (Quirino)</li>
                                                <li>- Davao Doctor's Hospital (Quirino)</li>
                                                <li>- Bankerohan (Marfori St.)</li>
                                                <li>- McDonald's Davao (Bankerohan)</li>
                                                <li>- Grand Menseng Hotel (Magallanes)</li>
                                                <li>- Sangguniang Panglungsod (Magallanes)</li>
                                                <li>- San Pedro Church</li>
                                                <li>- Mercury Drug (Claveria)</li>
                                                <li>- Ateneo de Davao University (Claveria)</li>
                                                <li>- Gaisano Mall of Davao (Front)</li>
                                                <li>- NCCC Mall (Victoria Plaza)</li>
                                                <li>- Abreeza Mall</li>
                                                <li>- McDonald's Davao (Buhangin)</li>
                                                <li>- Orange Grove Hotel</li>
                                                <li>- Shell (NHA Buhangin)</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix-side" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Ecoland Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapsesix-side" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- SM City Davai (Ecoland)</li>
                                                <li>- Civil Service Commission Regional Office</li>
                                                <li>- John Paul II College</li>
                                                <li>- Davao City Overland Transport Terminal (DCOTT)</li>
                                                <li>- Tecarro College Foundation (Sandawa)</li>
                                                <li>- Bankerohan Overpass</li>
                                                <li>- Grand Menseng (Magallanes)</li>
                                                <li>- Sanguniang Panglungsod </li>
                                                <li>- Landbank Davao (Claveria)</li>
                                                <li>- Ateneo de Davao University (Claveria)</li>
                                                <li>- NCCC Uyanguren (Magsaysay)</li>
                                                <li>- Ramon Magsaysay Park</li>
                                                <li>- Boulevard (cor., Roxas Ave.)</li>
                                                <li>- LTO (Fronting Felcris Centrale)</li>
                                                <li>- Davao City Overland Transport Terminal (DCOTT)</li>
                                                <li>- John Paul II College</li>
                                                <li>- Civil Service Commission Regional Office XI</li>
                                                <li>- Home Crest/Ecoland Suites</li>
                                                <li>- SM City Davao (Ecoland)</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven-side" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">El Rio Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapseseven-side" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- El Rio Vista Village</li>
                                                <li>- Kanto Bacaca Road (cor., Circumferential Rd.)</li>
                                                <li>- Davao Chinese Cemetery</li>
                                                <li>- Davao Medical School Foundation (DMSF)</li>
                                                <li>- NCCC Mall (Victoria Plaza)</li>
                                                <li>- Gaisano Mall Davao (Front)</li>
                                                <li>- Davao Light and Power Company (Ponciano)</li>
                                                <li>- Bankerohan (Marfori St.)</li>
                                                <li>- Grand Menseng (Magallanes)</li>
                                                <li>- San Pedro Church</li>
                                                <li>- Mercury Drug (Claveria)</li>
                                                <li>- Dover Bowling Lanes</li>
                                                <li>- Ateneo de Davao University (Claveria)</li>
                                                <li>- Gaisano Mall of Davao (Front)</li>
                                                <li>- NCCC Mall (Victoria Plaza)</li>
                                                <li>- Davao Medical School Foundation (DMSF)</li>
                                                <li>- Davao Chinese Cemetery</li>
                                                <li>- Kanto Bacaca Road (cor., Circumferential Rd.)</li>
                                                <li>- El Rio Vista Village</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeight-side" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Ma-a Bankerohan Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapseeight-side" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Phoenix (Kanto Maa-Diversion)</li>
                                                <li>- NCCc Supermarket (CENRO)</li>
                                                <li>- Jollibee (Maa Branch)</li>
                                                <li>- Luzviminda Village Subd.</li>
                                                <li>- University of Mindanao (Maa Gate)</li>
                                                <li>- S&R Membership Shopping</li>
                                                <li>- University of Mindanao (Matina Campus)</li>
                                                <li>- McDonald's Bankerohan</li>
                                                <li>- University of Mindanao (Matina Campus)</li>
                                                <li>- S&R Membership Shopping</li>
                                                <li>- A Spatial Condominium</li>
                                                <li>- Luzviminda Village Subd.</li>
                                                <li>- Crossing Gem Village</li>
                                                <li>- Maa Barangay Hall </li>
                                                <li>- Woodridge Subd (Maa)</li>
                                                <li>- Phoenix (Kanto Maa-Diversion)</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-9" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Bunawan via Sasa Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-9" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Bunawan Barangay Hall</li>
                                                <li>- Gaisano Grand Tibungco</li>
                                                <li>- UM Ilang Campus</li>
                                                <li>- Ilang Gym</li>
                                                <li>- NCCC Panacan</li>
                                                <li>- Samal Ferry Wharf</li>
                                                <li>- Ayala Azuela Cove</li>
                                                <li>- MATS College of Technology</li>
                                                <li>- Ramon Magsaysay Park</li>
                                                <li>- Ateneo de Davao University</li>
                                                <li>- Gmall Davao</li>
                                                <li>- NCCC Mall Victoria Plaza</li>
                                                <li>- Abreeza Mall</li>
                                                <li>- Southern Philippines Medical Center </li>
                                                <li>- Damosa</li>
                                                <li>- Grand Regal Hotel & Casino</li>
                                                <li>- Lots for Less Lanang</li>
                                                <li>- Puregold Lanang</li>
                                                <li>- Sasa Public Market</li>
                                                <li>- Panacan Public Market</li>
                                                <li>- Ilang Gym</li>
                                                <li>- Tibungco Public Market</li>
                                                <li>- Crossing Mahayag</li>
                                                <li>- Holy Cross of Bunawan</li>
                                                <li>- Bunawan Barangay Hall</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-10" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Calinan Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-10" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Calinan NCCC Supermarket</li>
                                                <li>- Angel Funeral Homes</li>
                                                <li>- Los Amigos Crossing</li>
                                                <li>- UM Tugbok</li>
                                                <li>- Mintal Elementary School</li>
                                                <li>- Catalunan Pequeno Crossing</li>
                                                <li>- Matina Crossing</li>
                                                <li>- SM City (Ecoland)</li>
                                                <li>- Almendras Gym</li>
                                                <li>- Roxas Avenue</li>
                                                <li>- Maa Crossing</li>
                                                <li>- Matina Crossing</li>
                                                <li>- Central Park, Bangkal</li>
                                                <li>- Mintal Elementary School </li>
                                                <li>- Calinan NCCC Supermarket</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-11" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Catalunan Grande Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-11" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Catalunan Grande NCCC Supermarket</li>
                                                <li>- Petron Bangkal</li>
                                                <li>- Matina Crossing</li>
                                                <li>- GSIS Matina</li>
                                                <li>- SM City Ecoland</li>
                                                <li>- Almendras Gym</li>
                                                <li>- San Pedro Church</li>
                                                <li>- City Triangle / Ateneo de Davao University</li>
                                                <li>- Bankerohan Overpass</li>
                                                <li>- Sandawa Crossing</li>
                                                <li>- Maa Crossing</li>
                                                <li>- Kanto Shrine</li>
                                                <li>- Central Park Bangkal</li>
                                                <li>- Choice Mart Catalunan Grande</li>
                                                <li>- Catalunan Grande NCCC Supermarket</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-12" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Matina Aplaya Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-12" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Felis Resort Complex</li>
                                                <li>- Matina Aplaya Barangay Hall</li>
                                                <li>- DILG Region XI Regional Office</li>
                                                <li>- Davao City Water District</li>
                                                <li>- UM Matina</li>
                                                <li>- Bankerohan Overpass</li>
                                                <li>- Davao City Hall</li>
                                                <li>- DPWH Region XI Office</li>
                                                <li>- Shanghai Restaurant</li>
                                                <li>- UM Bolton</li>
                                                <li>- Kanto Sandawa</li>
                                                <li>- S&R Membership Shopping</li>
                                                <li>- Mercury Drug Matina Aplaya</li>
                                                <li>- Matina Aplaya 75-A Barangay Hall</li>
                                                <li>- Shanghai Public Market</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-13" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Puan / Rosalina 1 Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-13" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Puan / Rosalina 1</li>
                                                <li>- Central Park, Bangkal</li>
                                                <li>- GSIS Matina</li>
                                                <li>- Davao Executives</li>
                                                <li>- Almendras Gym</li>
                                                <li>- Monteverde Avenue</li>
                                                <li>- Mercury Drug Bankerohan</li>
                                                <li>- Malayan Colleges</li>
                                                <li>- Central Park, Bangkal</li>
                                                <li>- Coca Cola Plant</li>
                                                <li>- Puan Crossing</li>
                                                <li>- Reldo Subdivision Puan</li>
                                                <li>- Puan / Rosalina 1</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-14" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Rosalina 3 Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-14" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Rosalina 3 Terminal</li>
                                                <li>- Davao Doctor's Hospital Satellite (Greenland)</li>
                                                <li>- Ulas Police Outpost</li>
                                                <li>- DENR Bangkal</li>
                                                <li>- Matina Crossing</li>
                                                <li>- Maa Crossing</li>
                                                <li>- People's Park</li>
                                                <li>- Roxas Avenue</li>
                                                <li>- LTO Quimpo Boulevard</li>
                                                <li>- SM City Ecoland</li>
                                                <li>- Puan Crossing</li>
                                                <li>- Capili road. Kanto</li>
                                                <li>- Rosalina 3 Terminal</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                
                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-15" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 1</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-15" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Marfori</li>
                                                <li>- Gaisano Grand Ilustre</li>
                                                <li>- City Hall </li>
                                                <li>- San Pedro Church</li>
                                                <li>- Ateneo de Davao University</li>
                                                <li>- Ramon Magsaysay Park</li>
                                                <li>- NCCC Uyanguren</li>
                                                <li>- Gmall Bajada</li>
                                                <li>- Davao Light Ponciano</li>
                                                <li>- City Hall </li>
                                                <li>- Bangko Sentral ng Pilipinas</li>
                                                <li>- Davao National High School</li>
                                                <li>- Marfori</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-16" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 2</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-16" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Ecoland Main</li>
                                                <li>- Davao City Overland Transport Terminal (DCOTT)</li>
                                                <li>- Almendras Gym</li>
                                                <li>- Quezon Boulevard</li>
                                                <li>- Ramon Magsaysay Avenue</li>
                                                <li>- NCCC Uyanguren</li>
                                                <li>- Davao Light Ponciano</li>
                                                <li>- UM Bolton</li>
                                                <li>- City Hall</li>
                                                <li>- Marfori St.</li>
                                                <li>- Tecarro College Foundation (Sandawa)</li>
                                                <li>- Davao City Overland Transport Terminal (DCOTT)</li>
                                                <li>- Ecoland Main</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-17" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 3</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-17" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Marfori (Circumferential Road)</li>
                                                <li>- Davao City National High School</li>
                                                <li>- Bangko Sentral ng Pilipinas</li>
                                                <li>- Gaisano Grand Illutre</li>
                                                <li>- The Apo View Hotel</li>
                                                <li>- Shell (Magallanes)</li>
                                                <li>- Sanguiang Panglungsod</li>
                                                <li>- Ateneo de Davao University</li>
                                                <li>- Magsaysay Avenue</li>
                                                <li>- Davao Light Ponciano</li>
                                                <li>- City Hall</li>
                                                <li>- Rizal Memorial Colleges</li>
                                                <li>- Marfori (Circumferential Road)</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-18" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 4</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-18" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- San Pedro Church</li>
                                                <li>- Ateneo de Davao University</li>
                                                <li>- Gmall of Davao</li>
                                                <li>- NCCC Mall Victoria Plaza</li>
                                                <li>- Abreeza Mall</li>
                                                <li>- Southern Philippines Medical Center</li>
                                                <li>- Agdao Flyover</li>
                                                <li>- Kanto Sta. Ana</li>
                                                <li>- Magsaysay Park</li>
                                                <li>- Quezon Boulevard</li>
                                                <li>- Moonlight Pharmacy</li>
                                                <li>- San Pedro Church</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-19" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 5</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-19" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Bankerohan Public Market</li>
                                                <li>- Magallanes St.</li>
                                                <li>- San Pedro Church</li>
                                                <li>- Ateneo de Davao University</li>
                                                <li>- Magsaysay Avenue</li>
                                                <li>- Gmall of Davao</li>
                                                <li>- Kanto Sta. Ana</li>
                                                <li>- Quezon Boulevard </li>
                                                <li>- Moonlight Pharmacy</li>
                                                <li>- Big Bang Park (San Pedro St.)</li>
                                                <li>- Bankerohan Public Market</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-20" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 6</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-20" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Bankerohan Public Market</li>
                                                <li>- Grand Menseng </li>
                                                <li>- Almendras Gym</li>
                                                <li>- Quezon Boulevard</li>
                                                <li>- Magsaysay Avenue</li>
                                                <li>- Agdao Flyover</li>
                                                <li>- NCCC Uyanguren</li>
                                                <li>- Davao Light Ponciano </li>
                                                <li>- UM Bolton</li>
                                                <li>- San Pedro Church</li>
                                                <li>- D'morvie Suites</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-21" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 7</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-21" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Bankerohan Public Market</li>
                                                <li>- Grand Menseng </li>
                                                <li>- Almendras Gym</li>
                                                <li>- Quezon Boulevard</li>
                                                <li>- Magsaysay Avenue</li>
                                                <li>- Assumption College</li>
                                                <li>- Agdao Public Market</li>
                                                <li>- Acacia </li>
                                                <li>- Kapitan Tomas Sr. Central Elementary School</li>
                                                <li>- Union Bank of the Philippines Quirino</li>
                                                <li>- Bankerohan Public Market</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-22" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 8</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-22" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Davao City National High School</li>
                                                <li>- Bangko Sentral ng Pilipinas</li>
                                                <li>- Kapitan Tomas Monteverde Sr. Central Elementary School</li>
                                                <li>- Tesoro's Printing Press UM</li>
                                                <li>- Unitop</li>
                                                <li>- McDonald's Illustre Branch</li>
                                                <li>- Davao Doctor's Hospital</li>
                                                <li>- Bangko Sentral ng Pilipinas</li>
                                                <li>- Davao City National High School</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-23" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 9</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-23" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Bankerohan Public Market</li>
                                                <li>- Grand Menseng Hotel</li>
                                                <li>- Almendras Gym</li>
                                                <li>- Boulevard cor., Roxas</li>
                                                <li>- Agdao Public Market</li>
                                                <li>- Gmall of Davao</li>
                                                <li>- Davao City National High School</li>
                                                <li>- Rizal Memorial Colleges</li>
                                                <li>- Bankerohan Public Market</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-24" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 10</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-24" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Bankerohan Public Market</li>
                                                <li>- Grand Menseng Hotel</li>
                                                <li>- San Pedro Church</li>
                                                <li>- Ateneo De Davao University</li>
                                                <li>- NCCC Uyanguren</li>
                                                <li>- Ramon Magsaysay Park</li>
                                                <li>- Southern Philippines Medical Center</li>
                                                <li>- Gmall of Davao</li>
                                                <li>- Bankerohan Public Market</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-25" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 11</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-25" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Agdao Flyover</li>
                                                <li>- Ramon Magsaysay Park</li>
                                                <li>- San Pedro Church</li>
                                                <li>- Brokenshire College Compound (Orchard Road Memorial Park)</li>
                                                <li>- Rizal Memorial College</li>
                                                <li>- Davao City National High School</li>
                                                <li>- iQor Philippines Davao</li>
                                                <li>- Imperial Appliance Plaza (F. Bangoy)</li>
                                                <li>- Agdao Flyover</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-26" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 12</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-26" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Ecoland Main</li>
                                                <li>- Davao City Overland Transport Terminal (DCOTT)</li>
                                                <li>- Tecarro College Foundation</li>
                                                <li>- Grand Menseng</li>
                                                <li>- City Hall</li>
                                                <li>- Ateneo de Davao University</li>
                                                <li>- NCCC Uyanguren</li>
                                                <li>- Quezon Boulevard</li>
                                                <li>- Ecoland Main</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-27" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Route 13</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-27" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Marfori (Circumferential Road)</li>
                                                <li>- Davao City National High School</li>
                                                <li>- Gaisano Grand Illustre</li>
                                                <li>- Grand Menseng</li>
                                                <li>- San Pedro Church</li>
                                                <li>- San Pedro Hospital</li>
                                                <li>- Davao Light Ponciano</li>
                                                <li>- Davao Doctor's Hospital</li>
                                                <li>- Marfori (Circumferential Road)</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>
                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-28" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Toril Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-28" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Barangay Hall Toril</li>
                                                <li>- Ulas Crossing</li>
                                                <li>- Maa Crossing</li>
                                                <li>- Quirino Avenue</li>
                                                <li>- Bonifacio St.</li>
                                                <li>- SM Ecoland</li>
                                                <li>- Ulas Crossing</li>
                                                <li>- Gaisano Mall od Davao Toril</li>
                                                <li>- Grocerama Toril</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-29" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Talomo Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-29" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Talomo Proper</li>
                                                <li>- Ulas Crossing</li>
                                                <li>- Matina Public Market</li>
                                                <li>- Bankerohan Overpass</li>
                                                <li>- Ateneo de Davao University</li>
                                                <li>- Matina Town square</li>
                                                <li>- Central Park Bangkal</li>
                                                <li>- Puan Crossing</li>
                                                <li>- Talomo Proper</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <div class="accordion" id="accordionExample">   
                                    <div class="accordion-item accordion-borderless">
                                        <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-side-30" aria-expanded="false" aria-controls="collapseTwo">
                                            <p class="accordion-title">Ulas Route</p>
                                          </button>
                                        </h2>
                                        <div id="collapse-side-30" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                                                                                   
                                            <ul>
                                                <li>- Caltex, Ulas</li>
                                                <li>- UM Matina</li>
                                                <li>- Ramon Magsaysay Park</li>
                                                <li>- San Pedro / Illustre</li>
                                                <li>- Sandawa / McArthur</li>
                                                <li>- GSIS Matina</li>
                                                <li>- Balusong Avenue</li>
                                                <li>- Flores Subdivision</li>
                                                <li>- Caltex, Ulas</li>
                                            </ul>

                                          </div>
                                        </div>
                                      </div>
                                </div>


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

</body>    
    <!--calendar-->
   
    







    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="navjs.js"></script>
    <script src="direction-map.js"></script>
    <script src="site-search.js"></script>
</body>
</html>