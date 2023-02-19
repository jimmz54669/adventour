<?php
require_once 'shop-class.php';

//Condition to Call PHP Class Post functions using POST method
if(isset($_POST['func'])){

    $newShop = new Shop();

    switch($_POST['func']){
        case 'addedtocart' : $newShop->AddToCart();
        break;
        case 'placedorder' : $newShop->PlacedOrder();
        break;
    }

}

//Condition to Call PHP Class Get functions using GET method
if(isset($_GET['func'])){

    $newShop = new Shop();

    switch($_GET['func']){
        case 'getcartcnt' : $newShop->GetCartCntJson();
        break;
        case 'orderdetails' : $newShop->GetOrderDetailsJson();
        break;
    }

}


?>