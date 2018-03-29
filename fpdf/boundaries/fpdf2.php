<?php
	// --- fpdf2.php
	header("Content-Type: text/html;charset=UTF-8");

	// --- La bibliotheque
	require_once("../lib/fpdf17/fpdf.php");

	// --- Instancie un objet fpdf
	$pdf = new FPDF();

	// --- Cree une page
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->SetXY(10, 5);
	$pdf->Write(10,'Hello FPDF!');

	// --- Stocke le PDF sur le disque
	$pdf->Output("../outputs/2.pdf");
?>

<label>Un fichier PDF dans une page HTML</label>
<br /><br/>
<object data="../outputs/2.pdf" width="400" height="400" type="application/pdf" >
</object>

