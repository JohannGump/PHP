<?php

/*
 * ClientsInsert.php ()
 */

header("Content-Type: text/html; charset=UTF-8");

$lsMessage = "";

require_once '../lib/Connexion.php';

$pdo = seConnecter("../conf/cours.ini");

$id_client = filter_input(INPUT_POST, "id_client");
$nom = filter_input(INPUT_POST, "nom");
$prenom = filter_input(INPUT_POST, "prenom");
$adresse = filter_input(INPUT_POST, "adresse");
$date_naissance = filter_input(INPUT_POST, "date_naissance");
$cp = filter_input(INPUT_POST, "cp");

if ($id_client != null) {
    try {
        $lsSQL = 'INSERT INTO clients(id_client,nom,prenom,adresse,date_naissance,cp) VALUES(?,?,?,?,?,?)';
        initialiser($pdo);
        $lcmd = $pdo->prepare($lsSQL);
        $lcmd->execute(array($id_client, $nom, $prenom, $adresse, $date_naissance, $cp));
        valider($pdo);
        $lsMessage = $lcmd->rowcount() . " enregistrement(s) ajouté(s)";
    } catch (Exception $e) {
        annuler($pdo);
        $lsMessage = $e->getMessage();
    }
} else {
    $lsMessage = "Toutes les saisies sont obligatoires";
}

echo $lsMessage;
