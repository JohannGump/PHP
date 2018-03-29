<?php

/**
 * Description of Generateur
 *
 * @author pascal
 */
require_once '../lib/Chaine.php';

class Generateur {

    /**
     * 
     * @param type $tElements
     * @return string
     */
    public static function getTableForm($tElements) {
        $code = "";
        for ($i = 0; $i < count($tElements); $i++) {
            $code .= "<tr>\n";
            $code .= "<td><label>$tElements[$i]</label></td>\n";
            $code .= "<td><input type='text' name='$tElements[$i]' value='' /></td>\n";
            $code .= "</tr>\n";
        }
        return $code;
    }

    /**
     * 
     * @param type $tElements
     * @return string
     */
    public static function getTableUlLi($tElements) {
        $code = "";
        for ($i = 0; $i < count($tElements); $i++) {
            $code .= "<ul>\n";
            $code .= "<li><label>$tElements[$i]</li></td>\n";
            $code .= "<li><input type='text' name='$tElements[$i]' value='' /></li>\n";
            $code .= "</ul>\n";
        }
        return $code;
    }

    /**
     * 
     * @param type $tElements
     * @return string
     */
    public static function getDAO($classe, $tElements) {
        $code = "";
        for ($i = 0; $i < count($tElements); $i++) {
            $code .= "<ul>\n";
            $code .= "<li><label>$tElements[$i]</li></td>\n";
            $code .= "<li><input type='text' name='$tElements[$i]' value='' /></li>\n";
            $code .= "</ul>\n";
        }
        return $code;
    }

    /**
     * 
     * @param type $tElements
     * @return string
     */
    public static function getDTO($classe, $tElements) {
        $code = "class " . Chaine::snake2camel($classe) . "{\n";
        // Les attributs
        for ($i = 0; $i < count($tElements); $i++) {
            $code .= "private $" . Chaine::snake2camel($tElements[$i], false) . ";\n";
        }
        // Le constructeur
        $code .= "public function  __construct(";
        for ($i = 0; $i < count($tElements); $i++) {
            $code .= "$" . Chaine::snake2camel($tElements[$i], false) . "='' ,";
        }
        $code = substr($code, 0, -1);
        $code .= ");\n";
        // Les getters et setters
        for ($i = 0; $i < count($tElements); $i++) {
            $code .= "public function get" . Chaine::snake2camel($tElements[$i]) . "() {\n";
            $code .= "\treturn $" . "this->" . Chaine::snake2camel($tElements[$i], false) . ";\n";
            $code .= "}\n";
        }
        for ($i = 0; $i < count($tElements); $i++) {
            $code .= "public function set" . Chaine::snake2camel($tElements[$i]) . "($" . Chaine::snake2camel($tElements[$i], false) . ") {\n";
            $code .= "\t $" . "this->" . Chaine::snake2camel($tElements[$i], false) . "= $" . Chaine::snake2camel($tElements[$i], false) . ";\n";
            $code .= "}\n";
        }

        // Fin de la classe
        $code .= "}\n";
        return $code;
    }

}
