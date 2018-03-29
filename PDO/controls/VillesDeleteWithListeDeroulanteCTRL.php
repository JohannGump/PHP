<!DOCTYPE html>
<!--
VillesDeleteWithListeDeroulanteCTRL.php
-->

<?php
$lsMessage = "";

try {
    /*
     * Connexion
     */
    $lcnx = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
    $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcnx->exec("SET NAMES 'UTF8'");


    $cp = filter_input(INPUT_POST, "cp");
    if (!is_null($cp)) {
        /*
         * SUPPRESSION
         */
        $lsSQL = "DELETE FROM villes WHERE cp=?";
        $lcmd = $lcnx->prepare($lsSQL);
        $lcmd->bindParam(1, $cp, PDO::PARAM_STR);
        $lcmd->execute();
        $lsMessage = $lcmd->rowcount() . " enregistrement supprimé";
    }


    /*
     * REMPLISSAGE DE LA LISTE
     */
    $lrs = $lcnx->query("SELECT cp, nom_ville FROM villes ORDER BY nom_ville");

    $lsOptions = "";
    foreach ($lrs as $enr) {
        $lsOptions .= "<option value='$enr[0]'>$enr[1]</option>\n";
        //$lsOptions .= "<option value='75000'>Paris</option>\n";
    }

    $lrs->closeCursor();

    $lcnx = null;
} catch (PDOException $e) {
    $lsMessage = $e->getMessage();
}

include '../boundaries/VillesDeleteWithListeDeroulanteIHM.php';
?>
