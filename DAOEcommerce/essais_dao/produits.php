<?php

/* ProduitsDAOProceduralTests.php */

require_once '../daos/ProduitsDAOProcedural.php';

try {
    $lcnx = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcnx->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
    $lcnx->exec("SET NAMES 'UTF8'");

    echo "<hr>selectAll<hr>";
    $lsContenu = "";
    $tLines = selectAll($lcnx);
    foreach ($tLines as $line) {
        foreach ($line as $field => $value) {
            $lsContenu .= $value . ";";
        }
        $lsContenu .= "\n";
    }
    echo nl2br($lsContenu);

    
    echo "<hr>selectOne<hr>";
    $lsContenu = "";
    $tLine = selectOne($lcnx, "4");
    foreach ($tLine as $field => $value) {
        $lsContenu .= $value . ";";
    }
    $lsContenu .= "\n";
    echo nl2br($lsContenu);

    echo "<hr>insert<hr>";
    $lcnx->beginTransaction();
    $tAttributesValues = array();
    $tAttributesValues['id_produit'] = "13";
    $tAttributesValues['designation'] = "Orangina";
    $tAttributesValues['prix'] = 12.5;
    $tAttributesValues['qte_stockee'] = 12;
    $tAttributesValues['photo'] = 'coke.png';
    $liAffecte = insert($lcnx, $tAttributesValues);
    echo "Insertions : $liAffecte";
    $lcnx->commit();

    echo "<hr>delete<hr>";
    $lcnx->beginTransaction();
    $liAffecte = delete($lcnx, "12");
    echo "Suppressions : $liAffecte";
    $lcnx->commit();

    echo "<hr>update<hr>";
    $lcnx->beginTransaction();
    $tAttributesValues = array();
    $tAttributesValues['id_produit'] = "1";
    $tAttributesValues['designation'] = "cremant";
    $tAttributesValues['prix'] = 23.5;
    $tAttributesValues['qte_stockee'] = 2;
    $tAttributesValues['photo'] = 'cremant.png';
    $liAffecte = update($lcnx, $tAttributesValues);
    $lcnx->commit();
    
    
    $lcnx = null;
} catch (PDOException $e) {
    $lsMessage = $e->getMessage();
}

?>

