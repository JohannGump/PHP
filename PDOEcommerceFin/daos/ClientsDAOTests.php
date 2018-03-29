<?php

/*
 * ClientsDAOTests.php
 */

require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';
require_once 'ClientsDAO.php';
require_once '../lib/VARDUMP.php';

$pdo = seConnecter("../conf/cours.ini");

//$enr = selectClientByID($pdo, 1);
//vardump($enr);
/*
 * AUTHENTIFICATION
 */
$enr = selectClientByNomAndDateNaissance($pdo, 'Bugue', '1955-10-03');
vardump($enr);

/*
 *  DELETE
 */
initialiser($pdo);
$id = 100;
$liAffecte = deleteClient($pdo, $id);
vardump($liAffecte);
valider($pdo);

/*
 *  INSERT
 */
$t = array();
$t["id_client"] = "100";
$t["nom"] = "Margam";
$t["prenom"] = "Morganeee";
$t["date_naissance"] = "2000-01-03";
$t["adresse"] = "rue des sorcicières";
$t["cp"] = "75011";
initialiser($pdo);
$liAffecte = insertClient($pdo, $t);
valider($pdo);
vardump($liAffecte);


/*
 * MODIFICATION
 */
$t = array();

$t["nom"] = "Freeman";
$t["prenom"] = "Morgan";
$t["date_naissance"] = "2000-01-03";
$t["adresse"] = "rue des sorcières";
$t["cp"] = "75012";
$t["id_client"] = "100";
initialiser($pdo);
$liAffecte = updateClient($pdo, $t);
valider($pdo);
vardump($liAffecte);
?>
