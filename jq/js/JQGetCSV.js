/**
 *
 * @returns {undefined}
 */
function afficherCSV() {
    $.get(
            //"../ressources/csv/villes.txt",
            "../ressources/php/VillesSelect.php",
            function(data) {
                console.log(data);
                // Pour transformer les RC en <br>
                var regex = /\n/g;
                data = data.replace(regex, "<br>");
                console.log(data);
                $("#pResultat").html(data);
            }
    ); /// $.get
} /// afficherCSV

/**
 *
 * @returns {undefined}
 */
function getHeure() {
    var maintenant = new Date();
    return maintenant.getHours() + ":" + maintenant.getMinutes() + ":" + maintenant.getSeconds();
} /// getHeure


// -------------------------
$(document).ready(function() {
    $("#pHeure").html("Il est " + getHeure());
    $("#btGo").on("click", afficherCSV);
});

