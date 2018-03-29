<?php

/**
 * Transaxion.php : une bibliotheque
 * initialiser()
 * valider()
 * annuler()
 */

/**
 *
 * @param PDO $pcnx
 */
function initialiser(PDO &$pcnx) {
    $lbOK = true;
    try {
        $pcnx->beginTransaction();
    } catch (PDOException $ex) {
        $lbOK = false;
    }
    return $lbOK;
}

/**
 *
 * @param PDO $pcnx
 */
function valider(PDO &$pcnx) {
    $lbOK = true;
    try {
        $pcnx->commit();
    } catch (PDOException $ex) {
        $lbOK = false;
    }
    return $lbOK;
}

/**
 *
 * @param PDO $pcnx
 */
function annuler(PDO &$pcnx) {
    $lbOK = true;
    try {
        $pcnx->rollBack();
    } catch (PDOException $ex) {
        $lbOK = false;
    }
    return $lbOK;
}

?>
