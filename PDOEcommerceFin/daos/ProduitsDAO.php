<?php

/*
 * ProduitsDAO.php
 */

/**
 * 
 * @param PDO $pdo
 * @return array
 */
function selectAllProduits(PDO $pdo) {
    //$tData = array();
    try {
        //$lsSQL = 'SELECT * FROM produits ORDER BY designation';
        $lsSQL = 'CALL produitsSelectAll()';
        $lrs = $pdo->query($lsSQL);
        $tData = $lrs->fetchAll(PDO::FETCH_NUM);
        $lrs->closeCursor();
    } catch (Exception $e) {
        $lsMessage = $e->getMessage();
        $tData = array();
        array_push($tData, $lsMessage);
    }
    return $tData;
}

/**
 * 
 * @param PDO $pdo
 * @param type $id
 * @return array
 */
function selectOneProduit(PDO $pdo, $id) {
    $tData = array();
    try {
        $lsSQL = 'SELECT * FROM produits WHERE id_produit=?';
        $lsSQL = 'CALL produitsSelectOne(?)';
        $lrs = $pdo->prepare($lsSQL);
        $lrs->bindParam(1, $id);
        $lrs->execute();
        $tData = $lrs->fetchAll(PDO::FETCH_NUM);
        $lrs->closeCursor();
    } catch (Exception $e) {
        $lsMessage = $e->getMessage();
        $tData = array();
        array_push($tData, $lsMessage);
    }
    return $tData;
}

/**
 * 
 * @param PDO $pdo
 * @param type $ids
 * @return array
 */
function selectFewProduits(PDO $pdo, $ids) {
    $tData = array();
    try {
        $lsSQL = "SELECT * FROM produits WHERE id_produit IN(" . $ids . ") ORDER BY designation";
//        $lsSQL = '';
//echo "<br>$lsSQL<br>";
        $lrs = $pdo->query($lsSQL);
        $tData = $lrs->fetchAll(PDO::FETCH_NUM);
        $lrs->closeCursor();
    } catch (Exception $e) {
        $lsMessage = $e->getMessage();
        $tData = array();
        array_push($tData, $lsMessage);
    }
    return $tData;
}

?>
