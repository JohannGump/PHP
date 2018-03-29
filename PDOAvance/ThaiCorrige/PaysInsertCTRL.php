<?php

/*
 * PaysInsertCTRL.php
 */

$id_pays = filter_input(INPUT_POST, "id_pays");
$nom_pays = filter_input(INPUT_POST, "nom_pays");

if ($id_pays == null || $nom_pays == null) {
    $liAffectes = "T'as rien saisi abruti !!!";
} else {
    //echo "Jusque là tout va bien !!!";
    require_once "../lib/Connexion.php";
    require_once "../lib/Transaction.php";
    $pdo = seConnecter("../conf/cours.ini");
    $liAffectes = 0;
    try {
        initialiser($pdo);
        $sql = "INSERT INTO pays(id_pays, nom_pays) VALUES(?,?)";
        $lcmd = $pdo->prepare($sql);
        $lcmd->bindParam(1, $id_pays);
        $lcmd->bindParam(2, $nom_pays);
        $liAffectes = $lcmd->execute();
        valider($pdo);
    } catch (PDOException $e) {
        $liAffectes = -1;
        annuler($pdo);
    }
}

include './PaysInsertIHM.php';
