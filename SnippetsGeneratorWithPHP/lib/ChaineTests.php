<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Chaine.php';

echo "<br>camel2snake : ";
echo Chaine::camel2snake("NomDuClient");

echo "<br>snake2camel : ";
echo Chaine::snake2camel("nom_du_client");

echo "<br>snake2camel : ";
echo Chaine::snake2camel("nom_du_client", false);

?>
