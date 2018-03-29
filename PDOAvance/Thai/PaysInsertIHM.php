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
        <h1>Nouveau pays</h1>
        <form action="./PaysInsertCTRL.php" method="POST">

            <label>ID</label>
            <input type="text" name="id_pays" value="BU" />
            <label>Nom Pays</label>
            <input type="text" name="nom_pays" value="BULGARIE" />
            <input type="submit">
        </form>
        
        
        <?php
        if (isset($liAffectes)){
            echo "<br>$liAffectes enregistrement ajouté";
        }
        ?>
    </body>
</html>
