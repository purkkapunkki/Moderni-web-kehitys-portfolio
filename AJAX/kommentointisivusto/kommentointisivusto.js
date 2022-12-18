$(document).ready(function () {
    $.get("asiakirja.php", function (data) {
        $("article").html(data);
        $("#kommentit").hide();
    });

    $.get("asiakirjavalinta.php", function (data) {
        $("#asiakirjavalinta").append(data);
    });

    $("#asiakirjavalinta").on("change", function () {
        var id = $(this).val();
        var url = "asiakirja.php";

        $(".kommentti").remove();

        if (id !== "") {
            url = url + `?id=${id}`;
        }
        $.get(url, function (data) {
            $("article").html(data);
        });

        if (id !== "") {
            $.get(`kommentit.php?asiakirja_id=${id}`, function (data) {
                $("#kommentit").prepend(data).show();
            });
        } else {
            $("#kommentit").hide();
        }
    });

    $("#laheta-kommentti").on("click", function () {
        var asiakirjaID = $("#asiakirjavalinta").val();
        var data = {
            kommentoija: $("#kommenttinimimerkki").val(),
            otsikko: $("#kommenttiotsikko").val(),
            teksti: $("#kommenttiteksti").val(),
            asiakirja_id: asiakirjaID,
        };
        $.post("lisaa_kommentti.php", data, function (success) {
            $("#kommenttinimimerkki").val('');
            $("#kommenttiotsikko").val('');
            $("#kommenttiteksti").val('');
            $.get(`kommentit.php?asiakirja_id=${asiakirjaID}`, function (kommenttiData) {
                $(".kommentti").remove();
                $("#kommentit").prepend(kommenttiData);
            });

        });
    });
});