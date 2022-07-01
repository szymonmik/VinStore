<!DOCTYPE html>
<html lang="pl">
<?php
foreach (glob("templates/*.php") as $filename) {
    include $filename;
}
foreach (glob("classes/*.php") as $filename) {
    include $filename;
}
echo get_head('Logowanie - VinStore');
?>

<body class="d-flex flex-column min-vh-100 bg-light">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <?php
        echo get_nav();
        ?>


        <!-- Page content-->
        <section class="py-0">
            <div class="container-fluid px-0">
                <!-- Contact form-->
                <div class="bg-light rounded-3 py-5 px-0 px-md-5 mb-0">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">Logowanie</h1>
                        <p class="lead fw-normal text-muted mb-0">Nie masz jeszcze konta? <a href="register.php">Zarejestruj się!</a></p>
                    </div>

                    <?php
                    $db = new Baza('localhost', 'root', '', 'vinstore-db');
                    $um = new UserManager();


                    //parametr z GET – akcja = wyloguj
                    if (filter_input(INPUT_GET, "akcja") == "wyloguj") {
                        $um->logout($db);
                    }
                    //kliknięto przycisk submit z name = zaloguj
                    if (filter_input(INPUT_POST, "zaloguj")) {
                        $userId = $um->login($db); //sprawdź parametry logowania
                        if ($userId > 0) {
                            echo "<p>Poprawne logowanie.<br />";
                            echo "Zalogowany użytkownik o id=$userId <br />";
                            //pokaż link wyloguj lub przekieruj
                            // użytkownika na inną stronę dla zalogowanych
                            //echo "<a href='login.php?akcja=wyloguj' >Wyloguj</a> </p>";
                            header("location:index.php");
                        } else {
                            
                            $um->loginForm(); //Pokaż formularz logowania
                            echo "<h4 class='my-5 text-center'>Błędna nazwa użytkownika lub hasło</h4>";
                        }
                    } else {
                        //pierwsze uruchomienie skryptu processLogin
                        $um->loginForm();
                    }
                    ?>

                </div>
            </div>
        </section>
    </main>
    <!-- Footer-->
    <?php
    echo get_footer();
    ?>
</body>

</html>