var jqXHR = $.get(
        "../ressources/json/villes.json",
        function(data) {
           // data = JSON.parse(data); // Dé-sérialisation
            console.log(data);
            var lsVilles = "";
            for (var i = 0; i < data.length; i++) {
                lsVilles += data[i].codePostal + " - " + data[i].ville + "<br>";
            }
            $("#lblMessage").html(lsVilles);
        },
        "json"
        ); /// $.get 

jqXHR.fail(function(xhr, statut, erreur) {
    console.log("Erreur AJAX : " + xhr.status + "-" + xhr.statusText + " : " + statut);
    $("#lblMessage").html(xhr.status + "-" + xhr.statusText);
});

