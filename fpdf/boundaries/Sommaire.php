<?php

header("Content-Type: application/pdf;charset=UTF-8");
   // --- fpdfGrille.php
   require_once("../lib/fpdf17/fpdf.php");


   $pdf = new FPDF();

   $pdf->SetFont('Courier','',12);

   $pdf->SetDrawColor(0,0,0);
   $pdf->SetFillColor(199,199,199);
   $pdf->SetTextColor(0,0,0);


  
   try {
      $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
      $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // --- Si on utilise ceci il faut utiliser utf8_decode 
      // --- pour afficher plus bas les caractères accentues
      $lcn->exec("SET NAMES 'UTF8'");

      $lsSQL = "SELECT * FROM produits";
      $lrs = $lcn->query($lsSQL);
     
      
      $pdf->AddPage();
    // --- Cree un objet lien
 

    $i = 2;
    foreach ($lrs as $enr) {
        
        $lien = $pdf->AddLink();
        $pdf->SetFont('', 'U');
        $pdf->SetTextColor(0, 0, 255);
        $pdf->SetLink($lien, 0, $i);
        $pdf->ln();
        $text= str_pad(utf8_decode($enr[1] ),30);
        $pdf->Write(10,$text. "page " . $i, $lien);
        $i++;
    }
    
    $pdf->SetFont('');
    $pdf->SetTextColor(0, 0, 0);
    
    $lrs->closeCursor();

    $lrs = $lcn->query($lsSQL);
    
    foreach($lrs as $enr) {

        $pdf->AddPage();
        $pdf->Write(10, "ID:" . $enr[0]);
        $pdf->ln();
        $pdf->Write(10, "DESIGNATION:" . $enr[1]);
        $pdf->ln();
        $pdf->Write(10, "PRIX:" . $enr[2]. " ". utf8_decode(chr(0xC2).chr(0x80)));
        $pdf->ln();
        $pdf->Write(10, "STOCK:" . $enr[3]);
        $pdf->ln();
        $pdf->Image("../images/".$enr[4], 20, 60);
  
      }
      $lrs->closeCursor();
     
        
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
