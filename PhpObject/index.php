<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 12/03/2018
 * Time: 09:41
 */

//require 'Personne.php';
//require 'Adresse.php';

echo "Bienvenue<br />";

function autoloadClass($classe){
    require $classe.".php";
}

spl_autoload_register("autoloadClass");

$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$email = $_GET['email'];
$telephone = "06666666";

// instanciation
$personne = new Personne($nom, $prenom, "0320", $email);
//$personne->nom = $nom;
$personne->setNom("Dupond");
$personne->setSiteWeb("google.fr");

/**** STATIC ****/
// appel d'une propriété static publique
echo "<br> Planète : ".Personne::$planete;
Personne::$planete = "Mars";
echo "<br> Planète : ".Personne::$planete;

Personne::direBonjour();


// instanciation
/*
$personne2 = new Personne();
$personne2->nom = "Dupond";
$personne2->prenom = "Jean";
$personne2->telephone = "03333333";
*/



//echo $personne->nom." ".$personne->prenom;


var_dump($personne);
echo "<br />";


$adresse1 = new Adresse ("5 rue du String","37142","Tours");
echo $adresse1->afficher();
$personne->setAdresse($adresse1);

echo "<br> La personne 1 veut s'exprimer";
$personne->parler();
echo $personne->getAdresse()->afficher();
echo "<br><a href='".$personne->getSiteWeb()."'>Site web de la personne.</a>";