<?php
function get_nav(){
    $temp = '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="index.php">VinStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Sklep</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Kontakt</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Koszyk <i class="bi bi-cart"></i></a></li>
    ';

    foreach (glob("classes/*.php") as $filename){ include_once $filename; }
    $db = new Baza("localhost", "root", "", "vinstore-db");
    $um = new UserManager();
    session_start();
    $sessid = session_id();
    session_destroy();
    $temp .= $um->getLoggedInUser($db, $sessid);
    if ($um->getLoggedInUser($db, $sessid) > 0) {
        $temp .= '<li class="nav-item"><a class="nav-link" href="login.php?akcja=wyloguj" >Wyloguj</a></li>';
    } else {
        $temp .= '
                    <li class="nav-item"><a class="nav-link" href="login.php">Zaloguj</i></a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Rejestracja</i></a></li>
        ';
    }

    $temp .= '
                </ul>
            </div>
        </div>
    </nav>
    ';

    return $temp;
}