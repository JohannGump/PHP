<?php

// fpdfCatalogueVersion2.php
// Une fichier par page
// + le sommaire en fin de fichier
require_once("../lib/fpdf17/fpdf.php");

$pdf = new FPDF();

$pdf->SetFont('Courier', '', 12);

$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(199, 199, 199);
$pdf->SetTextColor(0, 0, 0);

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //  Si on utilise ceci il faut utiliser utf8_decode
    //  pour afficher plus bas les caractères accentues
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT * FROM produits";
    $lrs = $lcn->query($lsSQL);

    $pdf->AddPage();
    $pdf->Write(10, utf8_decode("Notre Catalogue"));
    $pdf->Image("../images/champagnes.jpg", 30, 30);

    $tSommaire = array();
    $nbPages = 2;

    foreach ($lrs as $enr) {
        $pdf->AddPage();

        $pdf->ln();
        $pdf->Write(10, utf8_decode("Code produit : ") . $enr[0]);
        $pdf->ln();
        $pdf->Write(10, utf8_decode($enr[1]));
        $pdf->ln();
        $pdf->Write(10, str_replace(".", ",", $enr[2]) . " " . utf8_decode(chr(0xC2) . chr(0x80)));
        $pdf->ln();
        $pdf->Write(10, utf8_decode("Stock : ") . $enr[3] . utf8_decode(" unités"));
        $pdf->ln();
        if (!file_exists("../images/" . $enr[4]) || $enr[4] == null || $enr[4] == "") {
            $pdf->Image("../images/pas_d_image.png", 10, 70);
        } else {
            $pdf->Image("../images/" . $enr[4], 10, 70);
        }

        $tSommaire[utf8_decode($enr[1])] = $nbPages;
        $nbPages++;
    }

    $lrs->closeCursor();

    $pdf->AddPage();
    $pdf->SetFont('', 'U');
    $pdf->SetTextColor(0, 0, 255);
    foreach ($tSommaire as $designation => $page) {
        // Crée un objet lien
        $lien = $pdf->AddLink();

        // Définit la destination du lien (lien, positionYDestination, numero de page)
        $pdf->SetLink($lien, 10, $page);

        // Affiche le lien
        $blancs = str_repeat(" ", 50);
        $designation = $designation . substr($blancs, 0, 50 - strlen($designation));
        $page = sprintf("% 3d", $page);
        $pdf->Write(10, $designation . "Page " . $page, $lien);
        $pdf->ln();
    }

    // Redirection vers le navigateur
    $pdf->Output();
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

$lcn = null;
?>