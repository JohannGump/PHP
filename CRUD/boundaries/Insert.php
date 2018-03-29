<?php


// Rappel de la page d'Acceuil
include 'Acceuil.php';

       //--------------------------------------------------//
        // --------- AJOUTER ENREGISTREMENT ----------------//
        //--------------------------------------------------//          
       
        $lsContenu = "";
        $selectedFile = $lsChemin . filter_input(INPUT_GET, "fileChoice");
        $separator = filter_input(INPUT_GET, "separateur");
        $lsMessage = "";
        

            // on check qu'un fichier a été sélectionné
            if ($selectedFile == $lsChemin) {
                if (isset($selectedFile)) {
                    $lsMessage = "Veuillez choisir un fichier";
                }
            } else {
                if ($separator == null) {
                    $lsMessage = "Veuillez choisir un séparateur";
                } else {
                    $tLignes = file($selectedFile);
                    $tEntetes = explode("$separator", $tLignes[0]);
                    for ($i = 0; $i < count($tEntetes); $i++) {
                        
                        echo("<label>$tEntetes[$i] : </label><input type='text' name='$tEntetes[$i]'><br>");
                        $validateInsert = filter_input(INPUT_POST, "valider");
                    }    
 
                        $fichier = $selectedFile;
                        $canal = fopen($fichier, "a+");
                        
                        for ($i = 0; $i < count($tEntetes)-1; $i++) {
                            
                        $fChamps[$i] = filter_input(INPUT_GET, "$tEntetes[$i]");

                            if ($fChamps[$i] != null) {                               
                                // --- Creation et/ou ouverture pour ajout
                                // --- Ajout d'un enregistrement
                                fwrite($canal, $fChamps[$i] . ";");
                                // --- Fermeture du fichier
                            } 
                        }                 
                    fwrite($canal, $fChamps[sizeof($fChamps)-1] . "\r\n");
                    fclose($canal);
                    $lsMessage = "Un personnage a été ajouté dans $fichier";                 
                
            }
        }
 

        /*
         * BLOC ....
         */
        /*
          if ($code == null || $nom == null || $cp == null) {
          $message = "Passez par le formulaire !!!";
          } else {
          if (empty($code) || empty($nom) || empty($cp)) {
          $message = "Toutes les saisies sont obligatoires !";
          } else {
          $fichier = "personnages.txt";
          // --- Creation et/ou ouverture pour ajout
          $canal = fopen($fichier, "a+");
          // --- Ajout d'un enregistrement
          fwrite($canal, $code . ";" . $nom . ";" . $cp . "\r\n");
          // --- Fermeture du fichier
          fclose($canal);
          $message = "Un personnage a été ajouté dans $fichier";
          }
          }

         */
?>

 <input type='submit' value='insertValidation' name='valider'>