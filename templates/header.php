<?php
function get_header(){
    return '
    <header class="container-fluid bg-dark py-5 d-inline-block w-100 h-100 bg-image home-header">
                <div class="container-fluid px-5 py-5">
                    <div class="row gx-5 align-items-center justify-content-center py-5">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2">VinStore</h1>
                                <p class="lead fw-normal text-white-50 mb-4">Najrzadsze albumy tylko u nas</p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <a class="btn btn-primary btn-lg px-4 me-sm-3" href="shop.php">Sklep</a>
                                    <a class="btn btn-outline-light btn-lg px-4" href="contact.php">Kontakt</a>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="https://dummyimage.com/600x400/343a40/6c757d" alt="..." /></div>-->
                    </div>
                </div>
            </header>
    ';
}