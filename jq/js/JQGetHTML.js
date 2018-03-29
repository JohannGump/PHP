/**
 *
 * @returns {undefined}
 */
function afficherHTML() {
    $.get(
            //"../ressources/csv/villes.txt",
            "../ressources/php/VillesSelectEnJSON.php",
            function(data) {
                console.log(data);
                console.log(data.villes[0].cp);
                for (var i=0; i < data.villes.length; i++){
                    var cp_ville = data.villes[i].cp;
                    var nom_ville = data.villes[i].nom_ville;
                    $("#listeVilles").append("<tr><td>" + cp_ville + "</td>" + "<td>" + nom_ville + "</td></tr>");
               };
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
    $("#btGo").on("click", afficherHTML);
});