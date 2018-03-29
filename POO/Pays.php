<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pays {

    private $idPays;
    private $nomPays;

    // constructeur vide avec attribut = ""
    function __construct($idPays = "", $nomPays = "") {
        $this->idPays = $idPays;
        $this->nomPays = $nomPays;
    }

    function getIdPays() {
        return $this->idPays;
    }

    function getNomPays() {
        return $this->nomPays;
    }

    function setIdPays($idPays) {
        $this->idPays = $idPays;
    }

    function setNomPays($nomPays) {
        $this->nomPays = $nomPays;
    }

}
