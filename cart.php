<!DOCTYPE html>
<html lang="pl">
    <?php
    foreach (glob("templates/*.php") as $filename){ include $filename; }
    foreach (glob("classes/*.php") as $filename){ include $filename; }

    $db = new Baza('localhost', 'root', '', 'vinstore-db');
    
    //include_once 'templates/head.php';
    echo get_head('Koszyk - VinStore');
    ?>
    <body class="d-flex flex-column min-vh-100">
        <main class="pb-5">

            <!-- Navigation-->
            <?php echo get_nav(); ?>

            <div class="container">
                <div class="py-5 text-center">
                    <h2>Koszyk</h2>
                    <p class="lead"></p>
                </div>

                <div class="row g-5">
                    <div class="col-md-12 col-lg-12 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary rounded-pill"><!--ILOSC POZYCJI W KOSZYKU--></span>
                        </h4>
                        <ul class="list-group mb-3" id="cartTable">
                        
                            <?php
                                $pm = new ProductManager();
                                echo $pm->showCart($db);
                            ?>

                        </ul>
                        <div class="d-flex justify-content-center">
                            <form action="checkout.php" onsubmit="return pustyKoszyk()">
                                <input class="btn btn-primary btn-lg mx-2" id="checkoutLink" type="submit" value="Zamówienie"/>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </main>
        <!-- Footer-->
        <?php echo get_footer(); ?>
    </body>
</html>
