<?php

/*
 * Metafile.php
 */

class Metafile {

    /**
     * 
     * @param type $dossier
     * @return array
     */
    public static function getFiles($dossier, $extension) {
        $tFiles = array();
        try {
            $tEntrees = scandir($dossier);
            foreach ($tEntrees as $entree) {
//                echo "<br>$entree";
                $cheminComplet = "$dossier$entree";
                $info = new SplFileInfo($entree);
                if ($info->getExtension() == $extension) {
                    array_push($tFiles, $entree);
                }
//                if ($entree != "." && $entree != ".." && (substr($entree, -3) == $extension)) {
//                    $cheminComplet = "$dossier$entree";
//                    array_push($tFiles, $cheminComplet);
//                }
            }
        } catch (Exception $e) {
            array_push($tFiles, $e->getMessage());
        }
        return $tFiles;
    }

    /**
     * 
     * @param type $file
     * @param type $delimiter
     * @return type
     */
    public static function getHeaders($file, $delimiter) {
        $f = fopen($file, "r");
        $lsHeaders = fgets($f);
        fclose($f);
        return explode($delimiter, $lsHeaders);
    }

}

?>
