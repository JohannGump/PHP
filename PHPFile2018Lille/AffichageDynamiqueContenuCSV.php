<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$lsMessage = "";
$lsContenu = "";
$nomDuFichier = filter_input(INPUT_GET, "nomDuFichier");

if ($nomDuFichier == null){
    if (isset($nomDuFichier)){
        $lsMessage = "Veuillez saisir !";
    }
} else {
     if (file_exists($nomDuFichier)){
         //$lsContenu = nl2br(file_get_contents($nomDuFichier));
         $tLignes = file($nomDuFichier);
         $tEntetes = explode (";", $tLignes[0]);
     } else {
         $lsMessage = "Le fichier $nomDuFichier n'existe pas";
     }
 }


?>

<form action="" methode=get">
    Nom du fichier
    <input type="text" name="nomDuFichier" value="personnage.txt" />
    <input type="submit" />  
</form>

<table>
    <thead>
        <tr>
            <?php
            if (isset($tEntetes)){
            $lsEntetes = "";
            for ($i = 0; $i < count ($tEntetes); $i++){
                $lsEntetes .= "<th>$tEntetes[$i]</th>";
            }
            echo $lsEntetes;
            }
            ?>
        </tr>
    </thead>

<tbody>
    <?php
        if (isset ($tLignes)){
            for ($i = 1; $i < count($tLignes); $i++){
                echo "<tr>";
                $tChamps = explode(";", $tLignes[$i]);
                for ($j = 0; $j < count ($tChamps); $j++){
                    echo"<td>$tChamps[$j]</td>";
                }
                echo "</tr>";
            }
        }
    ?>
</tbody>
</table>

<p>
     <?php
        echo $lsMessage;
    ?>   
</p>

