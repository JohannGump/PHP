<?php

/*
 * FusionDeFichiers.php
 */

$nomDuFichier = "Ville.php";

$haut = file_get_contents("ModeleWebPageACompleterHaut.php");
$bas = file_get_contents("ModeleWebPageACompleterBas.php");

$tColonnes = array();
$tColonnes[] = "ID";
$tColonnes[] = "Pseudo";
$tColonnes[] = "mdp";

$milieu = "";
for ($i = 0; $i < count($tColonnes); $i++) {
    $milieu .= "<tr>\n";
    $milieu .= "<td><label>$tColonnes[$i]</label></td>\n";
    $milieu .= "<td><input type='text' name='$tColonnes[$i]' value='' /></td>\n";
    $milieu .= "</tr>\n";
}

$lsFusion = $haut . $milieu . $bas;

file_put_contents($nomDuFichier, $lsFusion);
?>

