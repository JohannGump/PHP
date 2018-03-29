<?php

/*
 * TransaxionTest.php
 */

require_once '../lib/Connexion.php';
require_once '../lib/Transaction.php';

$lcnx = seConnecter("../conf/cours.ini");

try {

    initialiser($lcnx);

    $lsSQL = "INSERT INTO pays(id_pays, nom_pays) VALUES(?,?)";

    $lcmd = $lcnx->prepare($lsSQL);

    $id = "42";
    $nom = "Chez maman";

    $lcmd->bindParam(1, $id, PDO::PARAM_STR);
    $lcmd->bindParam(2, $nom, PDO::PARAM_STR);
   
    $liAffectes = $lcmd->execute();
    valider($lcnx);
    
    echo $liAffectes . " enregistrement ajouté ";
    
} catch (PDOException $exc) {
    echo $exc->getMessage();
    annuler($lcnx);
}

seDeconnecter($lcnx);
?>