<!DOCTYPE html>
<html lang="pl">
<?php
    foreach (glob("templates/*.php") as $filename){ include $filename; }
    foreach (glob("classes/*.php") as $filename){ include $filename; }

    $db = new Baza('localhost', 'root', '', 'vinstore-db');

    echo get_head('Sklep - VinStore');
    ?>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <?php
                echo get_nav();
            ?>

            <!--shop loop-->
            <section class="py-0">
                <div class="container px-5 my-0">
                    <div class="row gx-5 justify-content-center">
                        <div class="py-5 px-0 px-md-5 mb-0">
                            <div class="text-center mb-5">
                                <h1 class="fw-bolder">Sklep</h1>
                            </div>
                        <!--<div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                                <h2 class="fw-bolder">Sklep</h2>
                                <p class="lead fw-normal text-muted mb-5">Albumy</p>
                            </div>
                        </div>-->
                    </div>
                    <div class="row gx-5 album-catalog" id="album-catalog">
                        <!-- pozycje z PHP -->
                        <?php
                            $pm = new ProductManager;
                            echo $pm->shop_loop($db);
                        ?>
                    </div>
                    <div class="d-flex justify-content-center py-5" id="pagination-wrapper">
                        <!-- przyciski -->
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
