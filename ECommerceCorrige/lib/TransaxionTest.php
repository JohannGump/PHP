<?php

/*
 * TransaxionTest.php
 */

require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';

$lcnx = seConnecter("../conf/cours.ini");

try {

    initialiser($lcnx);

    $lsSQL = "INSERT INTO pays(id_pays, nom_pays) VALUES(?,?)";

    $lcmd = $lcnx->prepare($lsSQL);

    $id = "SR";
    $nom = "Serbie";

    $lcmd->bindParam(1, $id, PDO::PARAM_STR);
    $lcmd->bindParam(2, $nom, PDO::PARAM_STR);

    $lcmd->execute();

    valider($lcnx);
} catch (Exception $exc) {
    echo $exc->getMessage();
    annuler($lcnx);
}

seDeconnecter($lcnx);
?>