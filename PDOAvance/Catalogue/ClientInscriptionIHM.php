<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Inscription client</h1>
        <form action="./ClientInscriptionCTRL.php" method="POST">

            <label>Nom</label>
            <input type="text" name="nom" value="Cullé" />
            <label>Prénom</label>
            <input type="text" name="prenom" value="Roland" />
            <label>adresse</label>
            <input type="text" name="adresse" value="5 rue des Prostituées" />
            <label>date de naissance</label>
            <input type="text" name="date_naissance" value="14/05/1982" />
            <label>Code postal</label>
            <input type="text" name="cp" value="59000" />
            
            <input type="submit">
        </form>
        
        
        <?php
        if (isSet($liAffectes)) {
            echo "<br>$liAffectes enregistrement ajouté";
        }
        ?>
    </body>
</html>
