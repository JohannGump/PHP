<?php

/*
 * ProduitsDAOTests.php
 */
require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';
require_once 'ProduitsDAO.php';
require_once '../lib/VARDUMP.php';

$pdo = seConnecter("../conf/cours.ini");

//$tProduits = selectAllProduits($pdo);
//vardump($tProduits);

//$tProduit = selectOneProduit($pdo, 1);
//vardump($tProduit);

$tProduits = selectFewProduits($pdo, '1,5');
vardump($tProduits);

?>
