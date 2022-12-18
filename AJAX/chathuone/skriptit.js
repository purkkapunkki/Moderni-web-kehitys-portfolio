$(document).ready(function () {
    function viestienHaku() {
        console.log("haetaan viestejä...");
        $.get("hae_viestit.php", function (data) {
            $("#viestit").html(data);
        });
    }
    $("#nappi").on("click", function () {
        var data = {
            kirjoittaja: $("#nimi").val(),
            sisalto: $("#viesti").val(),
        };
        $.post("tallenna_viesti.php", data, function (success) {
            $("#viesti").val('');
            viestienHaku();

        });
    });

    viestienHaku();
    setInterval(viestienHaku, 5000)





});
