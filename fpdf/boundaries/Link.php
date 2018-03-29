<?php
	header("Content-Type: application/pdf;charset=UTF-8");
	// --- fpdfLiens.php
	require_once("../lib/fpdf17/fpdf.php");

	$pdf = new FPDF('P','mm','A4');

	// --- Ajoute une page
	$pdf->AddPage();

	// --- Definit la police (Police, Graisse, taille)
	$pdf->SetFont('Courier','B',20);
	$pdf->Write(10,'Les liens avec FPDF!!!');
	$pdf->ln();

	// --- Ecrit un texte (largeur, hauteur, texte)
	$pdf->Write(10,'Lien interne');
	$pdf->ln();

	// --- Cree un objet lien
	$lien = $pdf->AddLink();
	// --- Definit la destination du lien (lien, position Y, page)
	$pdf->SetLink($lien, 0, 2);

	// --- On met la déco et la couleur : souligne et bleu
	$pdf->SetFont('','U');
	$pdf->SetTextColor(0, 0, 255);
	// --- Place le lien(x, y, largeur, hauteur, lien)
	$pdf->Write(10,'Lien interne vers le haut de la page 2!', $lien);
	// --- On enleve le decor et la couleur : non souligne et noir
	$pdf->SetFont('');
	$pdf->SetTextColor(0, 0, 0);

	$pdf->ln();
	$pdf->Write(10,'Lien externe');
	$pdf->ln();

	// --- On remet la deco et la couleur : souligne et bleu
	$pdf->SetFont('','U');
	$pdf->SetTextColor(0, 0, 255);
	$pdf->Write(5,'Lien externe vers www.fpdf.org','http://www.fpdf.org');
	// --- On enleve le decor et la couleur : non souligne et noir
	$pdf->SetFont('');
	$pdf->SetTextColor(0, 0, 0);


	// --- Une autre page
	$pdf->AddPage();
	$pdf->Write(10,'Autre page');

	// --- Sortie navigateur
	$pdf->Output();
?>
