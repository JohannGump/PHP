<?php

session_start();
/*
 * SQLCTRL.php
 */

require_once '../lib/Connexion.php';
require_once '../lib/Metabase.php';
require_once '../lib/VARDUMP.php';
require_once '../lib/Generateur.php';


$texte = "";

$pdo = Connexion::seConnecter("../conf/bd.ini");

$tListeBDs = Metabase::getBDsFromServeur($pdo);
$action = filter_input(INPUT_GET, "action");

$output = filter_input(INPUT_GET, "output");
if ($output == null) {
    $output = $_SESSION["output"];
//    if (isSet($_SESSION["output"])) {
//        $output = $_SESSION["output"];
//    } else {
//        $_SESSION["output"] = $output;
//    }
} else {
    $_SESSION["output"] = $output;
}
//echo "<br>$output<br>";

switch ($action) {
    case "selectionBDValidee":
        $bd = filter_input(INPUT_GET, "listeBDs");
        $_SESSION["bd"] = $bd;
        $tListeTables = Metabase ::getTablesFromBD($pdo, $bd);
        break;

    case "selectionTableValidee":
        $table = filter_input(INPUT_GET, "listeTables");
        $_SESSION["table"] = $table;
        $bd = $_SESSION["bd"];
//        vardump($bd);
//        vardump($table);
        $tListeTables = Metabase ::getTablesFromBD($pdo, $bd);
        $tListeColonnes = Metabase::getColumnsNamesFromTable($pdo, $bd, $table);
//        vardump($tListeColonnes);

        $haut = file_get_contents("../modeles/ModeleWebPageFormTableACompleterHaut.php");
        $bas = file_get_contents("../modeles/ModeleWebPageFormTableACompleterBas.php");

        switch ($output) {
            case "FormTable":
                $milieu = Generateur::getTableForm($tListeColonnes);
                break;

            case "FormUlLi":
                $milieu = Generateur::getTableUlLi($tListeColonnes);
                break;

            case "dao":
                $haut = "";
                $bas = "";
                $milieu = Generateur::getDAO($table, $tListeColonnes);
                break;

            case "dto":
                $haut = "";
                $bas = "";
                $milieu = Generateur::getDTO($table, $tListeColonnes);
                break;

            default:
                $_SESSION["output"] = $output;
                break;
        }

        $lsFusion = $haut . $milieu . $bas;
        $texte = $lsFusion;

        $nomDuFichier = $bd . "_" . $table . ".php";
        file_put_contents("../outputs/" . $nomDuFichier, $lsFusion);

        break;
    default:
        break;
}
include "../boundaries/SQLIHM.php";
?>
