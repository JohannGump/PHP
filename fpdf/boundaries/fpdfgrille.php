<?php
   // --- fpdfGrille.php
   require_once("../lib/fpdf17/fpdf.php");


   $pdf = new FPDF();

   $pdf->AddPage();
   $pdf->SetFont('Courier','',12);

   $pdf->SetDrawColor(0,0,0);
   $pdf->SetFillColor(199,199,199);
   $pdf->SetTextColor(0,0,0);

   // --- Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
   $pdf->Cell(30, 5, "Designation", 1, 0, 'C', 1);
   $pdf->Cell(70, 5, "Prix", 1, 1, 'C', 1);

   try {
      $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
      $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // --- Si on utilise ceci il faut utiliser utf8_decode 
      // --- pour afficher plus bas les caractères accentues
      $lcn->exec("SET NAMES 'UTF8'");

      $lsSQL = "SELECT designation, prix FROM produits";
      $lrs = $lcn->query($lsSQL);

      $max = 0;
      
      foreach($lrs as $enr) {
         // Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
         $pdf->Cell(30, 5, $enr[0], 1 , 0, 'C', 0);
         $pdf->Cell(70, 5, utf8_decode($enr[1]), 1 , 1, 'L', 0);
      }
      $lrs->closeCursor();

	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->Image("../lib/h1.png", 10, 30);
      
        
      // --- Redirection vers le navigateur
      $pdf->Output();

      // --- Redirection vers le disque
//      $pdf->Output("../outputs/villes.pdf");
//      echo "Fichier cr&eacute;&eacute; sur le disque";
      

      
   }

   catch(PDOException $e) {
      echo "Echec de l'exécution : " . $e->getMessage();
   }

   $lcn = null;
?>
