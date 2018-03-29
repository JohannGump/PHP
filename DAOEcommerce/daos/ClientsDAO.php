<?php

/*
 * ClientsDAO.php
 */

require_once '../daos/VillesDAO.php';

/**
 * 
 * @param type $pdo
 * @return array
 */
function selectOneCLient(PDO $pdo, $id) {
    $tData = array();

    return $tData;
}

/**
 * 
 * @param PDO $pdo
 * @param array $tData
 * @return int
 */
function deleteClient(PDO $pdo, $id_client) {
    $lAffecte = 0;

    try {
        $lsSQL = 'CALL deleteClient(?)';
        //$lsSQL = 'DELETE FROM clients WHERE id_client=?';      
        $lcmd = $pdo->prepare($lsSQL);
        $lcmd->execute(array($id_client));
        $tVilles = selectAllVille($pdo);
    } catch (Exception $e) {
        $liAffectes = -1;
        echo($e->getMessage());
    }

    return $lAffecte;
}

/**
 * 
 * @param PDO $pdo
 * @param array $tData
 * @return int
 */
function insertClient(PDO $pdo, Array $tData) {
    $lAffecte = 0;
    try {
        $lsSQL = 'CALL insertClient(?,?,?,?,?)';
        //$lsSQL = 'INSERT INTO clients(id_client,nom,prenom,adresse,date_naissance,cp) VALUES(?,?,?,?,?,?)';
        $lcmd = $pdo->prepare($lsSQL);
        $lcmd->execute($tData);
    } catch (Exception $e) {
        $lAffecte = -1;
        echo($e->getMessage());
    }
    return $lAffecte;
}

/**
 * 
 * @param PDO $pdo
 * @param array $tData
 * @return int
 */
function updateClient(PDO $pdo, Array $tData) {
    $lAffecte = 0;

    try {
        $lsSQL = 'CALL updateClient (?,?,?,?,?,?)';
        //$lsSQL = 'UPDATE clients SET nom=?,prenom=?,adresse=?,date_naissance=?,cp=? WHERE id_client=?';
        $lcmd = $pdo->prepare($lsSQL);
        $lcmd->execute($tData);
        echo($lcmd->rowcount() . " enregistrement modifié");
    } catch (Exception $e) {
        $lAffecte = -1;
        echo($e->getMessage());
    }

    return $lAffecte;
}

?>
