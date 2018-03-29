<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 12/03/2018
 * Time: 15:19
 */
/*
Exercice :

Créer un mini jeu de caresse en :
- Modélisant des personnages qui ont une force de caresse de 0 à 100. Initialisation aléatoire entre 0 et 100

- qui ont une douceur de 0 à 500; Initialisation à 0
- qui ont un nom

- une méthode caresser qui va donc augmenter la douceur d'un autre personnage de la valeur se situant entre la moitié et
la totalité de sa force de caresse. Ex: force de 80: caresse entre 40 et 80

- une méthode caresserSurement qui caresse toujours 7.5/10 de la force de caresse

- le jeu se termine quand une personne est trop douce : douceur à 500
*/

require 'Personnage.php';

$personnage1 = new Personnage ("Emmanuelle", 250);
$personnage2 = new Personnage ("George", 145);

$personnage2->caresser($personnage1);
echo "le personnage 2 caresse à : ".$personnage1->getForceCaresse()."<br>";
echo "La douceur du personnage 1 est de : ".($personnage1->getDouceur())."<br>";
$personnage2->caresserSurement($personnage1);
echo "le personnage 2 caresse surement à : ".$personnage1->getForceCaresse()."<br>";
echo "La douceur du personnage 1 après caresserSurement est de :".($personnage1->getDouceur())."<br>";



?>

