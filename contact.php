<!DOCTYPE html>
<html lang="pl">
<?php
    foreach (glob("templates/*.php") as $filename){ include $filename; }
    foreach (glob("classes/*.php") as $filename){ include $filename; }

    $db = new Baza('localhost', 'root', '', 'vinstore-db');

    echo get_head('Kontakt - VinStore');
    ?>
    <body class="d-flex flex-column">
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
                            <h1 class="fw-bolder">Kontakt</h1>
                            <p class="lead fw-normal text-muted mb-0">W razie pytań prosimy o kontakt.</p>
                        </div>
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-8 col-xl-6">
                                <form action="mailto:szyymiik@gmail.com" onsubmit="return sprawdz()" method="post">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputName" type="text" placeholder="Imię i nazwisko..." required/>
                                        <label for="inputName">Imię i nazwisko</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" required/>
                                        <label for="inputEmail">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPhone" type="tel" pattern="[0-9]{9}" placeholder="123456789" required/>
                                        <label for="inputPhone">Telefon</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="inputMessage" type="text" placeholder="Wiadomość..." style="height: 10rem" required></textarea>
                                        <label for="inputMessage">Wiadomość</label>
                                    </div>
                                    <div class="form-floating mb-3 d-flex justify-content-center">
                                        <button class="btn btn-primary" type="submit">Wyślij</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="px-0 py-0">
                <div class="container-fluid px-0 py-0">
                    <!-- map-->
                    <div class="row gx-0 row-cols-12 row-cols-lg-12 px-0">
                        <div class="col-12">
                            <div class="col" id="geoMap" style="height: 400px;">
                                <!--MAPA HERE-->
                            </div>
                        </div>
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
