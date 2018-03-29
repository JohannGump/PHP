var jqXHR = $.get(
        "../ressources/json/ville.json",
        function(data) {
            console.log(data);
            $("#lblMessage").html(data.ville + " [" + data.codePostal + "] compte " + data.habitants + " habitants");
        },
        "json"
        ); /// $.get

jqXHR.fail(function(xhr, statut, erreur) {
    console.log("Erreur AJAX : " + xhr.status + "-" + xhr.statusText + " : " + statut);
    $("#lblMessage").html(xhr.status + "-" + xhr.statusText);
});

