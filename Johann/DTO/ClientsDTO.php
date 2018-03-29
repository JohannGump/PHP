<?php 
class Clients {
      private $id_client; 
      private $nom; 
      private $prenom; 
      private $adresse; 
      private $date_naissance; 
      private $cp; 

  function __construct ($id_client = "", $nom = "", $prenom = "", $adresse = "", $date_naissance = "", $cp = "") {
      $this->id_client = $id_client;
      $this->nom = $nom;
      $this->prenom = $prenom;
      $this->adresse = $adresse;
      $this->date_naissance = $date_naissance;
      $this->cp = $cp;
  }

  function setIdClient($id_client){
      $this->id_client = $id_client;
  } 
 
  function setNom($nom){
      $this->nom = $nom;
  } 
 
  function setPrenom($prenom){
      $this->prenom = $prenom;
  } 
 
  function setAdresse($adresse){
      $this->adresse = $adresse;
  } 
 
  function setDateNaissance($date_naissance){
      $this->date_naissance = $date_naissance;
  } 
 
  function setCp($cp){
      $this->cp = $cp;
  } 
 
  function getIdClient(){
      return $this->id_client;
  } 
 
  function getNom(){
      return $this->nom;
  } 
 
  function getPrenom(){
      return $this->prenom;
  } 
 
  function getAdresse(){
      return $this->adresse;
  } 
 
  function getDateNaissance(){
      return $this->date_naissance;
  } 
 
  function getCp(){
      return $this->cp;
  } 
 
}

 ?>