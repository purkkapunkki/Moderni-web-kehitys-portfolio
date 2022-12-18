$(document).ready(function () {
    function naytaKuva(kuvaNumero) {
        $(".kuva.valittu").removeClass("valittu");
        $("#valilehdet span.valittu").removeClass("valittu");
        $("#tab" + kuvaNumero).addClass("valittu");
        $("#kuva" + kuvaNumero).addClass("valittu");
    }

    function valinta() {
        var kuvaIndeksi = $(this).data("kuva-indeksi");
        naytaKuva(kuvaIndeksi);
        clearInterval(ajastinId);
        kaynnistaAjastin();
    }

    $("#valilehdet span").on("click", valinta);

    function haeSeuraavaKuvaIndeksi(kuvaIndeksi) {
        var seuraavaKuvaIndeksi = kuvaIndeksi % 4;
        return ++seuraavaKuvaIndeksi;
    }

    function kuvanVaihtaja() {
        var nykyinenValilehti = $("#valilehdet > .valittu");
        var kuvaIndeksi = nykyinenValilehti.data("kuva-indeksi");
        var seuraavaKuvaIndeksi = haeSeuraavaKuvaIndeksi(kuvaIndeksi);
        naytaKuva(seuraavaKuvaIndeksi);
    }

    function kaynnistaAjastin() {
        ajastinId = setInterval(kuvanVaihtaja, 5000);
    }

    var ajastinId;
    kaynnistaAjastin();
});