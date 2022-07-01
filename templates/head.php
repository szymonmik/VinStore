<?php
function get_head($title){
    $temp = '
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>'.$title.'</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- jQuery 3.6.0 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="css/style.css" rel="stylesheet" />
    
    ';

    if($_SERVER['REQUEST_URI'] == '/VinStore/index.php' || $_SERVER['REQUEST_URI'] == '/VinStore/'){
        $temp .= '<script src="js/featuredProducts.js"></script>';
    }
    if($_SERVER['REQUEST_URI'] == '/VinStore/shop.php' || $_SERVER['REQUEST_URI'] == '/VinStore/index.php' || $_SERVER['REQUEST_URI'] == '/VinStore/'){
        $temp .= '<script src="js/shop.js"></script>';
    }
    if($_SERVER['REQUEST_URI'] == '/VinStore/shop.php'){
        $temp .= '<script src="js/pagination.js"></script>';
    }
    if($_SERVER['REQUEST_URI'] == '/VinStore/cart.php'){
        $temp .= '<script src="js/cart.js"></script>';
    }
    if($_SERVER['REQUEST_URI'] == '/VinStore/checkout.php'){
        $temp .= '<script src="js/checkout.js"></script>';
    }
    if($_SERVER['REQUEST_URI'] == '/VinStore/contact.php'){
        $temp .= '<script src="js/kontakt.js"></script>';
        $temp .= '<script src="http://maps.googleapis.com/maps/api/js"></script>';
    }

    $temp .= '</head>';


    


    return $temp;
    
}
?>