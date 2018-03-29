<?php

session_start();

/*
 * MainCTRL_V1.php
 */

$lsMessage = "";
$lsInfosPanier = "";

$action = filter_input(INPUT_GET, "action");
if ($action == null) {
    $action = filter_input(INPUT_POST, "action");
}

require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';
require_once '../daos/ProduitsDAO.php';
require_once '../daos/ClientsDAO.php';
require_once '../daos/VillesDAO.php';

require_once '../lib/VARDUMP.php';

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
                // MELANGE SQL ET PHP
                $lsSQL = 'SELECT * FROM clients WHERE nom=? AND date_naissance=?';
                // APPEL A UNE Procédure stockée
                //$lsSQL = 'CALL clientsAuthentification(?,?)';
                // APPEL AU  DAO
                $enr = selectCLientByNomAndDateNaissance($nom, $date_naissance);

//                $lrs = $pdo->prepare($lsSQL);
//                $lrs->execute(array($nom, $date_naissance));
//                $enr = $lrs->fetch();
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

    case "deconnexion":
        $_SESSION["id_client"] = "";
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
//                $lsSQL = 'INSERT INTO clients(id_client,nom,prenom,date_naissance,adresse,cp) VALUES(?,?,?,?,?,?)';
                $lsSQL = 'CALL clientsInsertOne(?,?,?,?,?,?)';
                initialiser($pdo);
                $lcmd = $pdo->prepare($lsSQL);
                $lcmd->execute(array(100, $nom, $prenom, $date_naissance, $adresse, $cp));
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
//        $nom = filter_input(INPUT_POST, "nom");
//        $date_naissance = filter_input(INPUT_POST, "date_naissance");

        if ($id_client != null) {
            try {
//                $lsSQL = 'DELETE FROM clients WHERE id_client=?';
                $lsSQL = 'CALL clientsDeleteOne(?)';
                initialiser($pdo);
                $lcmd = $pdo->prepare($lsSQL);
                $lcmd->execute(array($id_client));
                valider($pdo);
                $_SESSION["id_client"] = "";

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
        if ($_SESSION["id_client"] == "" || !isSet($_SESSION["id_client"])) {
            $lsMessage = "Vous devez être authentifié(e) pour modifier votre compte !!!";
            include '../boundaries/ClientsAuthentificationIHM.php';
        } else {
            $tVilles = getVilles($pdo);
            $id_client = $_SESSION["id_client"];
            $nom = $_SESSION["nom"];
            $prenom = $_SESSION["prenom"];
            $date_naissance = $_SESSION["date_naissance"];
            $adresse = $_SESSION["adresse"];
            $cp = $_SESSION["cp"];

            include '../boundaries/ClientsUpdateIHM.php';
        }
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
                //$lsSQL = 'UPDATE clients SET nom=?,prenom=?,adresse=?,date_naissance=?,cp=? WHERE id_client=?';
                $lsSQL = 'CALL clientsUpdateOne(?,?,?,?,?,?)';
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

    case "ficheProduit":
        $id_produit = filter_input(INPUT_GET, "id_produit");
        //$lsMessage = "Voir détails du produit $id_produit";
        $tProduit = getOneProduit($pdo, $id_produit);
        include '../boundaries/ProduitsSelectOneIHM.php';
        break;

    case "ajouterAuPanier":
        $lsInfosPanier = "Ajout dans le panier";
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

        //vardump($panier);

        include '../boundaries/ProduitsSelectAllIHM.php';
        break;

    case "voirPanier":
        $panier = filter_input(INPUT_COOKIE, "panier");
        if ($panier != null) {
            $tProduits = getFewProduits($pdo, $panier);
            $lsInfosPanier = count($tProduits) . " article(s)";
            include '../boundaries/PanierIHM.php';
        } else {
            $lsInfosPanier = "Le panier est vide";
            $tProduits = getAllProduits($pdo);
            include '../boundaries/ProduitsSelectAllIHM.php';
        }
        //$panier = $_COOKIE["panier"];
        //$tProduits = getAllProduits($pdo);
        break;

    case "supprimerDansLePanier":
        $id_produit = filter_input(INPUT_GET, "id_produit");
        $panier = filter_input(INPUT_COOKIE, "panier");
        $tPanier = explode("#", $panier);
        if (count($tPanier) == 1) {
            $tPanier = array();
        } else {
            for ($i = 0; $i < count($tPanier); $i++) {
                if ($tPanier[$i] == $id_produit) {
                    $tPanier = array_slice($tPanier, $i - 1, 1);
                }
            }
        }
//        echo "<br>" . count($tPanier) . "<br>";
//        vardump($tPanier);

        if (count($tPanier) > 0) {
            $panier = implode("#", $tPanier);
            // 15 jours
            setCookie("panier", $panier, time() + (60 * 60 * 24 * 15));
            echo "<br>" . $panier . "<br>";
        } else {
            $panier = "";
            setcookie("panier", $panier, time());
        }

        if ($panier != "") {
            $tProduits = getFewProduits($pdo, $panier);
            $lsInfosPanier = count($tProduits) . " article(s)";
            include '../boundaries/PanierIHM.php';
        } else {
            $lsInfosPanier = "Le panier est vide";
            $tProduits = getAllProduits($pdo);
            include '../boundaries/ProduitsSelectAllIHM.php';
        }
        break;

    case "viderPanier":
        $lsInfosPanier = "Le panier a été vidé !!!";
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
    return selectAllProduits($pdo);
}

/**
 * 
 * @param PDO $pdo
 * @param type $panier
 * @return array
 */
function getFewProduits(PDO $pdo, $panier) {
    $panier = str_replace("#", ",", $panier);
    return selectFewProduits($pdo, $panier);
}

/**
 * 
 * @param PDO $pdo
 * @return array
 */
function getOneProduit(PDO $pdo, $id_produit) {
    return selectOneProduit($pdo, $id_produit);
}

/**
 * 
 * @param PDO $pdo
 * @return array
 */
function getVilles(PDO $pdo) {
    return selectAllVilles($pdo);
}

/**
 * 
 * @param PDO $pdo
 * @param type $id_client
 * @return string
 */
function getOneClient(PDO $pdo, $id_client) {
    //return selectOneClient($pdo, $id_client);
    return "";
}

/**
 * 
 * @param PDO $pdo
 * @param type $id_client
 * @return string
 */
function callDeleteOneClient(PDO $pdo, $id_client) {
    //return deleteClient($pdo, $id_client);
    return "";
}

/**
 * 
 * @param PDO $pdo
 * @param type $tClient
 * @return string
 */
function callUpdateOneClient(PDO $pdo, $tClient) {
    //return updateClient($pdo, $tClient);
    return "";
}

/**
 * 
 * @param PDO $pdo
 * @param type $tClient
 * @return string
 */
function callInsertOneClient(PDO $pdo, $tClient) {
    //return insertClient($pdo, $tClient);
    return "";
}

?>