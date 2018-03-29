/*
 * JQGetCSVExo.js
 */

/**
 *
 * @returns {undefined}
 */
function afficherCSV() {
    $.get(
//            "../ressources/csv/villes.txt",
            "../ressources/php/VillesSelect.php",
            function (data) {
                console.log(data);
                // Pour transformer les RC en <br>

                var tEnrs = data.split("\n");
                for (var i = 0; i < tEnrs.length; i++) {
                    //console.log(tEnrs[i]);
                    var cp = tEnrs[i].split(";")[0];
                    console.log(cp);
                    var ville = tEnrs[i].split(";")[1];
                    console.log(ville);
                    $("#listeVilles").append("<option value='" + cp + "'>" + ville + "</option>");
                }

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
$(document).ready(function () {
    $("#pHeure").html("Il est " + getHeure());
    $("#btGo").on("click", afficherCSV);
});