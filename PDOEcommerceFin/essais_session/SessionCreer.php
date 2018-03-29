
<?php
// --- SessionCreer.php
header("Content-Type: text/html;charset=UTF-8");
?>

<form action="" method="get">
    <input type="text" name="prenom" value="Pascal" />
    <input type="submit" value="Valider" />
</form>

<a href="SessionAfficher.php">Afficher</a>
<br>
<a href="SessionDetruire.php">Détruire</a>
<br>

<?php
if (isSet($_GET["prenom"])) {
    session_start();
    $_SESSION['prenom'] = $_GET["prenom"];
    echo "Variable de session créée";
    echo "<br>Prénom : " . $_SESSION['prenom'];
}
?>
