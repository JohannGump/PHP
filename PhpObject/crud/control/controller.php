<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 14/03/2018
 * Time: 10:42
 */


// récupération des infos du formulaire
// différencier si c'est un ajout ou une modification
// récupération d'un utilisateur
// supprimer un utilisateur
//
$action = filter_input(INPUT_GET, "action");
if ($action == null) {
    $action = filter_input(INPUT_POST, "action");
}

/** inclusion de connexion et transaxion * */
require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';
require '../Utilisateur.php';
require '../Admin.php';

$pdo = seConnecter("../conf/cours.ini");

// Avoir tous les utilisateurs
$utilisateurs = utilisateur::getData($pdo);
//var_dump($utilisateurs);

switch ($action) {

    /** appel de cette fonction dans le nav **/
    case "Enregistrer":

        $name = filter_input(INPUT_POST, "user_name");
        $email = filter_input(INPUT_POST, "user_email");
        $telephone = filter_input(INPUT_POST, "user_phone");
        $activated = filter_input(INPUT_POST, "user_enabled");
        date_default_timezone_set('Europe/Paris');
        $originDate = date('Y-m-d', time());
        $creationDate = $originDate;
        $modificationDate = $originDate;
        $accountType = filter_input(INPUT_POST, "user_type");
        $pseudo = filter_input(INPUT_POST, "user_pseudo");


        // Ajout d'un utilisateur
        $utilisateur = new Utilisateur($name, $email, $telephone, $activated, $accountType, $pseudo);
        $utilisateur->addUser($pdo);
        //var_dump($utilisateur);
        break;

    case "Charger":
        $idToLoad = filter_input(INPUT_GET, "user_to_load");
        //var_dump($idToLoad);
        $utilisateur = new Utilisateur();
        $utilisateur->getUser($pdo, $idToLoad);
        include '../boundarie/form_user.php';
        break;
}