<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 15/03/2018
 * Time: 12:05
 */

/***
 * a
 */

$var1 = "1";
$var2 = 1;
$var3 = true;

/***
 * b
 */

function isEquivalent($var1, $var2){
    if($var1 == $var2){
        echo "Equivalent";
    }

    if($var1 === $var2){
        echo "Different";
    }
}

isEquivalent("1",1);

/**
 * c
 */

$tableau =["1",1,true];

forEach($tableau as $tab){
    var_dump($tab);
}

