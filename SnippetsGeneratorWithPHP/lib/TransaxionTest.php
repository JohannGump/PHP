<?php

/*
 * TransaxionTest.php
 */

require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';

$lcnx = Connexion::seConnecter("../conf/bd.ini");

try {
    Transaxion::initialiser($lcnx);
    $lsSQL = "INSERT INTO cours.pays(id_pays, nom_pays) VALUES(?,?)";
    $lcmd = $lcnx->prepare($lsSQL);
    $id = "SR";
    $nom = "Serbie";
    $lcmd->bindParam(1, $id, PDO::PARAM_STR);
    $lcmd->bindParam(2, $nom, PDO::PARAM_STR);
    $liAffecte = $lcmd->execute();
    Transaxion::valider($lcnx);
    echo "Insertions : $liAffecte"  ;
} catch (Exception $exc) {
    echo $exc->getMessage();
    Transaxion::annuler($lcnx);
}

Connexion::seDeconnecter($lcnx);
?>