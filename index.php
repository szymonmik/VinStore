<!DOCTYPE html>
<html lang="pl">
    <?php
    foreach (glob("templates/*.php") as $filename){ include $filename; }
    foreach (glob("classes/*.php") as $filename){ include $filename; }

    $db = new Baza('localhost', 'root', '', 'vinstore-db');

    echo get_head('Home - VinStore');
    ?>
    <body class="d-flex flex-column min-vh-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <?php
                echo get_nav();
            ?>
            <!-- Header-->
            <?php
                echo get_header();
            ?>
        </main>

        <section class="py-0">
            <div class="container px-5 my-0">
                <div class="row gx-5 justify-content-center">
                    <div class="py-5 px-0 px-md-5 mb-0">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder">Polecane</h1>
                        </div>
                    </div>
                    <div class="row gx-5 album-catalog" id="featured-products">
                        <!-- 3 polecane PHP -->
                        <?php
                            $pm = new ProductManager;
                            echo $pm->featured_3($db,10,9,6);

                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <?php
            echo get_footer();
        ?>
    </body>
</html>
