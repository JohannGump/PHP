<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id_pays = filter_input(INPUT_POST, "id_pays");
$nom_pays = filter_input(INPUT_POST, "nom_pays");

if($id_pays == null || $nom_pays == null){
    $liAffectes = "t'as rien saisi";
} else {
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
        //renvoie nombre de lignes affectées
        $liAfffectes = $lcmd->execute();               
        valider($pdo);
    } catch (Exception $e) {
        $liAffectes = -1;
        annuler($pdo); 
    } 
}

include './PaysInsertIHM.php';