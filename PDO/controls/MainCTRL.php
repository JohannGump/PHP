<?php

/*
 * MainCTRL.php
 */
$lsContenu = "";
$lsTable = [];


// --- VillesSelect.php
header("Content-Type: text/html; charset=UTF-8");

try {
    // Connexion
    $lcnx = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcnx->exec("SET NAMES 'UTF8'");

    // Préparation et exécution du SELECT SQL
    $lsSelect = "SELECT nom_ville FROM villes";
    //$lrs = $lcnx->prepare($lsSelect);
    //$lrs->execute();
    $lrs = $lcnx->query($lsSelect);

    // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
    // On boucle sur les lignes
    foreach ($lrs as $enr) {
        echo "<option value='$enr[0]]'> $enr[0]</option>\n";
    }

    // Fermeture du curseur (facultatif)
    $lrs->closeCursor();
}
// Gestion des erreurs
catch (PDOException $e) {
    $lsMessage = "Echec de l'exécution : " . $e->getMessage();
}

// Déconnexion (facultative)
$lcnx = null;

$btSubmit = filter_input(INPUT_GET, "btSubmit");
if ($btSubmit == null) {
    $btSubmit = filter_input(INPUT_POST, "btSubmit");
}

switch ($btSubmit) {

    case "delete":
        /*
         * SUPPRESSION
         */
        $lsNomVilles = filter_input(INPUT_GET, "nomVille");
        include "../boundaries/Acceuil.php";
        break;
}
?>

