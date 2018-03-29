<?php

$lsMessage = "";

$nom = filter_input(INPUT_GET, "nom");
$prenom = filter_input(INPUT_GET, "prenom");

if ($nom == null || $prenom == null) {
    $liAffectes = "t'as rien saisi";
} else {
    try {
        /*
         * Connexion
         */
        require_once "../lib/Connexion.php";
        require_once "../lib/Transaction.php";

        $pdo = seConnecter("../conf/cours.ini");
        $liAffectes = 0;

        initialiser($pdo);
        
        /*
         * SUPPRESSION
         */
        $lsSQL = "DELETE FROM clients WHERE nom = ? AND prenom = ?";
        $lcmd = $pdo->prepare($lsSQL);
        $lcmd->bindParam(1, $nom, PDO::PARAM_STR);
        $lcmd->bindParam(2, $prenom, PDO::PARAM_STR);
        $lcmd->execute();
        $lsMessage = $lcmd->rowcount() . " enregistrement(s) supprimé(s)";

        valider($pdo);
        
    } catch (PDOException $e) {
        $lsMessage = $e->getMessage();
    }
   
}

echo($lsMessage);

include './ClientDesinscriptionIHM.php';
