<?php

header("Content-Type: application/xml");
// Pas d'espace avant * !!! qd c'est jQuery
header("Access-Control-Allow-Origin:*");
// --- PaysSelectEnXML.php

$lsContenu = "";

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT id_pays, nom_pays FROM pays";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->execute();

//    $dom = new DomDocument('1.0', 'UTF-8');
//    $root = $dom->createElement("root");
//    $dom->appendChild($root);
//
//    foreach ($lrs as $enr) {
//        // --- Creation d'un element pays
//        $pays = $dom->createElement("pays");
//
//        // --- Creation des attributs id_pays et nom_pays
//        $pays->setAttribute("id_pays", $enr[0]);
//        $pays->setAttribute("nom_pays", $enr[1]);
//
//        // --- Ajout du pays a ROOT ie le niveau racine
//        $dom->documentElement->appendChild($pays);
//    }

    $lsContenu .= "<root>";
    foreach ($lrs as $enr) {
        $lsContenu .= "<pays id_pays='$enr[0]' nom_pays='$enr[1]' />";
    }
    $lsContenu .= "</root>";

    $lcn = null;
} catch (PDOException $e) {
    $lsContenu = $e->getMessage();
}

//echo $dom;
echo $lsContenu;
?>