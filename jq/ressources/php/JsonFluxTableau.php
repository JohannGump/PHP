<?php
/*
 * JsonFluxTableau.php
 */
header("Content-Type: application/json; charset=UTF-8");

// Les data de base
$tVilles = array();

$tVilles["Paris"] = "200000";
$tVilles["Lyon"] = "100000";
$tVilles["Marseille"] = "150000";

// PAS BESOIN ... un vrai bazar
//$tVillesTableau = array($tVilles);

// Ajoute au debut
//array_unshift($tVillesTableau, '"villes":[');
// Ajoute a la fin
//$tVillesTableau[""] = "]";

// La creation de la chaine JSON contenant plusieurs valeurs (un tableau)
// PAS BESOIN : json-encode accepte un tableau associatif comme parametre !!!
// IL FAUT des "
$chaineJSON = '{"villes": [';
foreach ($tVilles as $key => $value) {
    $chaineJSON .= '{"nom_ville":"$key","habitants":"$value"},';
}
$chaineJSON = substr($chaineJSON, 0, -1);
$chaineJSON .= "] }";
// Affichage de la "chaine" JSON
echo "<br><pre>";
var_dump($chaineJSON);
echo "</pre><br>";

// Ceci est KO, non ça a l'air bon
$objetJSON = json_encode($chaineJSON);
echo $objetJSON;

echo "<br><br><br>";

$objetJSON = json_encode(array($tVilles));
echo $objetJSON;

// Le flux
//echo $chaineJSON;
?>