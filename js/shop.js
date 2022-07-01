// --------DODAJ DO KOSZYKA --------

function dodajProdukt(id){
    if(sessionStorage.getItem(id)){
        let qtyNew = parseInt(sessionStorage.getItem(id)) + 1
        sessionStorage.setItem(id, qtyNew);
    }else{
        sessionStorage.setItem(id, 1);
    }
}