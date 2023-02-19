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
                                <a class="menu-item active" href="home.php">
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
                            <!-------------END OF SIDE BAR----------->
    
                            <div class="mb-5"></div>
                        </aside>

                    </div>
                <!--==================== End of Left Section =================-->

                <!--==================== Middle Section =================-->
                <div class="middle col-12 col-md-9 col-lg-7 col-xl-8 col-xxl-8">
                        <div class="feedcage container mb-5">
                            <div class="feeds">
                                <div class="feed shadow">
                                    <div class="main-photo-banner">
                                        <div class="container" id="banner-image">
                                            <img src="./images/davaowelcomebanner1.png" alt="Welcome to Davao City!">
                                        </div>
                                    </div>
                                </div>

                                <div class="feed shadow">
                                    
                                    <div class="head">
                                        <div class="user">
                                            <div class="user-info">
                                                <h3> Everything About Davao City</h3>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="map-photo">
                                        <div class="container" id="map-main-photo">
                                            <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1A3inty7sxqEvf_GpowuyjGiaf-JV2Yk&ehbc=2E312F" width="100%" height="100%"></iframe>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p class="text-dark"><b style="color: var(--color-adventour);">Davao City</b>, officially the City of Davao (Cebuano: Dakbayan sa Dabaw; Filipino: Lungsod ng Davao), 
                                            is a 1st class highly urbanized city in the Davao Region, Philippines. The city has a total land area of 2,443.61 km2 (943.48 sq mi), 
                                            making it the largest city in the Philippines in terms of land area.
                                        </p>

                                        <p>
                                            It is the third-most populous city in the Philippines after Quezon City and Manila, and the most populous in Mindanao.
                                             According to the 2020 census, it has a population of 1,776,949 people.
                                        </p>

                                        <p>
                                            It is geographically situated in the province of Davao del Sur and grouped under the province by the Philippine Statistics Authority, but the city is governed 
                                            and administered independently from it. The city is divided into three congressional districts, which are subdivided into 11 administrative districts with a total of 182 barangays.
                                        </p>

                                        <p>
                                            Davao City is the center of Metro Davao, the second most populous metropolitan area in the Philippines. 
                                            The city serves as the main trade, commerce, and industry hub of Mindanao, and the regional center of Davao Region. 
                                            Davao is home to Mount Apo, the highest mountain in the Philippines. The city is also nicknamed the <b style="color: var(--color-adventour);">"Durian Capital of the Philippines"</b>.
                                        </p>
                                        <br>

                                        <h5 style="color: var(--color-adventour);">Where does the name "Davao" came from?</h5>

                                        <p>
                                            The region's name is derived from its Bagobo origins. The Bagobos were indigenous to the Philippines. 
                                            The word davao came from the phonetic blending of three Bagobo subgroups' names for the Davao River, 
                                            a major waterway emptying into the Davao Gulf near the city.
                                        </p>

                                        <p>
                                            The aboriginal Obos, who inhabit the hinterlands of the region, called the river Davah (with a gentle vowel ending, 
                                            although later pronunciation is with a hard v or b); the Clatta (or Giangan/Diangan) called it Dawaw, and the Tagabawas called it Dabo. 
                                            To the Obos, davah also means "a place beyond the high grounds" (alluding to settlements at the mouth of the river surrounded by high, rolling hills).
                                        </p>

                                        <br>

                                        <span class="fw-bold"> #DavaoCity<br>#LifeisHere<br>#Adventour</span>
                                    </div>
        
                                </div>

                                <div class="feed shadow">
                                    <div class="head">
                                        <div class="user">
                                            <div class="user-info">
                                                <h3> Davao City through the eras</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-photo">
                                        <div class="container" id="main-photo">
                                            <img src="./images/davaohistory1.jpg" alt="Davao City Sangunian">
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h5 style="color: var(--color-adventour); font-weight: bold;">History</h5>
                                        <hr>
                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Precolonial era</h6>
                                        <p>
                                            The area of what is now Davao City was once a lush forest inhabited by Lumadic peoples such as the Bagobos
                                            and Matigsalugs, alongside other ethnic groups such as the Aeta, Maguindanaon and the Tausug.
                                        </p>

                                        <p>
                                            Davao River was then called Tagloc River by the Bagobos, Maguindanaons and 
                                            Tausugs who then inhabited a settlement near the mouth of the river to the sea around what is now 
                                            Bolton Riverside due immediately southwest of the city plaza.
                                        </p>

                                        <p>
                                            In 1543, Spanish explorers on sailing ships led by Ruy Lopez de Villalobos deliberately 
                                            avoided the area around Davao Gulf, then called Gulf of Tagloc, due to the danger posed by fleets of 
                                            Moro warships operating in the area while surveying the southeastern coast of Mindanao for possible colonization, 
                                            sand as a result the Davao Gulf area remained virtually untouched by European explorers for the next three centuries.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Maguindanao era</h6>
                                        <p>
                                            A Maguindanaon Datu under the name Datu Bago was rewarded the territory of the surroundings of Davao Gulf 
                                            by the Sultan of Maguindanao Sultanate for joining the campaign against the Spanish in the late 1700s. 
                                            From his ancestral home in Maguindanao, he moved to the area in 1800 and, having convinced Bagobos and 
                                            other native groups in the area to his side, conquered the entire Davao Gulf area.
                                        </p>

                                        <p>
                                            Having consolidated his position, he founded the fortress of Pinagurasan in what is now the site of 
                                            Bangkerohan Public Market in 1830 which served as his capital. From being a fortification and base of 
                                            operations from which Datu Bago could gather and rally his forces, the settlement of Pinagurasan eventually 
                                            grew into a small city extending from present-day Generoso Bridge in Bangkerohan to Quezon Boulevard more 
                                            than a kilometer down south, as Maguindanaons and Bagobos alike among other nearby tribes in the area flocked 
                                            into the settlement, eventually becoming the main trade entrepot in the Davao Gulf area.
                                        </p>

                                        <p>
                                            With his immense overlordship of the Davao Gulf, Datu Bago was eventually crowned Sultan by his subjects 
                                            at his capital Pinagurasan in 1843, effectively making his realm virtually independent from the Sultanate of 
                                            Maguindanao and is now itself a Sultanate that lords over the Davao Gulf, now in equal standing with the Mindanaon 
                                            Muslim kingdoms of Maguindanao and Sulu.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Spanish era</h6>

                                        <p>
                                            Although the Spaniards began to explore the Davao Gulf area as early as the 16th century, Spanish influence was 
                                            negligible in the Davao region until 1842, when the Spanish Governor General of the Philippines Narciso Clavería 
                                            ordered the colonization of the Davao Gulf region, including what is now Davao City, for the Spanish Crown.
                                        </p>

                                        <p>
                                            This came after the loss of their colonies in the Americas from 1820s to 1830s which gravely reduced their 
                                            sources of revenue to the point that the royal government in Madrid could no longer continue to properly provide 
                                            financial support to what remained of its worldwide colonies. Thus, it became more urgent for local officials in 
                                            the colonies, including the Philippines, to find ways and means of expanding the revenues in running the colonies, 
                                            primarily in terms of tribute extracted from the natives. It meant that for the first time, the Spanish colonial 
                                            government in the Philippines was compelled to embark on a full-scale conquest of Mindanao in the hopes of 
                                            increasing its coffers.
                                        </p>

                                        <p>
                                            Davao Gulf seemed to be a tempting target among Spanish military circles based in Manila for its thriving 
                                            maritime trade taking place there. Their initial forays began with their incursion on the village of 
                                            Sigaboy in 1842, from which the local Spanish officials who recently landed there immediately demanded heavy 
                                            tribute on the natives who then asked for Datu Bago's help in expelling the Spaniards, which he responded 
                                            swiftly by sending a combined naval and land force in the area to defeat and drive out the Spanish force there.
                                        </p>

                                        <p>
                                            The Spanish, whom they saw Datu Bago as a mere pirate and brigand, didn't take the threat seriously for years 
                                            despite the numerous defeats they have suffered under his hands until the burning of the Spanish trading vessel 
                                            San Rufo, which carried a letter of friendship from Sultan Iskandar Qudaratullah Muhammad Zamal al-Azam of Maguindanao 
                                            to Governor General Claveria, and its massacre of all its crew by seaborne corsairs under orders from Datu Bago 
                                            himself in 1846.
                                        </p>

                                        <p>
                                            Incensed with the incident, the Spanish secured the consent from the Sultan of Maguindanao who finally disowned 
                                            the Moros of the Davao Gulf by using the incident as pretext for justification to conquer the area, thus official 
                                            Spanish colonization of Davao Gulf finally began in earnest in April 1848 when an expedition of 70 men and women 
                                            led by José Cruz de Uyanguren of Vergara, Spain, landed on the estuary of the Davao River the same month, 
                                            intent on conquering Pinagurasan, the capital of Datu Bago's domain, in the hopes of permanently ending the menace 
                                            posed on Spanish vessels by Moro raiders in the Davao Gulf.
                                        </p>

                                        <p>
                                            Being the strongest chieftain in the region, Datu Bago imposed heavy tribute on the Mandaya tribes nearby, therefore 
                                            also making him the most loathed chieftain in the region. Cruz de Uyanguren has orders from the higher authorities 
                                            in Manila to colonize the Davao Gulf region, which included the Bagobo settlement on the northern riverbank; in return, 
                                            he asked for the position of the governor of the conquered area and granted the monopoly of its commerce for ten years. 
                                            At this juncture, a Mandaya chieftain named Datu Daupan, who then ruled Samal Island, came to him, seeking for an 
                                            alliance against Datu Bago.
                                        </p>

                                        <p>
                                            The two chieftains were archrivals, and Cruz de Uyanguren took advantage of it, initiating an alliance between Spain 
                                            and the Mandayas of Samal Island. Intent on taking the settlement for Spain, he and his men accordingly assaulted it, 
                                            but the Bagobo natives fiercely resisted the attacks, which resulted in his Samal Mandaya allies to retreat and not 
                                            fight again. Thus, a three-month long inconclusive battle for the possession of the settlement ensued which was only 
                                            decided when an infantry company which sailed its way by warships from Zamboanga came in as reinforcements, thus ensuring 
                                            the takeover of the settlement and its surroundings by the Spaniards while the defeated Bagobos fled further inland 
                                            while Datu Bago and his followers fled north to Hijo where he would die two years later.
                                        </p>

                                        <p>
                                            After Cruz de Oyanguren defeated Bago and conquered Pinagurasan, he founded the town of Nueva Vergara, the future Davao, 
                                            in the mangrove swamps of what is now Bolton Riverside on June 29, 1848, in honor of his home in Spain and becoming its 
                                            first governor. Pinagurasan was then incorporated into the new town. Almost two years later on February 29, 1850, the 
                                            province of Nueva Guipúzcoa was established via a royal decree, with the newly founded town as the capital, once again 
                                            to honor his homeland in Spain. When he was the governor of the province, however, his plans of fostering a positive 
                                            economic sway on the region backfired, which resulted in his eventual replacement under orders of the colonial government.
                                        </p>

                                        <p>
                                            The Spanish control of the town was unstable at best, as its Lumad and Moro natives routinely resisted the attempts of 
                                            the Spanish authorities to forcibly resettle them and convert them into Christians. Despite all these, however, such 
                                            were all done in the goal of making the governance of the area easier, dividing the Christians both settlers and native 
                                            converts and the Muslim Moros into several religion-based communities within the town.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">During the Philippine Revolution</h6>

                                        <p>
                                            As the Philippine Revolution, having been fought for two years, neared its end in 1898, the expected departure of the 
                                            Spanish authorities in Davao became apparent—although they took no part in the war at all, for there were no revolutionary 
                                            figures in the vicinity save a negligible pro-Filipino separatist rebel movement in the town of Santa Cruz in the south. 
                                            When the war finally ended, as the Spanish authorities finally left the town, two Davaoeño locals by the names of Pedro Layog 
                                            and Jose M. Lerma represented the town and the region at the Malolos Congress of 1898, therefore indicating Davao as a part of 
                                            the nascent First Philippine Republic.
                                        </p>

                                        <br>

                                        <p>
                                            The period of Filipino revolutionary control of Davao did not last long, however, as the Americans landed at the town later the same year. 
                                            There was no record of locals offering any sort of resistance to the Americans.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">American Period</h6>

                                        <p>
                                            As the Americans began their administration of the town in 1900, economic opportunities quickly arose as huge swathes of its 
                                            areas, mainly lush forests and fertile grasslands, were declared open for agricultural investment. A result of this, foreign 
                                            businessmen especially Japanese entrepreneurs started settling the region, staking their claims on the vast lands of Davao and 
                                            turned them into huge plantations of coconut and banana products.
                                        </p>

                                        <p>
                                            In just a short period, Davao changed from a small and sparsely-inhabited town into a bustling economic center serving mainly 
                                            the Davao Gulf region, heavily populated alongside natives by tens of thousands of settlers and economic migrants from Luzon, 
                                            Visayas and Japan. All of this led the Port of Davao to be established and opened the same year, in order to facilitate the 
                                            international export of agricultural products from Davao.
                                        </p>

                                        <p>
                                            Because of the rapidly increasing progress of the town, on March 16, 1936, congressman Romualdo Quimpo from Davao filed Bill 609 
                                            (passed as Commonwealth Act 51), creating the City of Davao from the town of Davao and the municipal district of Guianga. 
                                            The bill called for the appointment of local officials by the president. By that time, the new city was already mostly populated 
                                            with Japanese businessmen and settlers who then became its locals. Davao was inaugurated as a charter city on October 16, 1936, 
                                            by President Manuel L. Quezon the charter came into effect on March 1, 1937. It was one of the first two towns in Mindanao to 
                                            be converted into a city, the other being Zamboanga.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Davao during World War II</h6>

                                        <p>
                                            On December 8, 1941, Japanese planes bombed the harbor, and from December 20 they landed forces and began an occupation of the 
                                            city which lasted to 1945. Davao was among the earliest to be occupied by Japanese forces, and the city was immediately fortified 
                                            as a bastion of Japanese defense.
                                        </p>

                                        <p>
                                            The city was subjected to extensive bombing by forces led by Douglas MacArthur before American forces landed in Leyte in October 1944. 
                                            The Battle of Davao towards the end of World War II was one of the longest and bloodiest battles during the Philippine Liberation, 
                                            and brought tremendous destruction to the city, setting back the economic and physical strides made before the Japanese occupation.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Post War Growth</h6>

                                        <p>
                                            Davao regained its status as the agricultural and economic hub of Mindanao after the war ended in 1945. Wood products such as 
                                            plywood and timber, and More agricultural products being produced within the city, such as copra and other varieties of banana, 
                                            became available for export. Some Japanese locals—80% percent of the city's population prior to the war's end—assimilated with 
                                            the Filipino population, while others were expelled from the country by the Filipino locals, due to recent enmity.
                                        </p>

                                        <p>
                                            Davao was peaceful and increasingly progressive in the postwar period, including the 1950s and the mid-1960s. Ethnic tensions 
                                            were minimal, and there was essentially no presence of secessionists groups in Mindanao.
                                        </p>

                                        <p>
                                            In 1967, the Province of Davao was divided into three provinces: Davao del Norte, Davao Oriental and Davao del Sur. 
                                            The city of Davao became part of Davao del Sur no longer the provincial capital, it became a commercial center of 
                                            southern Mindanao. This period also saw the first ever election of an indigenous person to the office of Mayor of 
                                            Davao City, when Elias Lopez, a full-blooded Bagobo, won the mayoral elections of 1967.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Social unrest, martial law, and the 1980s</h6>

                                        <p>
                                            Things began to take a turn for the worse late into Ferdinand Marcos' first presidential term, when news about the 
                                            Jabidah massacre ignited a furor in the Moro community, and ethnic tensions encouraged with the formation of 
                                            secessionist movements. An economic crisis in late 1969 led to social unrest, and violent crackdowns on protests 
                                            led to the radicalization of many students throughout the country. With no way to express their grievances about 
                                            government abuses after the declaration of Martial law in 1972, many of them joined the New People's Army (NPA),
                                             bringing the Communist rebellion in the Philippines to Davao and the rest of Mindanao for the first time.
                                        </p>

                                        <p>
                                            In the midst of this era, Davao became the regional capital of southern Mindanao; with the reorganization, it became 
                                            the regional capital of the Davao Region (Region XI) and highly urbanized city in the province of Davao del Sur.
                                        </p>

                                        <p>
                                            Meantime, violence in the city became severe as Mindanao became one of the hotbeds of the NPA insurgency. The NPA, 
                                            too, had become responsible for numerous abuses.[47] In 1985, locals formed the vigilante group "Alsa Masa" 
                                            (People's Rise) to counter them.
                                        </p>

                                        <p>
                                            Most Davao residents, however, remained staunchly against violence. This included the Roman Catholic Archbishop 
                                            of Davao Antonio L. Mabutas, who was among the first religious leaders to peacefully speak out against the Human 
                                            rights abuses of the Marcos dictatorship.[50] However, these peaceful citizens lacked the political clout to 
                                            influence the situation much before 1983.
                                        </p>

                                        <p>
                                            This only changed after the economic crisis of 1983 and the assassination of Ninoy Aquino later that year, 
                                            and the murder of prominent Davao City journalist Alex Orcullo at a checkpoint in Barangay Tigatto, Davao City on 
                                            October 19, 1984. These seminal events prompted prominent city figures like Soledad Duterte to organize a protest 
                                            group called the "Yellow Friday Movement", which slowly gained support until 1986, when Marcos was finally ousted 
                                            and forced into exile.
                                        </p>

                                        <p>
                                            Because the local leaders of the time were closely associated with Marcos, they were removed by the 1986 
                                            revolutionary government which took power after Marcos's ouster. President Corazon Aquino then appointed 
                                            Soledad Duterte's son, Rodrigo Duterte, as temporary Vice Mayor of Davao. Rodrigo Duterte later ran for 
                                            Mayor of Davao City and won, taking the top city office from 1988 to 1998, from 2001 to 2010, and yet again from 2013 to 2016, 
                                            after which he became President of the Philippines.
                                        </p>

                                        <br>


                                        <span class="fw-bold"> #Yesterdayishistory<br>#Tommorowisamystery<br>#Adventour</span>
                                    </div>
        
                                </div>

                                <div class="feed shadow">
                                    <div class="head">
                                        <div class="user">
                                            <div class="user-info">
                                                <h3> Davao City's Geography</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-photo">

                                        <div class="container" id="main-photo">
                                            <img src="./images/mtapo1.jpg" alt="Mt. Apo">
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p class="text-dark"><b style="color: var(--color-adventour);">Davao City</b>  is approximately 946 kilometres (588 mi) southeast of Manila over land, 
                                            and 971 kilometres (524 nmi) by sea. The city is located in southeastern Mindanao, on the northwestern shore of Davao Gulf, opposite Samal Island.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Topography</h6>

                                        <p>
                                            Davao City's land, totaling about 2,443.61 square kilometres (943.48 sq mi), is hilly in the west (the Marilog district) and slopes down to the 
                                            southeastern shore. Mount Apo, the highest peak in the Philippines, is located at the city's southwestern tip. Mount Apo National Park 
                                            (the mountain and its surrounding vicinity), was inaugurated by President Manuel L. Quezon (in Proclamation 59 of May 8, 1936) to protect the flora 
                                            and fauna of the surrounding mountain range.
                                        </p>

                                        <p>
                                            The Davao River is the city's primary drainage channel. Draining an area of over 1,700 km2 (660 sq mi), the 160-kilometre (99 mi) river begins in 
                                            the town of San Fernando, Bukidnon. The mouth of the river is located at Barangay Bucana at Talomo District.
                                        </p>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Climate</h6>

                                        <p>
                                            Davao has a tropical rainforest climate, with little seasonal variation in temperature. The areological mechanism
                                             of the Intertropical Convergence Zone occurs more often than that of the trade winds and because it experiences rare cyclones the climate is
                                              not purely equatorial but subequatorial. Average monthly temperatures are always above 26 °C (78.8 °F), and average monthly rainfall is above 
                                              77 millimetres (3.03 in). This gives the city a tropical climate, without a true dry season; while there is significant rainfall in winter, 
                                              the largest rainfall occurs during the summer months.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Flora and fauna</h6>

                                        <p>
                                            Mount Apo is home to many bird species, 111 of which are endemic to the area. It is also home to one of the world's largest eagles, 
                                            the critically endangered Philippine eagle, the country's national bird. The Philippine Eagle Foundation is based near the city. 
                                            Plant species include the orchid waling-waling, also known as the "Queen of Philippine Flowers" as well as one of the country's 
                                            national flowers, which are also endemic to the area. Fruits such as mangosteen (known as the "queen of fruits") and durian 
                                            (known as the "king of fruits"), grow abundantly on Mount Apo.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Geology</h6>

                                        <p>
                                            Despite Davao City's location in the Asian portion of the Pacific Ring of Fire, the city has suffered few earthquakes and most have been minor. 
                                            Mount Apo, 40 kilometres (25 mi) southwest from the city proper, is a dormant volcano.
                                        </p>

                                        <br>

                                        <span class="fw-bold"> #DavaoGeographics<br>#Adventour</span>
                                    </div>
        
                                </div>

                                <div class="feed shadow">
                                    <div class="head">
                                        <div class="user">
                                            <div class="user-info">
                                                <h3> Davao City Demographics</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-photo">

                                        <div class="container" id="main-photo">
                                            <img src="./images/demographics1.jpg" alt="Davao City Demographics">
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p class="text-dark"><b style="color: var(--color-adventour);">As of 2020 census</b>, the city has a total population of 1,776,949 people.[10] Metro Davao, 
                                            with the city as its center, had about 2.77 million inhabitants in 2015, making it the third-most-populous metropolitan area in the Philippines and the most-populous 
                                            city in Mindanao. In the 1995 census, the city's population reached 1,006,840 inhabitants, becoming the first city in the Philippines outside Metro Manila and the fourth 
                                            nationwide to exceed one million inhabitants. The city's population increase during the 20th century was due to massive immigration waves coming from other parts of the 
                                            nation and the trend continues to this day.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Ethnicities</h6>

                                        <div class="caption-photo">
                                            <img src="./images/ethnicity1.jpg" alt="Ethnicities">
                                        </div>

                                        <p>
                                            Residents of Davao City and the whole corresponding Davao Region are colloquially known as Davaoeños. Nearly all local Davaoeños are Visayans (the majority are Cebuanos, 
                                            with the rest being Hiligaynons), while others of different ethnicities especially the indigenous ones collectively categorized as the Lumads make up the remainder of 
                                            the local population.
                                        </p>

                                        <p>
                                            Other ethnicities are mostly Tagalogs and Ilokanos, descendants of settlers from Ilocos Region, Cordillera Administrative Region, Cagayan Valley, Central Luzon, 
                                            Metro Manila, and Calabarzon. The Moro groups of the city are the Maguindanaons, Maranaos, Iranuns, Tausugs and the Sama-Bajaus.
                                        </p>

                                        <p>
                                            Non-Filipino Asians such as Indonesians, Malaysians, Chinese Filipinos, Koreans, Japanese have settled and made small communities in Davao City. 
                                            Non-Asian foreigners such as the Americans and Europeans are also present in small numbers in the city.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">languages</h6>


                                        <p>
                                            Cebuano is the most widely used language in the city and its satellite cities and towns, while Filipino comes close as second spoken, although most locals have 
                                            shifted to the latter language in recent times. English is the medium of instruction in schools and is widely understood by residents, who often use it in varying 
                                            professional fields. Aside from Cebuano, Chavacano and Hiligaynon are widely used in addition to languages indigenous to the city, such as Giangan, Kalagan, 
                                            Tagabawa, Matigsalug, Ata Manobo, and Obo. Other languages spoken in the city include Maguindanao, Maranao, Sama-Bajaw, Iranun, Tausug, and Ilocano.
                                        </p>

                                        <p>
                                            A linguistic phenomenon has developed in the city whereby locals significantly mix Filipino terms and grammar into their Cebuano speech because the older 
                                            generations speak Filipino to their children at home, and Cebuano is spoken in other everyday settings, making Filipino a secondary lingua franca.
                                        </p>

                                        <br>

                                        <h6 style="color: var(--color-adventour); font-weight: bold;">Religion</h6>

                                        <div class="caption-photo">
                                            <img src="./images/sanpedro1.jpg" alt="Ethnicities">
                                        </div>

                                        <p>
                                            The majority of Davao City's inhabitants are Roman Catholics forming 80% of the population. Other groups, such as the Iglesia ni Cristo, Miracle Crusade, 
                                            Pentecostal Missionary Church of Christ (4th Watch) and followers of the Kingdom of Jesus Christ, form eighteen percent of the city's religious background.
                                             Seventh-day Adventists, the United Church of Christ in the Philippines, Philippine Independent Church and Baptists are the other Christian denominations. 
                                        </p>

                                        <p>
                                            The remaining 2% belong to non-Christian faiths, mainly Islam. Some of the other faiths are Sikhism, Hinduism, Buddhism, animism, Judaism and the non-religious.
                                        </p>

                                        <p>
                                            The Restorationist Church Kingdom of Jesus Christ had its origins in the city. Apollo Quiboloy, who claims to be the "Appointed Son of God", is the leader of the movement.
                                        </p>

                                        <p>
                                            The Roman Catholic Archdiocese of Davao is the main metropolitan see of the Roman Catholic Church in southern Mindanao. It comprises the city of Davao, 
                                            the Island Garden City of Samal and the municipality of Talaingod in Davao del Norte province; under its jurisdiction are the three suffragan dioceses of Digos, 
                                            Tagum and Mati (the capital cities of the three Davao provinces). Archbishop Romulo Valles of the Archdiocese of Davao, appointed on February 11, 2012, by Pope Benedict XVI,
                                             took office on May 22, 2012, at San Pedro Cathedral. Saint Peter, locally known as San Pedro, is the patron saint of the city.
                                        </p>

                                        <span class="fw-bold"> #DavaoDemography<br>#Adventour2023</span>
                                    </div>
        
                                </div>
        
                            </div>
    
                            <div class="bottom-filler mb-5"></div>
    
    
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
                        <!---calculator-->
                        <div class="calculator-container mb-5">
                            <div class="calculator-grid">
                                <div class="output">
                                    <div data-previous-operand class="previous-operand"></div>
                                    <div data-current-operand  class="current-operand"></div>
                                </div>
                                <button data-all-clear class="span-two">AC</button>
                                <button data-delete>DEL</button>
                                <button data-operation>÷</button>
                                <button data-number>1</button>
                                <button data-number>2</button>
                                <button data-number>3</button>
                                <button data-operation>*</button>
                                <button data-number>4</button>
                                <button data-number>5</button>
                                <button data-number>6</button>
                                <button data-operation>+</button>
                                <button data-number>7</button>
                                <button data-number>8</button>
                                <button data-number>9</button>
                                <button data-operation>-</button>
                                <button data-number>.</button>
                                <button data-number>0</button>
                                <button data-equals class="span-two">=</button>
                            </div>
                        </div>
                    </div>

                    <div class="bottom-filler"> </div>
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
   
    







    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="navjs.js"></script>
    <script src="calfunc.js"></script>
    <script src="site-search.js"></script>
</body>
</html>