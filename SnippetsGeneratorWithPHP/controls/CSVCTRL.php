<?php

session_start();
/*
 * CSVCTRL.php
 */
require_once '../lib/Metafile.php';
require_once '../lib/VARDUMP.php';
require_once '../lib/Generateur.php';

$texte = "";

$output = filter_input(INPUT_GET, "output");
if ($output == null) {
    $output = $_SESSION["output"];
} else {
    $_SESSION["output"] = $output;
}

$tListeFichiers = Metafile::getFiles("../ressources/", "csv");
$action = filter_input(INPUT_GET, "action");

switch ($action) {
    case "selectionFichierValidee":
        $fichier = filter_input(INPUT_GET, "listeFichiers");
        $_SESSION["fichier"] = $fichier;
        $tListeChamps = Metafile::getHeaders("../ressources/" . $fichier, ";");

        $haut = file_get_contents("../modeles/ModeleWebPageFormTableACompleterHaut.php");
        $bas = file_get_contents("../modeles/ModeleWebPageFormTableACompleterBas.php");

        switch ($output) {
            case "FormTable":
                $milieu = Generateur::getTableForm($tListeChamps);
                break;

            case "FormUlLi":
                $milieu = Generateur::getTableUlLi($tListeChamps);
                break;

            case "dao":
                $haut = "";
                $bas = "";
                $milieu = Generateur::getDAO($fichier, $tListeChamps);
                break;

            case "dto":
                $haut = "";
                $bas = "";
                $liPositionPoint = strpos($fichier, ".");
                $fichier = substr($fichier, 0, $liPositionPoint);
                $milieu = Generateur::getDTO($fichier, $tListeChamps);
                break;

            default:
                $_SESSION["output"] = $output;
                break;
        }

        $lsFusion = $haut . $milieu . $bas;
        $texte = $lsFusion;

        $nomDuFichier = "csv_" . $fichier . ".php";
        file_put_contents("../outputs/" . $nomDuFichier, $lsFusion);

        break;
    default:
        break;
}
include "../boundaries/CSVIHM.php";
?>
