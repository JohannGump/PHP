<?php
header("Access-Control-Allow-Origin:*");
//header("Content-Type: text/plain");
// --- PaysSelectEnJSON.php
// On renvoie une chaine JSON
// Ou un objet JSON

$chaineJSON = "";

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT id_pays, nom_pays FROM pays";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->execute();

    // Un tableau de pays
    // Tableau nomme
    $chaineJSON = '{"pays": [';
    // Tableau non nomme
//    $chaineJSON = '[';
    while ($enr = $lrs->fetch()) {
        $chaineJSON .= '{"id_pays":"' . $enr["id_pays"] . '","nom_pays":"' . $enr["nom_pays"] . '"},';
    }
    // La derniere virgule
    $chaineJSON = substr($chaineJSON, 0, -1);
    // Tableau nomme
    $chaineJSON .= "] }";
    // Tableau non nomme
//    $chaineJSON .= "]";

    $lcn = null;
} catch (PDOException $e) {
    //$chaineJSON = $e->getMessage();
}

// On renvoie une chaine JSON (OK en JS pur, KO en jQuery)
echo $chaineJSON;
// On renvoie un objet JSON ... un vrai bazar cote JS pur
// Mais avec jQuery il faut renvoyer un objet
//echo json_encode($chaineJSON);
?>