<?php

// --- VillesInsert.php

$cp = filter_input(INPUT_POST, "cp");
$nomVille = filter_input(INPUT_POST, "nom_ville");
$idPays = filter_input(INPUT_POST, "id_pays");
$lsMessage = "";

try {
    $lcn = new PDO("mysql:host=localhost;dbname=ajax", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "INSERT INTO villes(cp, nom_ville, id_pays) VALUES(?,?,?)";
    $lcmd = $lcn->prepare($lsSQL);
    $lcmd->execute(array($cp, $nomVille, $idPays));

    $lsMessage = $lcmd->rowcount() . " enregistrement(s) ajouté(s)";

    $lcn = null;
} catch (PDOException $e) {
    $lsMessage = $e->getMessage();
}
echo $lsMessage;
?>