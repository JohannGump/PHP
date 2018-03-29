<?php

session_start();

/*
 * MainCTRL.php
 */

$lsMessage = "";

$action = filter_input(INPUT_GET, "action");
if ($action == null) {
    $action = filter_input(INPUT_POST, "action");
}

require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';

$pdo = seConnecter("../conf/cours.ini");

switch ($action) {

    case "authentification":
        include '../boundaries/ClientsAuthentificationIHM.php';
        break;

    case "authentificationValidation":
        $nom = filter_input(INPUT_POST, "nom");
        $date_naissance = filter_input(INPUT_POST, "date_naissance");

        if ($nom != null && $date_naissance != null) {
            try {
                $lsSQL = 'CALL selectClient(?,?)';
                //$lsSQL = 'SELECT * FROM clients WHERE nom=? AND date_naissance=?';

                $lrs = $pdo->prepare($lsSQL);
                $lrs->execute(array($nom, $date_naissance));
                $enr = $lrs->fetch();
                if ($enr != false) {
                    $_SESSION["id_client"] = $enr["id_client"];
                    $_SESSION["nom"] = $enr["nom"];
                    $_SESSION["prenom"] = $enr["prenom"];
                    $_SESSION["date_naissance"] = $enr["date_naissance"];
                    $_SESSION["adresse"] = $enr["adresse"];
                    $_SESSION["cp"] = $enr["cp"];
                    $lsMessage = "Authentification réussie";
                } else {
                    $_SESSION["id_client"] = "";
                    $lsMessage = "Authentification ratée";
                }
            } catch (Exception $e) {
                $lsMessage = $e->getMessage();
            }
        } else {
            $lsMessage = "Toutes les saisies sont obligatoires";
        }

        include '../boundaries/ClientsAuthentificationIHM.php';
        break;

    case "inscription":
        $tVilles = getVilles($pdo);

        include '../boundaries/ClientsInsertIHM.php';
        break;

    case "inscriptionValidation":
        //$id_client = filter_input(INPUT_POST, "id_client");
        $nom = filter_input(INPUT_POST, "nom");
        $prenom = filter_input(INPUT_POST, "prenom");
        $adresse = filter_input(INPUT_POST, "adresse");
        $date_naissance = filter_input(INPUT_POST, "date_naissance");
        $cp = filter_input(INPUT_POST, "cp");

        if ($nom != null && $cp != null) {
            try {
                $lsSQL = 'CALL insertClient(?,?,?,?,?,?)';
                //$lsSQL = 'INSERT INTO clients(id_client,nom,prenom,adresse,date_naissance,cp) VALUES(?,?,?,?,?,?)';
                initialiser($pdo);
                $lcmd = $pdo->prepare($lsSQL);
                $lcmd->execute(array(87, $nom, $prenom, $adresse, $date_naissance, $cp));
                valider($pdo);
                $lsMessage = "Félicitations ! Vous êtes inscrit sur le bon site !!!";
                $lsMessage .= "<br>Vous devez vous connecter avec votre nom et votre date de naissance pour valider votre inscription";
            } catch (Exception $e) {
                annuler($pdo);
                $lsMessage = $e->getMessage();
            }
        } else {
            $lsMessage = "Toutes les saisies sont obligatoires";
        }

        $tVilles = getVilles($pdo);

        include '../boundaries/ClientsInsertIHM.php';
        break;

    case "desinscription":
        if ($_SESSION["id_client"] == "") {
            $lsMessage = "Vous devez être authentifié(e) pour vous désinscrire !!!";
            include '../boundaries/ClientsAuthentificationIHM.php';
        } else {
            $id_client = $_SESSION["id_client"];
            include '../boundaries/ClientsDeleteIHM.php';
        }
        break;

    case "desinscriptionValidation":
        $id_client = $_SESSION["id_client"];
        $nom = filter_input(INPUT_POST, "nom");
        $date_naissance = filter_input(INPUT_POST, "date_naissance");

        if ($id_client != null) {
            try {
                $lsSQL = 'CALL deleteClient(?)';
                //$lsSQL = 'DELETE FROM clients WHERE id_client=?';
                initialiser($pdo);
                $lcmd = $pdo->prepare($lsSQL);
                $lcmd->execute(array($id_client));
                valider($pdo);
                $tVilles = getVilles($pdo);
                $lsMessage = "Vous êtes désinscrit ! A bientôt !";
                include '../boundaries/ClientsInsertIHM.php';
            } catch (Exception $e) {
                annuler($pdo);
                $lsMessage = $e->getMessage();
                include '../boundaries/ClientsDeleteIHM.php';
            }
        } else {
            $lsMessage = "Toutes les saisies sont obligatoires";
            include '../boundaries/ClientsDeleteIHM.php';
        }

        break;

    case "changementClient":
        $tVilles = getVilles($pdo);
        $id_client = $_SESSION["id_client"];
        $nom = $_SESSION["nom"];
        $prenom = $_SESSION["prenom"];
        $date_naissance = $_SESSION["date_naissance"];
        $adresse = $_SESSION["adresse"];
        $cp = $_SESSION["cp"];

        include '../boundaries/ClientsUpdateIHM.php';
        break;

    case "changementClientValidation":
        $id_client = filter_input(INPUT_POST, "id_client");
        $nom = filter_input(INPUT_POST, "nom");
        $prenom = filter_input(INPUT_POST, "prenom");
        $adresse = filter_input(INPUT_POST, "adresse");
        $date_naissance = filter_input(INPUT_POST, "date_naissance");
        $cp = filter_input(INPUT_POST, "cp");

        if ($id_client != null) {
            try {
                $lsSQL = 'CALL updateClient (?,?,?,?,?,?)';
                //$lsSQL = 'UPDATE clients SET nom=?,prenom=?,adresse=?,date_naissance=?,cp=? WHERE id_client=?';
                initialiser($pdo);
                $lcmd = $pdo->prepare($lsSQL);
                $lcmd->execute(array($nom, $prenom, $adresse, $date_naissance, $cp, $id_client));
                valider($pdo);
                $lsMessage = $lcmd->rowcount() . " enregistrement modifié";
                $_SESSION["nom"] = $nom;
                $_SESSION["prenom"] = $prenom;
                $_SESSION["date_naissance"] = $date_naissance;
                $_SESSION["adresse"] = $adresse;
                $_SESSION["cp"] = $cp;
            } catch (Exception $e) {
                annuler($pdo);
                $lsMessage = $e->getMessage();
            }
        } else {
            $lsMessage = "Toutes les saisies sont obligatoires";
        }

        $tVilles = getVilles($pdo);

        include '../boundaries/ClientsUpdateIHM.php';
        break;

    case "catalogue":
        $tProduits = getAllProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;

    case "ajouterAuPanier":
        $lsMessage = "Ajout dans le panier";
        //$tProduits = getAllProduits($pdo);
        $id_produit = filter_input(INPUT_GET, "id_produit");
        $panier = filter_input(INPUT_COOKIE, "panier");
        if ($panier == null) {
            $panier = $id_produit;
        } else {
            $panier .= "#" . $id_produit;
        }
        // 15 jours
        setCookie("panier", $panier, time() + (60 * 60 * 24 * 15));

        $tProduits = getAllProduits($pdo);

        include '../boundaries/ProduitsSelectAllIHM.php';
        break;

    case "ficheProduit":
        $id_produit = filter_input(INPUT_GET, "id_produit");
        //$lsMessage = "Voir détails du produit $id_produit";
        $tProduit = getOneProduit($pdo, $id_produit);
        include '../boundaries/ProduitsSelectOneIHM.php';
        break;

    case "voirPanier":
        //$panier = $_COOKIE['panier'];
        //echo($panier);
        $panier = filter_input(INPUT_COOKIE, "panier");
        if ($panier != null) {
            $lsMessage = $panier;
            $tProduits = getFewProduits($pdo, $panier);
            include '../boundaries/PanierIHM.php';
        } else {
            $lsInfosPanier = "Le panier est vide";
            $tProduits = getAllProduits($pdo);
            include '../boundaries/ProduitsSelectAllIHM.php';
        }
        //$panier = $_COOKIE["panier"];
        //$tProduits = getAllProduits($pdo);
        break;

    case "viderPanier":
        $lsInfosPanier = "La panier a été vidé !!!";
        setCookie("panier", "", time());
        $tProduits = getAllProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;

    default:
        $tProduits = getAllProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;
}

/**
 * 
 * @param PDO $pdo
 * @return array
 */
function getAllProduits(PDO $pdo) {
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
 * @param type $panier
 * @return array
 */
function getFewProduits(PDO $pdo, $panier) {
    $panier = str_replace("#", ",", $panier);
    try {
        $lsSQL = "SELECT * FROM produits WHERE id_produit IN(" . $panier . ") ORDER BY designation";
        //$lsSQL = 
        echo "<br>$lsSQL<br>";
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
 * @return array
 */
function getOneProduit(PDO $pdo, $id_produit) {
    try {
        //$lsSQL = 'SELECT * FROM produits WHERE id_produit=?';
        $lsSQL = 'CALL selectProduct(?)';
        $lrs = $pdo->prepare($lsSQL);
        $lrs->bindParam(1, $id_produit);
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
 * @return array
 */
function getVilles(PDO $pdo) {
    try {
       // $lsSQL = 'SELECT * FROM villes ORDER BY nom_ville';
        $lsSQL = 'CALL selectVilles()';
        $lrs = $pdo->query($lsSQL);
        $tData = $lrs->fetchAll(PDO::FETCH_NUM);
        $lrs->closeCursor();
        //$lsMessage = "OK";
    } catch (Exception $e) {
        $lsMessage = $e->getMessage();
        $tData = array();
        array_push($tData, $lsMessage);
    }
    return $tData;
}

?>

<?php

/* VillesDAOProceduralTests.php */

require_once 'VillesDAOProcedural.php';

try {
    $lcnx = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcnx->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
    $lcnx->exec("SET NAMES 'UTF8'");

    echo "<hr>selectAll<hr>";
    $lsContenu = "";
    $tLines = selectAll($lcnx);
    foreach ($tLines as $line) {
        foreach ($line as $field => $value) {
            $lsContenu .= $value . ";";
        }
        $lsContenu .= "\n";
    }
    echo nl2br($lsContenu);

    echo "<hr>selectOne<hr>";
    $lsContenu = "";
    $tLine = selectOne($lcnx, "75011");
    foreach ($tLine as $field => $value) {
        $lsContenu .= $value . ";";
    }
    $lsContenu .= "\n";
    echo nl2br($lsContenu);

    echo "<hr>insert<hr>";
    $lcnx->beginTransaction();
    $tAttributesValues = array();
    $tAttributesValues['cp'] = "99999";
    $tAttributesValues['nom_ville'] = "Villeneuve";
    $tAttributesValues['id_pays'] = "033";
    $liAffecte = insert($lcn, $tAttributesValues);
    echo "Insertions : $liAffecte";
    $lcnx->commit();

    echo "<hr>delete<hr>";
    $lcnx->beginTransaction();
    $liAffecte = delete($lcn, "99999");
    echo "Suppressions : $liAffecte";
    $lcnx->commit();

    $lcnx = null;
} catch (PDOException $e) {
    $lsMessage = $e->getMessage();
}
?>