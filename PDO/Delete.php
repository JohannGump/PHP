<?php
// --- InjectionSQLNo.php
header("Content-Type: text/html; charset=UTF-8");

$lsContenu = "";

$id_client = filter_input(INPUT_GET, "id_client");

if ($id_client != null) {

    try {
        $lcnx = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
        $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $lcnx->exec("SET NAMES 'UTF8'");

        $lsSelect = "SELECT * FROM villes WHERE cp = ?";
        $lrs = $lcnx->prepare($lsSelect);
        $lrs->bindParam(1, $id_client);
        $lrs->execute();

        $lsContenu = "";

        // On boucle sur les lignes
        foreach ($lrs as $enr) {
            $lsContenu .= "$enr[0]-$enr[1]<br />";
        }

        $lrs->closeCursor();
    } catch (PDOException $e) {
        $lsContenu = "Echec de l'exécution : " . $e->getMessage();
    }

    $lcnx = null;
}
?>

<form action="" method="GET">
    <label>Votre Id : </label>
    <input type="text" name="id_client" value="1" />
    <input type="submit" value="Valider" name="btValider" />
</form>
<hr>
<?php
echo $lsContenu;
?>