<?php
header("Content-Type: text/plain");
// Tous les domaines
header("Access-Control-Allow-Origin: *");
// Seul 10.57.255.168 peut y acceder
//header("Access-Control-Allow-Origin: 10.57.255.168");
// --- VillesSelect.php
$lsContenu = "";

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT cp, nom_ville FROM villes";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->execute();

    foreach ($lrs as $enr) {
        $lsContenu .= "$enr[0];$enr[1]\n";
    }
    $lsContenu = substr($lsContenu, 0, -1);

    $lcn = null;
} catch (PDOException $e) {
    $lsContenu = $e->getMessage();
}

echo $lsContenu;
?>