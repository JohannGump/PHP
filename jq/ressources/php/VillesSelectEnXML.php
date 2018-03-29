<?php
// --- VillesSelectEnXML.php
header("Content-Type: text/xml");
// Tous les domaines
header("Access-Control-Allow-Origin: *");
// Seul 10.57.255.168 peut y acceder
//header("Access-Control-Allow-Origin: 10.57.255.168");

$lsContenu = "";

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT * FROM villes";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->execute();

    $lsContenu .= "<root>";
    foreach ($lrs as $enr) {
        $lsContenu .= "<ville cp='$enr[0]' nom_ville='$enr[1]' />";
    }
    $lsContenu .= "</root>";

    $lcn = null;
} catch (PDOException $e) {
    $lsContenu = $e->getMessage();
}

echo $lsContenu;
?>