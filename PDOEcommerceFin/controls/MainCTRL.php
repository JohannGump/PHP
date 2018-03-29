<?php

session_start();

/*
 * MainCTRL.php
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
            // Fonction du DAO
            $enr = selectClientByNomAndDateNaissance($pdo, $nom, $date_naissance);
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
        // fonction du DAO
        $tVilles = selectAllVilles($pdo);

        include '../boundaries/ClientsInsertIHM.php';
        break;

    case "inscriptionValidation":
        //$id_client = filter_input(INPUT_POST, "id_client");
        $nom = filter_input(INPUT_POST, "nom");
        $prenom = filter_input(INPUT_POST, "prenom");
        $date_naissance = filter_input(INPUT_POST, "date_naissance");
        $adresse = filter_input(INPUT_POST, "adresse");
        $cp = filter_input(INPUT_POST, "cp");

        if ($nom != null && $cp != null) {
            initialiser($pdo);
            $tClient = array();
            $tClient["id_client"] = "100";
            $tClient["nom"] = $nom;
            $tClient["prenom"] = $prenom;
            $tClient["date_naissance"] = $date_naissance;
            $tClient["adresse"] = $adresse;
            $tClient["cp"] = $cp;
            // fonction du DAO
            if (insertClient($pdo, $tClient) == 1) {
                valider($pdo);
                $lsMessage = "Félicitations ! Vous êtes inscrit sur le bon site !!!";
                $lsMessage .= "<br>Vous devez vous connecter avec votre nom et votre date de naissance pour valider votre inscription";
            } else {
                annuler($pdo);
                $lsMessage = "Inscription ratée !!!";
            }
        } else {
            $lsMessage = "Toutes les saisies sont obligatoires";
        }

        // fonction du DAO
        $tVilles = selectAllVilles($pdo);

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

        if ($id_client != null) {
            initialiser($pdo);
            if (deleteClient($pdo, $id_client) == 1) {
                valider($pdo);
                $_SESSION["id_client"] = "";
                // fonction du DAO
                $tVilles = selectAllVilles($pdo);
                $lsMessage = "Vous êtes désinscrit ! A bientôt !";
                include '../boundaries/ClientsInsertIHM.php';
            } else {
                $lsMessage = "Vous êtes désinscrit ! A bientôt !";
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
            // fonction du DAO
            $tVilles = selectAllVilles($pdo);
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
            initialiser($pdo);
            $tClient = array();
            $tClient["nom"] = $nom;
            $tClient["prenom"] = $prenom;
            $tClient["date_naissance"] = $date_naissance;
            $tClient["adresse"] = $adresse;
            $tClient["cp"] = $cp;
            $tClient["id_client"] = $_SESSION["id_client"];
            $liAffecte = updateClient($pdo, $tClient);
            if ($liAffecte == 1) {
                valider($pdo);
                $lsMessage = "1 enregistrement modifié";
                $_SESSION["nom"] = $nom;
                $_SESSION["prenom"] = $prenom;
                $_SESSION["date_naissance"] = $date_naissance;
                $_SESSION["adresse"] = $adresse;
                $_SESSION["cp"] = $cp;
            } else {
                if ($liAffecte == 0) {
                    $lsMessage = "$liAffecte enregistrement modifié !!!";
                } else {
                    $lsMessage = "Modification ratée !!!";
                }
            }
        } else {
            $lsMessage = "Toutes les saisies sont obligatoires";
        }

        // fonction du DAO
        $tVilles = selectAllVilles($pdo);

        include '../boundaries/ClientsUpdateIHM.php';
        break;

    case "catalogue":
        // fonction du DAO
        $tProduits = selectAllProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;

    case "ficheProduit":
        $id_produit = filter_input(INPUT_GET, "id_produit");
        // fonction du DAO
        $tProduit = selectOneProduit($pdo, $id_produit);
        include '../boundaries/ProduitsSelectOneIHM.php';
        break;

    case "ajouterAuPanier":
        $lsInfosPanier = "Ajout dans le panier";
        $id_produit = filter_input(INPUT_GET, "id_produit");
        $panier = filter_input(INPUT_COOKIE, "panier");
        if ($panier == null) {
            $panier = $id_produit;
        } else {
            $panier .= "#" . $id_produit;
        }
        // 15 jours
        setCookie("panier", $panier, time() + (60 * 60 * 24 * 15));

        // fonction du DAO
        $tProduits = selectAllProduits($pdo);

        //vardump($panier);

        include '../boundaries/ProduitsSelectAllIHM.php';
        break;

    case "voirPanier":
        // si le cookie existe
        $panier = filter_input(INPUT_COOKIE, "panier");
        if ($panier != null) {
            // fonction du DAO
            $panier = str_replace("#", ",", $panier);
            $tProduits = selectFewProduits($pdo, $panier);
            //vardump($tProduits);
            $lsInfosPanier = count($tProduits) . " article(s)";
            include '../boundaries/PanierIHM.php';
        } else {
            $lsInfosPanier = "Le panier est vide";
            // fonction du DAO
            $tProduits = selectAllProduits($pdo);
            include '../boundaries/ProduitsSelectAllIHM.php';
        }
        break;

    case "supprimerDansLePanier":
        // Récupération de l'id du produit
        $id_produit = filter_input(INPUT_GET, "id_produit");
        // Récupération du panier
        $panier = filter_input(INPUT_COOKIE, "panier");
        // On explode le panier en tableau
        $tPanier = explode("#", $panier);
        //vardump($tPanier);
        // Si le panier contient un seul produit on le supprime
        if (count($tPanier) == 1) {
            $tPanier = array();
            $panier = "";
            setcookie("panier", $panier, time());
            $lsInfosPanier = "Le panier est vide";
            // fonction du DAO
            $tProduits = selectAllProduits($pdo);
            include '../boundaries/ProduitsSelectAllIHM.php';
        } else {
            // On balaie le panier
            for ($i = 0; $i < count($tPanier); $i++) {
                // 
                echo "<br>" . $id_produit . ":" . $tPanier[$i] . "<br>";
                if ($tPanier[$i] == $id_produit) {
                    //echo "<br>REDIM panier";
                    array_splice($tPanier, $i, 1);
                }
            }

            $panier = implode("#", $tPanier);
            // 15 jours
            setCookie("panier", $panier, time() + (60 * 60 * 24 * 15));
            // fonction du DAO
            $panier = str_replace("#", ",", $panier);
            $tProduits = selectFewProduits($pdo, $panier);
            vardump($tProduits);
            $lsInfosPanier = count($tProduits) . " article(s)";
            include '../boundaries/PanierIHM.php';
        }

//        if (count($tPanier) > 0) {
//            $panier = implode("#", $tPanier);
//            // 15 jours
//            setCookie("panier", $panier, time() + (60 * 60 * 24 * 15));
////            echo "<br>" . $panier . "<br>";
//        } 
//
//        if ($panier != "") {
//            
//        } 

        break;

    case "viderPanier":
        $lsInfosPanier = "Le panier a été vidé !!!";
        setCookie("panier", "", time());
        // fonction du DAO
        $tProduits = selectAllProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;

    default:
        // fonction du DAO
        $tProduits = selectAllProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;
}
?>