<html>
    <head>
        <meta charset="utf-8" />
        <title>Accueil</title>
    </head>

    <body>

    <section>
        <form action="../controls/MainCTRL.php" method="GET">
            <select name="nomVille" size="5">
                <?php
                for ($i = 0; $i < sizeof($lsTable); $i++) {
                    echo "<option value=' $lsTable[$i]'> $lsTable[$i]</option>\n";
                }
                ?>
            </select>

            <input type="submit" value="delete" name="btSubmit">
        </form> 
    </section>    
    </body>
</html>
