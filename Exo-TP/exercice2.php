<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 15/03/2018
 * Time: 13:42
 */

/**
 * a
 */

function param($obl, $fac=null){
    echo $obl." + ".$fac."</br>";
}

param(5);
param(5,"a");

/**
 * b
 */

function param2($obl, $fac=null){
    echo strlen($obl)."<br>";
}

param2("bijour");

/**
 * c
 */

function param3($obl, $fac=100){
    echo $fac - strlen($obl)."<br>";
}

param3("bijour");

/**
 * d
 */

function param4($obl, $fac=100){
    $result = $fac - strlen($obl);
    if (strlen($obl) >= $result){
       echo "0"."<br>";
    } else {
       echo $result."<br>";
    }
}

param4("bijourjkjkjkljkjlkjkljlkjkjljkjljkjl");

/**
 * e
 */

function param5($obl, $fac=100){
    $result = $fac - strlen($obl);
    if (strlen($obl) >= $result){
        echo $obl." a un nombre de caract égale à 0"."<br>";
    } else {
        echo  $obl." a un nombre de caract égale à  ".strlen($obl)."<br>";
    }
}

param5("bijourjkjkjkljkjlkjkljlkjkjljkjljkjlghjghgjg");


class Useless
{

 private $result;

    function param6($obl, $fac=100){
        $add = $fac - strlen($obl);
        if (strlen($obl) >= $add){
            $this->result = $obl." a un nombre de caract égale à 0"."<br>";
        } else {
            $this->result = $obl." a un nombre de caract égale à  ".strlen($obl)."<br>";
        }
        return $this->result;
    }

}

$useless = new Useless;
echo $useless->param6("gfjk");

