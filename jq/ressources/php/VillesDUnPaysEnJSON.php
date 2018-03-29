<?php

/**
 * VillesDUnPaysEnJSON.php
 */
/*
 * Connexion a la BD
 */
try {
    $lcnx = new PDO("mysql:host=localhost;port=3306;dbname=ajax;", "root", "");
    $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcnx->exec("SET NAMES 'UTF8'");
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

/*
 * Recuperation de l'attribut de requete
 */
//    header("Content-Type: application/json; charset=UTF-8");

$cp = filter_input(INPUT_GET, "cp");

try {
    $lsSelect = "SELECT * FROM villes WHERE cp = ?";
    $lrs = $lcnx->prepare($lsSelect);
    $lrs->execute(array($cp));
    $lrs->setFetchMode(PDO::FETCH_NUM);
    $enr = $lrs->fetch();

//    $tVille = array();

    if ($enr[1] === null) {
        $tVille = array("cp" => "", "nomVille" => "Introuvable", "idPays" => "");
//        $tVille["cp"] = "";
//        $tVille["nomVille"] = "Introuvable";
//        $tVille["idPays"] = "";
    } else {
        $tVille = array("cp" => $enr[0], "nomVille" => $enr[1], "idPays" => $enr[2]);
//        $tVille["cp"] = $enr[0];
//        $tVille["nomVille"] = $enr[1];
//        $tVille["idPays"] = $enr[2];
    }

    $lrs->closeCursor();
} catch (PDOException $e) {
//        echo "<br>" . $e->getMessage() . "<br>";
    $tVille = array("cp" => "", "nomVille" => $e->getMessage(), "idPays" => "");
//    $tVille["cp"] = "";
//    $tVille["nomVille"] = $e->getMessage();
//    $tVille["idPays"] = "";
}

// Transforme les donnees PHP (un tableau associatif)
// en donnees JSON (un objet JSON)
echo json_encode($tVille);
?>
