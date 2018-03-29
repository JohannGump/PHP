<?php

/*
 * JsonEcrireFichierPlusieurs.php
 */

header("Content-Type: application/json; charset=UTF-8");

// Les data de base
$tVilles = array();
$tVilles["Paris"] = "200000";
$tVilles["Lyon"] = "100000";
$tVilles["Marseille"] = "150000";

// La creation de la chaine JSON contenant plusieurs valeurs (un tableau)
$chaineJSON = '{"villes": [';
foreach ($tVilles as $key => $value) {
    $chaineJSON .= '{"nom_ville":"' . $key . '","habitants":"' . $value . '"},';
}
$chaineJSON = substr($chaineJSON, 0, -1);
$chaineJSON .= "] }";

// Affichage de la "chaine" JSON
var_dump($chaineJSON);

// Ceci est KO
$objetJSON = json_encode($chaineJSON);
file_put_contents("/home/pascal/tests_linux/villes.json", $objetJSON);

// Ecriture dans le fichier
//file_put_contents("/home/pascal/tests_linux/villes.json", $chaineJSON);

?>