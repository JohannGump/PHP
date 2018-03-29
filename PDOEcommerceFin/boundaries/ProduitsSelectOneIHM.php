<!DOCTYPE html>
<!--
ProduitsSelectOneIHM.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <title>Fiche détaillée du produit</title>
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

        <section id='article'>
            <h1>Fiche détaillée du produit</h1>
            <?php
            echo $tProduit[0][1] . "<br>\n";
            echo number_format($tProduit[0][2], 2, ',', ' ') . " &euro;<br>\n";
            echo $tProduit[0][3] . " unités en stock<br>\n";
            echo "<img src='../images/" . $tProduit[0][4] . "' alt='Photo du produit' height='150' /><br>\n";
            echo "<a href='../controls/MainCTRL.php?action=ajouterAuPanier&id_produit=" . $tProduit[0][0] . "'><img src='../images/panier_vert.png' alt='Panier' height='28' /></a><br>\n";
            ?>
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
