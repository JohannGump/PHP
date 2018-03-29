<?php

// --- SQL parametre : VillesDelete.php
header("Content-Type: text/html; charset=UTF-8");

$lsMessage = "";

$cp = filter_input(INPUT_POST, "cp");

if ($cp != null) {
    try {
        /*
         * Connexion
         */
        $lcnx = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $lcnx->exec("SET NAMES 'UTF8'");

        /*
         * SUPPRESSION
         */
        $lsSQL = "DELETE FROM villes WHERE cp = ?";
        $lcmd = $lcnx->prepare($lsSQL);
        $lcmd->bindParam(1, $cp, PDO::PARAM_STR);
        $lcmd->execute();
        $lsMessage = $lcmd->rowcount() . " enregistrement(s) supprimé(s)";

        $lcnx = null;
    } catch (PDOException $e) {
        $lsMessage = $e->getMessage();
    }
} else {
    $lsMessage = "Toutes les saisies sont obligatoires";
}
include './VillesDeleteIHM.php';

