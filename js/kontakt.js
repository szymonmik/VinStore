$( document ).ready(function() {
    showMap(51.238416178273056,22.57130413692802);
});

function showMap(lat, long){
    var wspolrzedne = new google.maps.LatLng(lat,long);
    var opcjeMapy = {
        zoom: 10,
        center: wspolrzedne,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapa = new google.maps.Map(document.getElementById("geoMap"), opcjeMapy);
    var marker = new google.maps.Marker({
        position: wspolrzedne,
        title: "VinStore"
    });
    marker.setMap(mapa);
}

function wyswietlDane(){
    var dane="Czy dane są poprawne?:\n";
    dane+="Imię i nazwisko: "+document.getElementById('inputName').value+"\n";
    dane+="Email: "+document.getElementById('inputEmail').value+"\n";
    dane+="Telefon: "+document.getElementById('inputPhone').value+"\n";
    dane+="Wiadomość: "+document.getElementById('inputMessage').value+"\n";

    if (window.confirm(dane)) return true;
    else return false;
}

function sprawdz(){

    var ok=true;
    if(ok){
        if(wyswietlDane()){
            return true
        }
        else return false;
    }

    return ok;
}