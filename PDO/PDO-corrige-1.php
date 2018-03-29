<?php
header("Content-Type: text/html; charset=UTF-8");
// --- VillesSelectTablePlus.php

$lsBody = "";

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lrs = $lcn->query("SELECT * FROM villes");

    foreach ($lrs as $enr) {
        $lsBody .= "<tr>";

        $lsBody .= "<td>";
        $lsBody .= $enr[0];
        $lsBody .= "</td>";

        $lsBody .= "<td>";
        $lsBody .= $enr[1];
        $lsBody .= "</td>";

        $lsBody .= "<td>";
        $lsBody .= "<td><a href='http://$enr[2]'>$enr[2]</a></td>";
        $lsBody .= "</td>";

        $lsBody .= "<td>";
        $lsBody .= "<td><img src='../images/$enr[3]' /></td>";
        $lsBody .= "</td>";

        $lsBody .= "<td>";
        $lsBody .= $enr[4];
        $lsBody .= "</td>";

        $lsBody .= "</tr>";
    }
    $lrs->closeCursor();
} catch (PDOException $e) {
    
}

$lcn = null;
?>

<table border = "1">
    <thead>
        <tr>
            <th>CP</th>
            <th>Ville</th>
            <th>Site</th>
            <th>Photo</th>
            <th>ID Pays</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $lsBody; ?>
    </tbody>
</table>

