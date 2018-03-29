<?php
    // --- VillesSelect.php
    header("Content-Type: text/html; charset=UTF-8");

    try {
        // Connexion
        $lcnx = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
        $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $lcnx->exec("SET NAMES 'UTF8'");

        // Préparation et exécution du SELECT SQL
        $lsSelect = "SELECT cp, nom_ville, site, photo, id_pays FROM villes";
        //$lrs = $lcnx->prepare($lsSelect);
        //$lrs->execute();
        $lrs = $lcnx->query($lsSelect);
        $lrs->setFetchMode(PDO::FETCH_ASSOC);

        $lsContenu = "";
        $lsTableHTML = "";
        $lsMessage = "";
        $lsLink = "";
               
        // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
        // On boucle sur les lignes
            foreach ($lrs as $enr) { 
               $lsTableHTML .= "<tr>";
               // On boucle sur les colonnes
               foreach ($enr as $valeur) {
                   $lsTableHTML .= "<td>$valeur</td>";
               }
               $lsTableHTML .= "</tr>";
            }
                      
        // Fermeture du curseur (facultatif)
        $lrs->closeCursor();
    }
    // Gestion des erreurs
    catch(PDOException $e) {
       $lsMessage = "Echec de l'exécution : " . $e->getMessage();
    }

    // Déconnexion (facultative)
    $lcnx = null;

?>

<table border="1">
    <thead>
        <tr>
            <th>CP</th>
            <th>Ville</th>
            <th>Site</th>
            <th>Photo</th>
            <th>Site</th>
        </tr>
    </thead>
    <tbody>
        <?php
        echo $lsTableHTML;
        ?>
    </tbody>
</table>        
        
    </tbody>
</table>