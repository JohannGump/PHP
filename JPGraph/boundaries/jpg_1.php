<?php
header("Content-Type: text/html;charset=UTF-8");
// --- histo_1_gr.php
// --- Le chemin des bibliotheques
//set_include_path("{$_SERVER['PHPRC']}/jpgraph/src");

// --- Inclusion des bibliothèques
require_once("../lib/jpgraph-4.2.0/src/jpgraph.php");
require_once("../lib/jpgraph-4.2.0/src/jpgraph_bar.php");

// --- Les données
$serie1 = array(2,8,9,3,5,6);

// --- Crée le conteneur du graphe. Ces deux appels sont toujours obligatoires (Largeur, hauteur, cache)
$graphe = new Graph(500,400,"auto"); // --- Mise en cache automatique

// --- Définit les échelles; Une combinaison de valeurs : text...int pour y et x
$graphe->SetScale("textint");

// --- Création de l'histo d'une série
$histo1 = new BarPlot($serie1);

// --- Ajoute l'histo au graphe
$graphe->Add($histo1);

//$graphe->img->SetImgFormat("png"); // --- Inutile c'est par défaut
// --- Stocke le graphe
$lsNomFichier = "h1.png";
if (file_exists($lsNomFichier))
    unlink($lsNomFichier);
$graphe->Stroke($lsNomFichier);

// --- Affiche le graphe
$graphe->Stroke();
?>

<img src="h1.png" />