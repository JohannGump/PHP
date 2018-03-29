<?php

/*
  VillesDAOProcedural.php
 */
/*
  LE DAO de la table [villes] de la BD [cours]
 */

/**
 *
 * @param PDO $pdo
 * @return type
 */
function selectAllVille(PDO $pdo) {
    /*
     * Renvoie un tableau ordinal de tableaux associatifs
     */
    $liste = array();
    try {
        $lrs = $pdo->query("SELECT * FROM cours.villes");
        $liste = $lrs->fetchAll(PDO::FETCH_NUM);
    } catch (PDOException $e) {
        $liste[] = $e->getMessage();
    }
    return $liste;
}

/**
 *
 * @param PDO $pdo
 * @param type $id
 * @return null
 */
function selectOneVille(PDO $pdo, $id) {
    /*
     * Renvoie un tableau associatif
     */
    try {
        $sql = 'SELECT * FROM cours.villes WHERE cp = ?';
        $lrs = $pdo->prepare($sql);
        $lrs->bindValue(1, $id);
        $lrs->execute();
        $enr = $lcmd->fetch(PDO::FETCH_ASSOC);
        $lrs->closeCursor();
    } catch (PDOException $e) {
        $enr = null;
    }
    return $enr;
}

/**
 *
 * @param PDO $pdo
 * @param type $id
 * @return type
 */
function deleteVille(PDO $pdo, $id) {
    $liAffectes = 0;
    try {
        $sql = "DELETE FROM cours.villes WHERE cp = ?";
        $lcmd = $pdo->prepare($sql);
        $lcmd->bindValue(1, $id);
        $lcmd->execute();
        $liAffectes = $lcmd->rowcount();
    } catch (PDOException $e) {
        $liAffectes = -1;
    }
    return $liAffectes;
}

/**
 *
 * @param PDO $pdo
 * @param array $tAttributesValues
 * @return type
 */
function insertVille(PDO $pdo, array $tAttributesValues) {
    $liAffectes = 0;
    try {
        $sql = "INSERT INTO cours.villes(cp,nom_ville,id_pays) VALUES(?,?,?)";
        $lcmd = $pdo->prepare($sql);

        $lcmd->bindValue(1, $tAttributesValues["cp"]);
        $lcmd->bindValue(2, $tAttributesValues["nom_ville"]);
        $lcmd->bindValue(3, $tAttributesValues["id_pays"]);

        $lcmd->execute();
        $liAffectes = $lcmd->rowcount();
    } catch (PDOException $e) {
        $liAffectes = -1;
    }
    return $liAffectes;
}

/**
 *
 * @param PDO $pdo
 * @param array tAttributesValues
 * @return type
 */
function updateVille(PDO $pdo, array $tAttributesValues) {
    $liAffectes = 0;
    try {
        $sql = "UPDATE cours.villes SET nom_ville=?,id_pays=? WHERE cp=?";
        $lcmd = $pdo->prepare($sql);

        $lcmd->bindValue(1, $tAttributesValues["nom_ville"]);
        $lcmd->bindValue(2, $tAttributesValues["id_pays"]);
        $lcmd->bindValue(3, $tAttributesValues["cp"]);

        $lcmd->execute();
        $liAffectes = $lcmd->rowcount();
    } catch (PDOException $e) {
        $liAffectes = -1;
    }
    return $liAffectes;
}

?>


