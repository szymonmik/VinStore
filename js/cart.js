
// --------DODAJ DO KOSZYKA --------

function dodajProdukt(id) {
    if (sessionStorage.getItem(id)) {
        let qtyNew = parseInt(sessionStorage.getItem(id)) + 1
        //localStorage.setItem(id, qtyNew);
        sessionStorage.setItem(id, qtyNew);
    } else {
        //localStorage.setItem(id, 1);
        sessionStorage.setItem(id, 1);
    }
    window.location.reload();
}

// ---------- USUN Z KOSZYKA ----------
function removeFromCart(id) {
    sessionStorage.removeItem(id);
    //showCart();
    window.location.reload();
}

// -------- SPRAWDZ CZY PUSTY --------
function pustyKoszyk() {
    if (sessionStorage.length != 0) {
        return true;
    } else {
        window.alert("Koszyk jest pusty!")
        return false;
    }
}

// ----- INCREMENT CART ITEM
function incrementCartItem(id) {
    let qtyNew = parseInt(sessionStorage.getItem(id)) + 1
    //localStorage.setItem(id, qtyNew);
    sessionStorage.setItem(id, qtyNew);
    //showCart();
    window.location.reload();
}


// ----- DECREMENT CART ITEM
function decrementCartItem(id) {
    if (sessionStorage.getItem(id) > 1) {
        let qtyNew = parseInt(sessionStorage.getItem(id)) - 1
        //localStorage.setItem(id, qtyNew);
        sessionStorage.setItem(id, qtyNew);
        window.location.reload();
    }
    //showCart();
}
