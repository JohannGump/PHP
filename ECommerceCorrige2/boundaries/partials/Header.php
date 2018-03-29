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