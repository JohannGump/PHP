/**
 *
 * @returns {undefined}
 */
function init() {
    $("#btGo").on("click", afficherCSV);
} /// init

/**
 *
 * @returns {undefined}
 */
function afficherCSV() {
    console.log("afficherCSV");

    var jqXHR = $.get(
            "../ressources/csv/villes.txt"
            );

    jqXHR.done(function(data) {
        console.log("done");
        console.log(data);
        // Pour transformer les RC en <br>
        var regex = /\n/g;
        data = data.replace(regex, "<br>");
        console.log(data);
        $("#pResultat").html("Done<br>" + data);
    });

    jqXHR.fail(function(xhr, statut, erreur) {
// xhr.status : 404
// xhr.statusText : Not Found
// statut : error
// erreur : Not Found par exemple
        $("#pResultat").html("Erreur : " + xhr.status + "-" + xhr.statusText);
    });
} /// afficherCSV

// --------------------
$(document).ready(init);


