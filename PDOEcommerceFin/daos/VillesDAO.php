<?php

/*
 * VillesDAO.php
 */

/**
 * 
 * @param type $pdo
 * @return array
 */
function selectAllVilles(PDO $pdo) {
    $tData = array();
    try {
        $lsSQL = 'SELECT * FROM villes ORDER BY nom_ville';
        $lsSQL = 'CALL villesSelectAll()';
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



