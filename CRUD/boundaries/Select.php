
<?php

// Rappel de la page d'Acceuil
include 'Acceuil.php';


        //--------------------------------------------------//
        // ---------------- SELECT -------------------------//
        //--------------------------------------------------//  
        // selon le nom du bouton
        $lsContenu = "";
        $selectedFile = $lsChemin . filter_input(INPUT_GET, "fileChoice");
        $separator = filter_input(INPUT_GET, "separateur");
        $lsMessage = "";
       
            // --- On vérifie qu'une source a bien été sélectionnée

            if ($selectedFile == $lsChemin) {
                if (isset($selectedFile)) {
                    $lsMessage = "Veuillez choisir un fichier";
                }
            } else {
                //$lsContenu = nl2br(file_get_contents($nomDuFichier));
                if ($separator == null) {
                    $lsMessage = "Veuillez choisir un séparateur";
                } else {
                    $tLignes = file($selectedFile);
                    $tEntetes = explode("$separator", $tLignes[0]);
                }
            }

            echo($lsMessage);

        ?>

        <div id="affichage">
            <table>
                <thead>
                    <tr>
                        <?php
                        if (isset($tEntetes)) {
                            $lsEntetes = "";
                            for ($i = 0; $i < count($tEntetes); $i++) {
                                $lsEntetes .= "<th>$tEntetes[$i]</th>";
                            }
                            echo $lsEntetes;
                        }
                        ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($tLignes)) {
                        for ($i = 1; $i < count($tLignes); $i++) {
                            echo "<tr>";
                            $tChamps = explode(";", $tLignes[$i]);
                            for ($j = 0; $j < count($tChamps); $j++) {
                                echo"<td>$tChamps[$j]</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table> 
        </div>           
