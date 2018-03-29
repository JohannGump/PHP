<?php
try 
{
$pdo = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '.$e->getMessage());
}

try
{
$sql = "CALL VillesEtClients()";
$lrs = $pdo->query($sql);

$villeAvant="";

$lsContenu="";
// boucker sur le curseur
while($enr = $lrs->fetch()){
    $villeCourante = $enr[0];
    if ($villeCourante != $villeAvant){
        $lsContenu .= "<strong>". $enr[0] . "</strong><br>";
        $villeAvant = $villeCourante;     
    }
    $lsContenu .= $enr[1]."<br>";
}
echo $lsContenu;
}catch (PDOException $e){
    $liAffecte = -1;
}



