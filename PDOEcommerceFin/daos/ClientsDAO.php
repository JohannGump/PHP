<?php

/*
 * ClientsDAO.php
 */

/**
 * 
 * @param PDO $pdo
 * @param type $id
 * @return type
 */
function selectClientByID(PDO $pdo, $id) {
    $lsSQL = 'SELECT * FROM clients WHERE id_client = ?';
    $lsSQL = 'CALL clientsSelectOne(?)';
    try {
        $lrs = $pdo->prepare($lsSQL);
        $lrs->execute(array($id));
        $lrs->setFetchMode(PDO::FETCH_ASSOC);
        $enr = $lrs->fetch();
    } catch (Exception $e) {
        $enr = $e->getMessage();
    }
    return $enr;
}

/**
 * 
 * @param PDO $pdo
 * @param type $nom
 * @param type $date_naissance
 * @return type
 */
function selectClientByNomAndDateNaissance(PDO $pdo, $nom, $date_naissance) {
//CALL clientsSelectOne(1)
    try {
        //$lsSQL = 'SELECT * FROM clients WHERE nom=? AND date_naissance=?';
        $lsSQL = 'CALL clientsAuthentification(?,?)';

        $lrs = $pdo->prepare($lsSQL);
        $lrs->setFetchMode(PDO::FETCH_ASSOC);
        $lrs->execute(array($nom, $date_naissance));
        $enr = $lrs->fetch();
    } catch (Exception $e) {
        $enr = $e->getMessage();
    }
    return $enr;
}

/**
 * 
 * @param PDO $pdo
 * @param type $id
 * @return type
 */
function deleteClient(PDO $pdo, $id) {
    $liAffecte = 0;
    try {
        $lsSQL = 'DELETE FROM clients WHERE id_client=?';
        $lsSQL = 'CALL clientsDeleteOne(?)';
        $lcmd = $pdo->prepare($lsSQL);
        $lcmd->execute(array($id));
        $liAffecte = $lcmd->rowCount();
    } catch (Exception $e) {
        $liAffecte = -1;
    }
    return $liAffecte;
}

/**
 * 
 * @param PDO $pdo
 * @param array $tData
 * @return int
 */
function insertClient(PDO $pdo, Array $tData) {
    $liAffecte = 0;
    try {
        $lsSQL = 'INSERT INTO clients(id_client,nom,prenom,adresse,date_naissance,cp) VALUES(?,?,?,?,?,?)';
        $lsSQL = 'CALL clientsInsertOne(?,?,?,?,?,?)';
        $lcmd = $pdo->prepare($lsSQL);
        $lcmd->execute(array_values($tData));
        $liAffecte = $lcmd->rowCount();
    } catch (Exception $e) {
        $liAffecte = -1;
    }
    return $liAffecte;
}

/**
 * 
 * @param PDO $pdo
 * @param array $tData
 * @return int
 */
function updateClient(PDO $pdo, Array $tData) {
    $liAffecte = 0;
    try {
        $lsSQL = 'UPDATE clients SET nom=?,prenom=?,date_naissance=?,adresse=?,cp=? WHERE id_client=?';
        $lcmd = $pdo->prepare($lsSQL);
        $lcmd->execute(array_values($tData));
        $liAffecte = $lcmd->rowCount();
    } catch (Exception $e) {
        $liAffecte = -1;
    }
    return $liAffecte;
}

// clientsAuthentification('Buguet','1955-10-03')
/*
  CALL clientsSelectOne(1);
  CALL clientsDeleteOne(101);
  CALL clientsAuthentification('Buguet','1955-10-03');

  CALL clientsInsertOne(101, 'Dalmatien', 'petit', '1930-08-28', 'Rue des chats', '75011');

  CALL clientsUpdateOne(101, 'Dalmatien', 'grand', '1930-08-28', 'Rue des chats', '75012');
 */
?>
