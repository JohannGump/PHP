<?php

header("Content-Type: application/json");
// Tous les domaines
//header("Access-Control-Allow-Origin: *");
// Seul 10.57.255.168 peut y acceder
//header("Access-Control-Allow-Origin: 10.57.255.168");
// --- VillesSelectInJson.php

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT cp, nom_ville FROM villes";
    $lrs = $lcn->query($lsSQL);
    $t = $lrs->fetchAll(PDO::FETCH_ASSOC);

    $chaineJSON = json_encode($t);
    $lcn = null;
} catch (PDOException $e) {
}

echo $chaineJSON;
?>