<?php

/**
 * Description of ProfilUtisateurDAO.php
 *
 * @author
 */

/**
 *
 * @param PDO $pcnx
 * @return type : une String
 */
function selectAll(PDO $pcnx) {
//        echo "<br>selectAll";
    $lsProfils = "";

    try {
        $lsSelect = "SELECT * FROM profil_utilisateur";
        $lrs = $pcnx->prepare($lsSelect);
        $lrs->execute();

        $lrs->setFetchMode(PDO::FETCH_NUM);
        // La boucle sur les enregsitrements
        while ($enr = $lrs->fetch()) {
            // On concatene dans la CSV
            $lsProfils .= $enr[0] . ";";
            $lsProfils .= $enr[1] . ";";
            $lsProfils .= $enr[2];
            $lsProfils .= "\n";
        }
        // On supprime le dernir \n
        $lsProfils = substr($lsProfils, 0, -1);

        $lrs->closeCursor();
    } catch (PDOException $e) {
//        echo "<br>" . $e->getMessage() . "<br>";
        $lsProfils = $e->getMessage();
    }

    // On renvoie une String CSV
    return $lsProfils;
}

/**
 *
 * @param type $pcnx
 * @param type $pseudo
 * @param type $mdp
 * @return \Utilisateur
 */
function selectOneByID(PDO $pcnx, $id) {
    $lsProfil = "";

    try {
        $lsSelectOne = "SELECT * FROM profil_utilisateur WHERE id_profil_utilisateur = ?";
//            echo "<br>$lsSelectOne<br>";
        $lrs = $pcnx->prepare($lsSelectOne);
        $lrs->execute(array($id));
        $lrs->setFetchMode(PDO::FETCH_NUM);
        $enr = $lrs->fetch();

        if ($enr[1] === null) {
            /*
             * DU JSON
             */
            $tProfil = array();
            $tProfil["idProfilUtilisateur"] = "0";
            $tProfil["codeProfilUtilisateur"] = "0";
            $tProfil["libelleProfilUtilisateur"] = "Introuvable";

            $lsProfil = json_encode($tProfil);
        } else {
            /*
             * DU CSV
             */
//            $lsProfil .= $enr[0] . ";";
//            $lsProfil .= $enr[1] . ";";
//            $lsProfil .= $enr[2] . ";";
            /*
             * DU JSON
             */
//    header("Content-Type: application/json; charset=UTF-8");
            // Un tableau associatif
            $tProfil = array();
            $tProfil["idProfilUtilisateur"] = $enr[0];
            $tProfil["codeProfilUtilisateur"] = $enr[1];
            $tProfil["libelleProfilUtilisateur"] = $enr[2];

            // Transforme les donnees PHP (un tableau associatif)
            // en donnees JSON (un objet JSON)
            $lsProfil = json_encode($tProfil);
        }

        $lrs->closeCursor();
    } catch (PDOException $e) {
//        echo "<br>" . $e->getMessage() . "<br>";
        $tProfil = array();
        $tProfil["idProfilUtilisateur"] = "0";
        $tProfil["codeProfilUtilisateur"] = "0";
        $tProfil["libelleProfilUtilisateur"] = $e->getMessage();

        $lsProfil = json_encode($tProfil);
    }
    return $lsProfil;
}

/**
 *
 * @param PDO $pcnx
 * @param type $tProfil
 * @return type
 */
function insert(PDO $pcnx, $tProfil) {
    $liAffecte = 0;

    try {
        if (!$pcnx->inTransaction()) {
            $pcnx->beginTransaction();
        }
        $lsSQL = "INSERT INTO profil_utilisateur(code_profil_utilisateur, libelle_profil_utilisateur) VALUES(?,?)";
        $lcmd = $pcnx->prepare($lsSQL);

        $lbOK = $lcmd->execute(array($tProfil["codeProfil"], $tProfil["libelleProfil"]));

        $liAffecte = $lcmd->rowCount();

        $pcnx->commit();
    } catch (PDOException $e) {
//        echo "<br>PDOException : " . $e->getMessage() . "<br>";
        $liAffecte = -1;
    }
    return $liAffecte;
}

/**
 *
 * @param type $pcnx
 * @param type $tObjet
 * @return boolean
 */
function update(PDO $pcnx, $tProfil) {
    $liAffecte = 0;

    try {
        if (!$pcnx->inTransaction()) {
            $pcnx->beginTransaction();
        }
        $lsSQL = "UPDATE profil_utilisateur SET code_profil_utilisateur=?, libelle_profil_utilisateur=? WHERE id_profil_utilisateur=?";
        $lcmd = $pcnx->prepare($lsSQL);

        $t = array();
        array_push($t, $tProfil["codeProfil"]);
        array_push($t, $tProfil["libelleProfil"]);
        array_push($t, $tProfil["idProfil"]);

        $lbOK = $lcmd->execute($t);
        $liAffecte = $lcmd->rowCount();

        $pcnx->commit();
    } catch (PDOException $e) {
        //echo "<br>" . $e->getMessage() . "<br>";
        $liAffecte = -1;
    }
    return $liAffecte;
}

/**
 *
 * @param PDO $pcnx
 * @param type $tProfil
 * @return type
 */
function delete(PDO $pcnx, $tProfil) {
    $liAffecte = 0;

    try {
        if (!$pcnx->inTransaction()) {
            $pcnx->beginTransaction();
        }
        $lsSQL = "DELETE FROM profil_utilisateur WHERE id_profil_utilisateur = ?";
        $lcmd = $pcnx->prepare($lsSQL);
        $lbOK = $lcmd->execute(array($tProfil["idProfil"]));
        $liAffecte = $lcmd->rowCount();

        $pcnx->commit();
    } catch (PDOException $e) {
//            echo "<br>" . $e->getMessage() . "<br>";
        $liAffecte = -1;
    }
    return $liAffecte;
}

/*
 * Connexion a la BD
 */

try {
    $lcnx = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcnx->exec("SET NAMES 'UTF8'");
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}


/*
 * Recuperation des attributs de requete
 * qu'ils soient POST ou GET
 */

$lsId = filter_input(INPUT_POST, "idProfilUtilisateur");
if ($lsId == null) {
    $lsId = filter_input(INPUT_GET, "idProfilUtilisateur");
}
$lsCode = filter_input(INPUT_POST, "codeProfilUtilisateur");
if ($lsCode == null) {
    $lsCode = filter_input(INPUT_GET, "codeProfilUtilisateur");
}
$lsLibelle = filter_input(INPUT_POST, "libelleProfilUtilisateur");
if ($lsLibelle == null) {
    $lsLibelle = filter_input(INPUT_GET, "libelleProfilUtilisateur");
}


$tProfil = array();
$tProfil["idProfil"] = $lsId;
$tProfil["codeProfil"] = $lsCode;
$tProfil["libelleProfil"] = $lsLibelle;


$lsAction = filter_input(INPUT_POST, "action");
if ($lsAction == null) {
    $lsAction = filter_input(INPUT_GET, "action");
}


$lsMessage = 0;
switch ($lsAction) {
    case "insert":
        $lsMessage = insert($lcnx, $tProfil);
        break;
    case "delete":
        $lsMessage = delete($lcnx, $tProfil);
        break;
    case "update":
        $lsMessage = update($lcnx, $tProfil);
        break;
    case "selectOne":
        $lsMessage = selectOneByID($lcnx, $lsId);
        break;
    case "selectAll":
        $lsMessage = selectAll($lcnx);
        break;
}

echo $lsMessage;
?>
