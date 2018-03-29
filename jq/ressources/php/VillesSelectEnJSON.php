<?php
// --- VillesSelectEnJSON.php
header("Content-Type: application/json");
// Tous les domaines
header("Access-Control-Allow-Origin: *");
// Seul l'IP 10.57.255.168 peut y acceder
//header("Access-Control-Allow-Origin: 10.57.255.168");

$lsContenu = "";

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT cp, nom_ville FROM villes";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->execute();

    $chaineJSON = '{"villes": [';
    while ($enr = $lrs->fetch()) {
        $chaineJSON .= '{"cp":"' . $enr["cp"] . '","nom_ville":"' . $enr["nom_ville"] . '"},';
    }
    // La derniere virgule
    $chaineJSON = substr($chaineJSON, 0, -1);
    $chaineJSON .= "] }";

    $lcn = null;
} catch (PDOException $e) {
    $chaineJSON = $e->getMessage();
}

echo $chaineJSON;
?>

