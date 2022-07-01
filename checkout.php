<!DOCTYPE html>
<html lang="en">
    <?php
    foreach (glob("templates/*.php") as $filename){ include $filename; }
    foreach (glob("classes/*.php") as $filename){ include $filename; }

    $db = new Baza('localhost', 'root', '', 'vinstore-db');
    $um = new UserManager();
    session_start();
    $sessid = session_id();
    if ($um->getLoggedInUser($db, $sessid) < 1) {
        header("location:login.php");
    }
    session_destroy();
    
    echo get_head('Zamówienie - VinStore');
    ?>
    <body class="d-flex flex-column">
        <main class="pb-5">
            <!-- Navigation-->
            <?php
                echo get_nav();
            ?>

            <div class="container">
                <div class="py-5 text-center">
                    <h2>Zamówienie</h2>
                    <p class="lead"></p>
                </div>

                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Koszyk</span>
                            <span class="badge bg-primary rounded-pill"><!--ILOSC POZYCJI W KOSZYKU--></span>
                        </h4>
                        <ul class="list-group mb-3" id="cartTable">

                            <?php
                                $pm = new ProductManager();
                                echo $pm->showCartCheckout($db);
                            ?>

                            <!--<li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">Produkt 1</h6>
                                    <small class="text-muted">Opis</small>
                                </div>
                                <span class="text-muted">12 zł</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Suma</span>
                                <strong>12 zł</strong>
                            </li>-->
                        </ul>

                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Adres</h4>
                        <form class="needs-validation" action="checkout.php" method="POST">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">Imię</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Nazwisko</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" required>
                                </div>

                                <div class="col-sm-12">
                                    <label for="lastName" class="form-label">Telefon</label>
                                    <input type="text" class="form-control" id="phoneNumber" pattern="[0-9]{9}"
                                           placeholder="123456789" required>
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="email@email.com">
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Adres</label>
                                    <input type="text" class="form-control" id="address" required>
                                </div>

                                <div class="col-12">
                                    <label for="address2" class="form-label">Adres c.d. <span class="text-muted">(opcjonalnie)</span></label>
                                    <input type="text" class="form-control" id="address2"
                                           placeholder="Apartment or suite">
                                </div>

                                <div class="col-md-5">
                                    <label for="country" class="form-label">Państwo</label>
                                    <select class="form-select" id="country" required>
                                        <option value="">Wybierz...</option>
                                        <option>Polska</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="state" class="form-label">Województwo</label>
                                    <select class="form-select" id="state" required>
                                        <option value="">Wybierz...</option>
                                        <option>Lubelskie</option>
                                        <option>Mazowieckie</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="zip" class="form-label">Kod pocztowy</label>
                                    <input type="text" class="form-control" id="zip" placeholder="12-345"
                                           pattern="[0-9]{2}-[0-9]{3}" required>
                                </div>
                            </div>

                            <!--<hr class="my-4">

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="same-address">
                                <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="save-info">
                                <label class="form-check-label" for="save-info">Save this information for next time</label>
                            </div>-->

                            <hr class="my-4">

                            <h4 class="mb-3">Płatność</h4>

                            <div class="my-3">
                                <div class="form-check">
                                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input"
                                           checked required>
                                    <label class="form-check-label" for="credit">Karta kredytowa</label>
                                </div>
                                <div class="form-check">
                                    <input id="debit" name="paymentMethod" type="radio" class="form-check-input"
                                           required>
                                    <label class="form-check-label" for="debit">Karta debetowa</label>
                                </div>
                                <div class="form-check">
                                    <input id="paypal" name="paymentMethod" type="radio" class="form-check-input"
                                           required>
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div>
                            </div>

                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label for="cc-name" class="form-label">Imię i nazwisko</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                    <small class="text-muted">Pełne imię i nazwisko podane na karcie.</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="cc-number" class="form-label">Numer karty</label>
                                    <input type="text" class="form-control" id="cc-number"
                                           pattern="[0-9]{4}[ ]{1}[0-9]{4}[ ]{1}[0-9]{4}[ ]{1}[0-9]{4}"
                                           placeholder="1234 1234 1234 1234" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-expiration" class="form-label">Data ważności</label>
                                    <input type="text" class="form-control" id="cc-expiration"
                                           pattern="[0-9]{2}/[0-9]{2}" placeholder="MM/RR" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" pattern="[0-9]{3}"
                                           placeholder="123" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <input class="w-100 btn btn-primary btn-lg" type="submit" name="submit" value="Zamów">
                        </form>

                        <?php
                            if (filter_input(
                                INPUT_POST,
                                'submit',
                                FILTER_SANITIZE_FULL_SPECIAL_CHARS
                            )) {
                                echo "<h3>Poprawne dane zamówienia</h3>";
                                
                                
                                //$user->show();
                                //$user->saveDB($db);
                                }
                        ?>
                    </div>
                </div>
            </div>

        </main>
        <!-- Footer-->
        <?php
            echo get_footer();
        ?>
    </body>
</html>
