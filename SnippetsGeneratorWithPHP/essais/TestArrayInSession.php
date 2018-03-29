<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/VARDUMP.php';

$t = array();
$t[] = "un";
$t[] = "deux";
$t[] = "trois";

$_SESSION["tableau"] = $t;

$t1 = $_SESSION["tableau"];

vardump($t);
?>
