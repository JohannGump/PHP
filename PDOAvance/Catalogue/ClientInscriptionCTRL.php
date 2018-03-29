<?php

$nom = filter_input(INPUT_POST, "nom");
$prenom = filter_input(INPUT_POST, "prenom");
$adresse = filter_input(INPUT_POST, "adresse");
$datenaissance = filter_input(INPUT_POST, "date_naissance");
$cp = filter_input(INPUT_POST, "cp");

if($nom == null || $prenom == null || $adresse == null || $datenaissance == null || $cp == null){
    $liAffectes = "t'as rien saisi";
} else {
    require_once "../lib/Connexion.php";
    require_once "../lib/Transaction.php";
    
    $pdo = seConnecter("../conf/cours.ini");
    $liAffectes = 0;
    
    try {
        initialiser($pdo);
        $sql = "INSERT INTO clients(nom, prenom, adresse, date_naissance, cp) VALUES(?,?,?,?,?)";
        $lcmd = $pdo->prepare($sql);
        $lcmd->bindParam(1, $nom);
        $lcmd->bindParam(2, $prenom);
        $lcmd->bindParam(3, $adresse);
        $lcmd->bindParam(4, $datenaissance);
        $lcmd->bindParam(5, $cp);
        //renvoie nombre de lignes affectées
        $liAfffectes = $lcmd->execute();               
        valider($pdo);
    } catch (Exception $e) {
        $liAffectes = -1;
        annuler($pdo); 
    } 
}

include './ClientInscriptionIHM.php';

?>