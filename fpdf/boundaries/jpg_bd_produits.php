<?php

header('Content-type: image/jpeg');
// --- graphe_bd_produits.php
ob_start();
require_once("../lib/jpgraph-4.2.0/src/jpgraph.php");
require_once("../lib/jpgraph-4.2.0/src/jpgraph_bar.php");

$tDonnees = array();
$tEtiquettes = array();

try {
    $lcn = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lrs = $lcn->query("SELECT p.designation, SUM(l.qte * p.prix) AS CA
                        FROM produits p INNER JOIN ligcdes l
                        ON l.id_produit = p.id_produit
                        GROUP BY p.designation;");

    foreach ($lrs as $enr) {
        array_push($tDonnees, $enr[1]);
        array_push($tEtiquettes, $enr[0]);
    }
    // --- Cree le conteneur du graphique
    $graphe = new Graph(500, 400, "auto");
    $graphe->SetScale("textlin");

    $graphe->SetShadow();
    $graphe->img->SetMargin(70, 30, 20, 100);

    // --- Cree un histogramme
    $histo = new BarPlot($tDonnees);
    $histo->SetFillColor("orange");

    // --- Les valeurs sur les batons
    $histo->value->SetFormat('%0.2f');
    $histo->value->Show();

    // --- Le titre
    $graphe->title->Set("CA par PRODUITS");
    $graphe->title->SetFont(FF_FONT1, FS_BOLD);

    // --- Les axes
    // --- Toutes les polices ne fonctionnent pas. FF_ARIAL est OK
    $graphe->xaxis->SetFont(FF_DEFAULT, FS_NORMAL, 8);
    $graphe->xaxis->SetLabelAngle(45);
    $graphe->xaxis->SetTickLabels($tEtiquettes);
    $graphe->xaxis->SetTitleMargin(50);
    $graphe->xaxis->title->Set(utf8_decode("Désignation"));
    $graphe->xaxis->title->SetFont(FF_FONT1, FS_BOLD);

    $graphe->yaxis->SetTitleMargin(50);
    $graphe->yaxis->title->Set("Prix");
    $graphe->yaxis->title->SetFont(FF_FONT1, FS_BOLD);

    // --- Ajoute le tout au graphe
    $graphe->Add($histo);

    // --- Affiche le graphique
    $graphe->Stroke();
} catch (PDOException $e) {
    echo "Echec de l'ex&eacute;cution : " . $e->getMessage() . "<br/>";
}

$lcn = null;
?>
