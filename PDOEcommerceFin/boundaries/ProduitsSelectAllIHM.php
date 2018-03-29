<!DOCTYPE html>
<!--
ProduitsSelectAllIHM.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <title>Catalogue</title>
    </head>

    <body>
        <header id="header">
            <?php
            include 'partials/Header.php';
            ?>
        </header>

        <nav id="nav">
            <?php
            include 'partials/Nav.php';
            ?>
        </nav>

        <section id='centre'>
            <h1>Catalogue</h1>
            <table border='1'>
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Prix</th>
                        <th>Photo</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    for ($i = 0; $i < count($tProduits); $i++) {
                        echo "<tr>\n";
                        echo "<td>" . $tProduits[$i][1] . "</td>\n";
                        echo "<td>" . number_format($tProduits[$i][2], 2, ',', ' ') . " &euro;</td>\n";
                        echo "<td><a href='../controls/MainCTRL.php?action=ficheProduit&id_produit=" . $tProduits[$i][0] . "'><img src='../images/" . $tProduits[$i][4] . "' alt='Photo du produit' height='50' /></a></td>\n";
                        echo "<td><a href='../controls/MainCTRL.php?action=ajouterAuPanier&id_produit=" . $tProduits[$i][0] . "'><img src='../images/panier_vert.png' alt='Panier' height='28' /></a></td>\n";
                        echo "</tr>\n";
                    }
                    ?>
                </tbody>
            </table>

            <p>
                <label id='lblMessage'>
                    <?php
                    if (isSet($lsMessage)) {
                        echo $lsMessage;
                    }
                    ?>
                </label>
            </p>

        </section>

        <footer id="footer">
            <?php
            include 'partials/Footer.php';
            ?>
        </footer>
        <?php ?>
    </body>
</html>
