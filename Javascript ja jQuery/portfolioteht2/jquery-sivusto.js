$(document).ready(function () {

    function vaihdaNaviMenu() {
        $(this).toggleClass("auki kiinni");
    }
    $("#sivupalkki > nav").on("click", vaihdaNaviMenu);

    function vaihdaValilehti() {
        var valittuNavi = $("#sisalto .valittu");
        var klikattuNavi = $(this);
        var valittuTabiId = valittuNavi.data("tab");
        var klikattuTabiId = klikattuNavi.data("tab");
        if (valittuTabiId === klikattuTabiId) {
            return;
        }
        valittuNavi.removeClass("valittu");
        klikattuNavi.addClass("valittu");
        var valittuTabi = $(`#tab${valittuTabiId}`);
        var klikattuTabi = $(`#tab${klikattuTabiId}`);
        valittuTabi.removeClass("valittu");
        klikattuTabi.addClass("valittu");
    }
    $("#sisalto [data-tab]").on("click", vaihdaValilehti);

    function toggleNappi() {
        var kayttoehdotHyvaksytty = $(this).is(":checked");
        $("input[type='submit']").prop("disabled", !kayttoehdotHyvaksytty);
    }
    $("#hyvaksykayttoehdot").on("click", toggleNappi);

    function lomakeValidointi(event) {
        var kentat = $("#nimimerkkikentta, #sahkopostikentta, #salasanakentta1, #salasanakentta2");
        var kenttaLista = kentat.toArray();
        function onkoKenttaTyhja(kentta) {
            return kentta.value.length === 0;
        }
        var ainakinYksiKenttaVaarin = kenttaLista.some(onkoKenttaTyhja);
        var salasanaVirheLoytyi = $(".salasana-vaarin").length;
        if (ainakinYksiKenttaVaarin || salasanaVirheLoytyi) {
            $(".rlabel").addClass("varoitus");
            event.preventDefault();
        }
    }
    $("#rekisteroityminen").on("submit", lomakeValidointi);

    function salasananPituudenValidointi() {
        if ($(this).val().length >= 8) {
            $(this).removeClass("salasana-vaarin").addClass("salasana-oikein");
        } else {
            $(this).removeClass("salasana-oikein").addClass("salasana-vaarin");
        }
    };
    $("#salasanakentta1").on("keyup", salasananPituudenValidointi);

    function samanSalasananValidointi() {
        var tamaKentta = $(this);
        if (tamaKentta.attr("id") === "salasanakentta1") {
            var toinenKentta = $("#salasanakentta2");
        } else {
            var toinenKentta = $("#salasanakentta1");
        }
        if (tamaKentta.val() === toinenKentta.val()) {
            $("#salasanakentta2").removeClass("salasana-vaarin").addClass("salasana-oikein");
        } else {
            $("#salasanakentta2").removeClass("salasana-oikein").addClass("salasana-vaarin");
        }
    };
    $("#salasanakentta1, #salasanakentta2").on("keyup", samanSalasananValidointi);

    $("#salasanakentta1").on("focus", function () { $(".ohje").show() });
    $("#salasanakentta1").on("blur", function () { $(".ohje").hide() });

    function poistaRivi() {
        $(this).closest("tr").remove();
    }
    $(".poisto > button").on("click", poistaRivi);

    function lisaaRivi() {
        $("#laskentataulukko").append('<tr><td></td><td></td><td></td><td></td><td></td><td class="poisto"><button>Poista</button></td></tr>"');
    }
    $("#lisaarivi").on("click", lisaaRivi);

    function tallennaSolu(solu) {
        solu.parent().html(solu.val());
    };

    function muokkaaSolua() {
        var tallentamatonSolu = $("#laskentataulukko td > input").first();
        if (tallentamatonSolu.length > 0) {
            tallennaSolu(tallentamatonSolu);
        }

        var solunSisalto = $(this).html();
        var solunEditori = $("<input>");
        solunEditori.val(solunSisalto);
        $(this).html(solunEditori).children("input");
        solunEditori.focus();
    }
    $(document).on("dblclick", "#laskentataulukko td", muokkaaSolua);

    function solunNappainPainallustenKasittelija(event) {
        if (event.key === "Enter") {
            tallennaSolu($(this));
        }
    }
    $(document).on("keyup", "#laskentataulukko td > input", solunNappainPainallustenKasittelija);

    // https://stackoverflow.com/a/6274381
    function sekoitaLista(lista) {
        for (var i = lista.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            [lista[i], lista[j]] = [lista[j], lista[i]];
        }
        return lista;
    }

    var yrityksiaJaljella = 3;

    function naytaYrityksiaJaljella() {
        $("#viesti").text(`Yrityksi?? j??ljell??: ${yrityksiaJaljella}`);
    }

    function naytaYrityksetLoppuivat() {
        $("#viesti").text("K??ytit kaikki yrityksesi ????");
    }

    function naytaVoitto() {
        $("#viesti").text("Voitit! ????");
    }

    function naytaHavisit() {
        $("#viesti").text("H??visit! ????");
    }

    function lopetaPeli() {
        $("#kortit td").off("click");
    }

    function kaannaKortti() {
        // N??yt?? k????nt??puoli.
        var kuva = $(this).children("img");
        var kaantoPuoli = kuva.data("kaantoPuoli");
        kuva.attr("src", `${kaantoPuoli}.png`);

        // V??henn?? yrityksi??.
        yrityksiaJaljella--;

        // Tee kortin vaatimat toimenpiteet.
        switch (kaantoPuoli) {
            case "aurinko":
                yrityksiaJaljella++;
                break;
            case "sydan":
                naytaVoitto();
                lopetaPeli();
                return;
            case "sydanrikki":
                naytaHavisit();
                lopetaPeli();
                return;
        }

        // N??yt?? yritykset tai lopeta peli.
        if (yrityksiaJaljella) {
            naytaYrityksiaJaljella();
        } else {
            naytaYrityksetLoppuivat();
            lopetaPeli();
        }
    }

    function aloitaPeli() {
        var kortit = [
            "aurinko", "sydan", "sydanrikki", "tyhjakortti",
            "aurinko", "sydan", "sydanrikki", "tyhjakortti",
            "aurinko", "sydan", "sydanrikki", "tyhjakortti",
        ];
        kortit = sekoitaLista(kortit);
        kortit.forEach(function (kortti, indeksi) {
            var korttiElementti = $(`#kortit td > img[data-indeksi="${++indeksi}"]`);
            korttiElementti.data("kaantoPuoli", `${kortti}`);
        });
        $("#aloita").hide();
        naytaYrityksiaJaljella();
        /* T??ss?? voisi k??ytt???? my??s "one"-funktiota "one"-funktion
         * sijaan. T??ll??in "off"-funktiota ei tarvitsisi kutsua. */
        $("#kortit td").one("click", kaannaKortti);
    }
    $("#aloitusnappi").on("click", aloitaPeli);
});