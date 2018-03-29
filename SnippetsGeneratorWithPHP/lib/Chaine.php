<?php

/**
 * Description of Chaine
 *
 * @author pascal
 */
class Chaine {

    /**
     * 
     * @param type $chaine
     * @return string
     */
    public static function camel2snake($chaine) {
        $s = "";
        $s .= strtolower($chaine[0]);
        for ($i = 1; $i < strlen($chaine); $i++) {
            if ($chaine[$i] >= "A" && $chaine[$i] <= "Z") {
                $s .= "_" . strtolower($chaine[$i]);
            } else {
                $s .= $chaine[$i];
            }
        }
        return $s;
    }

    /**
     * 
     * @param type $chaine
     * @return string
     */
    public static function snake2camel($chaine, $classe = true) {
        $s = "";
        $t = explode("_", $chaine);
        for ($i = 0; $i < count($t); $i++) {
            $t[$i] = strtoupper(substr($t[$i], 0, 1)) . strtolower(substr($t[$i], 1));
        }
        if (!$classe) {
            $t[0] = strtolower($t[0]);
        }
        $s = implode("", $t);
        return $s;
    }

}
