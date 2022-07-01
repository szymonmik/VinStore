<?php
class ProductManager {
    public function show_single_product($id, $title, $artist, $genre, $year, $description, $duration, $cover, $price, $stock){
        $assets_uri = 'http://'.$_SERVER['HTTP_HOST'].'/VinStore/assets/';
        $modal_parameters = "'".$id."','".$title."','".$artist."','".$description."','".$duration."','".$assets_uri.$cover."','".$price."','".$stock."'";
        //echo $modal_parameters;
        $content = '
        <div class="col-lg-4 col-sm-12 col-md-12 mb-5" onClick="albumModal('.$modal_parameters.');">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="'.$assets_uri.$cover.'" alt="id:'.$id.'" />
                            <div class="card-body p-4 pb-0">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">'.$genre.'</div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!" ><h5 class="card-title mb-3">'.$artist.' - '.$title.'</h5></a>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="small>
                                            <div class="text-muted">'.$year.' &middot; '.$duration.'</div>
                                        </div>
                                        <div class="fw-bold">'.$price.' zł</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
        ';
        return $content;
    }

    public function featured_3($db, $id1, $id2, $id3){
        $sql = "SELECT * FROM products WHERE id in (".$id1.", ".$id2.", ".$id3.")";
        $result = $db->getMysqli()->query($sql);
        while( $row = mysqli_fetch_assoc( $result)){
            echo $this->show_single_product($row['id'], $row['title'], $row['artist'], $row['genre'], $row['year'], $row['description'], $row['duration'], $row['cover'], $row['price'], $row['stock']);
        }
    }
    
    public function shop_loop($db){
        $sql = "SELECT * FROM products";
        $result = $db->getMysqli()->query($sql);
        while( $row = mysqli_fetch_assoc( $result)){
            echo $this->show_single_product($row['id'], $row['title'], $row['artist'], $row['genre'], $row['year'], $row['description'], $row['duration'], $row['cover'], $row['price'], $row['stock']);
        }
    }

    public function showCart($db) {
        $cartTable = "";
        $totalPrice = 0;
        $rows = [];
        $sql = "SELECT * FROM products";
        $result = $db->getMysqli()->query($sql);
        while( $row = mysqli_fetch_assoc( $result)){
            $rows[] = $row;
        }
        
        echo '<script>var tablica = '.json_encode($rows).';
            console.log(tablica);
            var totalPrice = 0;
            var cartTable = "";
            for(var i = 0; i<tablica.length; i++){
                console.log("sprawdzam:"+tablica[i]["id"]);
                if(sessionStorage.getItem(tablica[i]["id"])){
                    console.log("Jest w koszyku:"+tablica[i]["id"]);
                    let pID = i+1;
                    let qty = sessionStorage.getItem(pID);
                    console.log(pID+" "+qty);
                    cartTable += `
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div class="d-flex">
                                    <div>
                                        <img class="me-4" width="50px" height="50px" src="http://localhost/Vinstore/assets/${tablica[i][\'cover\']}" alt="id:tablica[${i}][\'cover\']" />
                                    </div>
                                    <div>
                                        <h6 class="my-0 ">${tablica[i][\'artist\']} - ${tablica[i][\'title\']}</h6>
                                        <small class="text-muted">Ilość - ${qty} 
                                            <div class="btn-group ps-2" role="group">
                                                <button type="button" onclick="decrementCartItem(${pID})" class="btn btn-outline-dark px-2 py-0">-</button>
                                                <button type="button" onclick="incrementCartItem(${pID})" class="btn btn-outline-dark px-2 py-0">+</button>
                                            </div>
                                        </small>
                                    </div>
                                </div>
                                <div>
                                 
                                    <span class="text-muted">${tablica[i][\'price\']} zł</span>
                                    <button class="btn btn-close" onclick="removeFromCart(${pID})"></button>
                                </div>
                            </li>`;
                    totalPrice += parseFloat(tablica[i]["price"] * qty);
                }
            }
            cartTable += `
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Suma</span>
                        <strong>${totalPrice} zł</strong>
                    </li>
                `
    document.getElementById("cartTable").innerHTML = cartTable;
        </script>';
    }

    public function showCartCheckout($db) {
        $cartTable = "";
        $totalPrice = 0;
        $rows = [];
        $sql = "SELECT * FROM products";
        $result = $db->getMysqli()->query($sql);
        while( $row = mysqli_fetch_assoc( $result)){
            $rows[] = $row;
        }
        
        echo '<script>var tablica = '.json_encode($rows).';
            console.log(tablica);
            var totalPrice = 0;
            var cartTable = "";
            for(var i = 0; i<tablica.length; i++){
                console.log("sprawdzam:"+tablica[i]["id"]);
                if(sessionStorage.getItem(tablica[i]["id"])){
                    console.log("Jest w koszyku:"+tablica[i]["id"]);
                    let pID = i+1;
                    let qty = sessionStorage.getItem(pID);
                    console.log(pID+" "+qty);
                    cartTable += `
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div class="d-flex">
                            <div>
                                <img class="me-4" width="50px" height="50px" src="http://localhost/Vinstore/assets/${tablica[i][\'cover\']}" alt="id:${tablica[i][\'cover\']}" />
                            </div>
                            <div>
                                <h6 class="my-0 ">${tablica[i][\'artist\']} - ${tablica[i][\'title\']}</h6>
                                <small class="text-muted">Ilość - ${qty}</small>
                            </div>
                        </div>
                        <div>
                     
                            <span class="text-muted">${tablica[i][\'price\']} zł</span>
                        </div>
                    </li>`;
                    totalPrice += parseFloat(tablica[i]["price"] * qty);
                }
            }
            cartTable += `
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Suma</span>
                        <strong>${totalPrice} zł</strong>
                    </li>
                `
    document.getElementById("cartTable").innerHTML = cartTable;

    var data = {};
    for(var len = sessionStorage.length, i = 0; i < len; i++) {
    var key =  sessionStorage.key(i);
    data[key] = sessionStorage.getItem(key);
    }
    console.log(data);
    $(document).ready(function(){
        console.log("test");
        $.ajax({ type: "POST", url: "checkout.php", data: data });
    });
    
        </script>';
        
    }
    
    function saveToDB($db, $dane){
        $args = [];
        $dane = filter_input_array(INPUT_POST, $args);
        $sql = "INSERT INTO orders VALUES (NULL, '".$dane['userId']."','".$dane['productsId']."','".$dane['quantities']."','".$dane['price']."','".$dane['status']."')";
    }
    
    
}
