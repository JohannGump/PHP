<?php

/*
  ProduitsDAOProcedural.php
 */
/*
  LE DAO de la table [villes] de la BD [cours]
 */

/**
 *
 * @param PDO $pdo
 * @return type
 */
function selectAllProduct(PDO $pdo) {
    /*
     * Renvoie un tableau ordinal de tableaux associatifs
     */
    $liste = array();
    try {
        $lrs = $pdo->query("SELECT * FROM cours.produits");
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
function selectOneProduct(PDO $pdo, $id) {
    /*
     * Renvoie un tableau associatif
     */
    try {
        $sql = 'SELECT * FROM cours.produits WHERE id_produit = ?';
        $lrs = $pdo->prepare($sql);
        $lrs->bindParam(1, $id);
        $lrs->execute();
        $enr = $lrs->fetch(PDO::FETCH_NUM);
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

function deleteProduct(PDO $pdo, $id) {
    $liAffectes = 0;
    try {
        $sql = "DELETE FROM cours.produits WHERE id_produit = ?";
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
function insertProduct(PDO $pdo, array $tAttributesValues) {
    $liAffectes = 0;
    try {
        $sql = "INSERT INTO cours.produits(id_produit,designation,prix,qte_stockee, photo) VALUES(?,?,?,?,?)";
        $lcmd = $pdo->prepare($sql);

        $lcmd->bindValue(1, $tAttributesValues["id_produit"]);
        $lcmd->bindValue(2, $tAttributesValues["designation"]);
        $lcmd->bindValue(3, $tAttributesValues["prix"]);
        $lcmd->bindValue(4, $tAttributesValues["qte_stockee"]);
        $lcmd->bindValue(5, $tAttributesValues["photo"]);

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
function updateProduct(PDO $pdo, array $tAttributesValues) {
    $liAffectes = 0;
    try {
        $sql = "UPDATE cours.produits SET designation=?, prix=?, qte_stockee=?, photo=? WHERE id_produit=?";
        $lcmd = $pdo->prepare($sql);

        $lcmd->bindValue(1, $tAttributesValues["designation"]);
        $lcmd->bindValue(2, $tAttributesValues["prix"]);
        $lcmd->bindValue(3, $tAttributesValues["qte_stockee"]);
        $lcmd->bindValue(4, $tAttributesValues["photo"]);
        $lcmd->bindValue(5, $tAttributesValues["id_produit"]);

        $lcmd->execute();
        $liAffectes = $lcmd->rowcount();
    } catch (PDOException $e) {
        $liAffectes = -1;
    }
    return $liAffectes;
}

?>
