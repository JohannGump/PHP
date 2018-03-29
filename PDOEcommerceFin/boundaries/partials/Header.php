<?php
/*
 * Header.php
 */
?>

<h1>Le site du commerce</h1>
<a href="../controls/MainCTRL.php?action=voirPanier">Voir le panier</a>
&nbsp;&nbsp;&nbsp;
<a href="../controls/MainCTRL.php?action=viderPanier">Vider le panier</a>
&nbsp;&nbsp;&nbsp;
<label>
    <?php
    if (isSet($lsInfosPanier)) {
        echo $lsInfosPanier;
    }
    ?>
</label>
&nbsp;&nbsp;&nbsp;

<?php
if (isSet($_SESSION["id_client"])) {
    if ($_SESSION["id_client"] == "") {
        echo "<label class='texteRouge'>Vous n'êtes pas connecté(e)</label>";
    } else {
        echo "<label class='texteVert'>Vous êtes connecté(e)</label>";
    }
}
?>
