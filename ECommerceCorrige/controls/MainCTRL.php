<?php

session_start();

/*
 * MainCTRL.php
 */
$action = filter_input(INPUT_GET, "action");
if ($action == null) {
    $action = filter_input(INPUT_POST, "action");
}

/** inclusion de connexion et transaxion * */
require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';


/** on récupére les paramètres de connexion dans le fichier cours.ini * */
$pdo = seConnecter("../conf/cours.ini");

switch ($action) {

    /** appel de cette fonction dans le nav * */
    case "authentification":
        include '../boundaries/ClientsAuthentificationIHM.php';
        break;

    case "authentificationValidation":
        /** filter input teste l'existence de la variable et ce qu'il y a dedans 
         * on récupére le name mis en argument
         * * */
        $nom = filter_input(INPUT_POST, "nom");
        $date_naissance = filter_input(INPUT_POST, "date_naissance");

        /** on teste si le champs n'est pas vide et si le client vient de cette page
         * depuis l'authentification
         * */
        if ($nom != null || $date_naissance != null) {
            try {
                $lsSQL = 'SELECT * FROM utilisateursss';

                /** compilation du PHP au SQL * */
                $lrs = $pdo->prepare($lsSQL);

                /** execution de la commande qui vient d'être compilée avec
                 * en passage d'argument le tableau de valeurs 
                 */
                $lrs->execute(array($nom, $date_naissance));

                /** curseur = grille, fetch prend une ligne dans le tableau et 
                 * la met en mémoire
                 */
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
                $lsSQL = 'INSERT INTO clients(id_client, nom,prenom,adresse,date_naissance,cp) VALUES(?,?,?,?,?)';
                initialiser($pdo);
                $lcmd = $pdo->prepare($lsSQL);
                $lcmd->execute(array(100, $nom, $prenom, $adresse, $date_naissance, $cp));
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
            $lsMessage = "Vous devez être authentifié(e) pour vous désinscrire";
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
                $lsSQL = 'DELETE FROM clients WHERE id_client=?';
                initialiser($pdo);
                $lcmd = $pdo->prepare($lsSQL);
                $lcmd->execute(array($id_client));
                valider($pdo);
                $tProduits = getProduits($pdo);
                $lsMessage = "Vous êtes désinscrit ! A bientôt !";
                include '../boundaries/ProduitsSelectAllIHM.php';
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

        if ($_SESSION["id_client"] == "") {
            $lsMessage = "Vous devez être authentifié(e) pour modifier vos données";
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
                $lsSQL = 'UPDATE clients SET nom=?,prenom=?,adresse=?,date_naissance=?,cp=? WHERE id_client=?';
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
        $tProduits = getProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;


    case "ajouterAuPanier":
        $lsMessage = "Ajout dans le panier";

        $panier = filter_input(INPUT_COOKIE, "panier");
        $id_produit = $_GET["id_produit"];

        if ($panier == null) {
            $panier = $id_produit;
        } else {
            $panier .= "#" . $id_produit ;
        }
        $lsMessage .= "<br>$id_produit<br>$panier";

        /** si le cookie n'esty pas initialisé, le précédente valeur est nulle **/
        setcookie("panier", $panier, time() + (60 * 60 * 24 * 7));
        
        $tProduits = getProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;

    case "ficheProduit":
        $id_produit = filter_input(INPUT_GET, "id_produit");
        //$lsMessage = "Voir détails du produit $id_produit";
        $tProduit = getProduit($pdo, $id_produit);
        include '../boundaries/ProduitsSelectOneIHM.php';
        break;

    default:
        $tProduits = getProduits($pdo);
        include '../boundaries/ProduitsSelectAllIHM.php';
        break;
}

/**
 * 
 * @param PDO $pdo
 * @return array
 */
function getProduits(PDO $pdo) {
    try {
        $lsSQL = 'SELECT * FROM produits ORDER BY designation';
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
function getProduit(PDO $pdo, $id_produit) {
    try {
        $lsSQL = 'SELECT * FROM produits WHERE id_produit=?';
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
        $lsSQL = 'SELECT * FROM villes ORDER BY nom_ville';
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
