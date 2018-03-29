<html>
    <head>
        <meta charset="utf-8" />
        <title>TrouverCommunesParCP.php</title>
    </head>

    <body>
        <form method="POST" action="">
            <label>Code : </label>
            <input type="text" name="codepos" value="24000" size="5" />
            <input type="submit" />
        </form>

        <?php
        // --- Recherche par code postal
        $code = filter_input(INPUT_POST, "codepos");

        if ($code != null) {
            $lsNomFichier = "insee.csv";
            // ouverture du fichier et transfert dans un tableau
            $t = file($lsNomFichier);

            $i = 0;
            // Nombre de lignes du tableau
            $compte = count($t);
            
            while ($i < $compte) {
                // décomposition des colonnes du tableau                 
                $tChamps = explode(";", $t[$i]);
                if ($tChamps[1] == $code) {
                    echo($tChamps[0] . "<br>");                 
                }
                $i++;
            };
        
            ///
        }
        ?>



