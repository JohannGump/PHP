<?php

/*
 * VillesDAOTests.php
 */

require_once '../lib/Connexion.php';
//require_once '../lib/Transaxion.php';
require_once 'VillesDAO.php';
require_once '../lib/VARDUMP.php';

$pdo = seConnecter("../conf/cours.ini");

$tVilles = selectAllVilles($pdo);
vardump($tVilles);
?>
