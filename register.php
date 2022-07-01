<!DOCTYPE html>
<html lang="pl">
<?php
foreach (glob("templates/*.php") as $filename) {
    include $filename;
}
foreach (glob("classes/*.php") as $filename) {
    include $filename;
}
echo get_head('Rejestracja - VinStore');
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
                        <h1 class="fw-bolder">Rejestracja nowego konta</h1>
                    </div>

                    <?php
                    $db = new mysqli('localhost', 'root', '', 'vinstore-db');
                    $rf = new RegistrationForm();

                    if (filter_input(
                        INPUT_POST,
                        'submit',
                        FILTER_SANITIZE_FULL_SPECIAL_CHARS
                    )) {
                        $user = $rf->checkUser(); //sprawdza poprawność danych
                        if ($user === NULL)
                            echo "<h3>Niepoprawne dane rejestracji.</h3>";
                        else {
                            echo "<h3>Poprawne dane rejestracji:</h3>";
                            $user->show();
                            //$user->save("users.json");
                            //$user->saveXML("users.xml");
                            $user->saveDB($db);
                        }
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