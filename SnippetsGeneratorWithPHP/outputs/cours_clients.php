class Clients{
private $adresse;
private $cp;
private $dateNaissance;
private $idClient;
private $nom;
private $prenom;
public function  __construct($adresse='' ,$cp='' ,$dateNaissance='' ,$idClient='' ,$nom='' ,$prenom='' );
public function getAdresse() {
	return $this->adresse;
}
public function getCp() {
	return $this->cp;
}
public function getDateNaissance() {
	return $this->dateNaissance;
}
public function getIdClient() {
	return $this->idClient;
}
public function getNom() {
	return $this->nom;
}
public function getPrenom() {
	return $this->prenom;
}
public function setAdresse($adresse) {
	 $this->adresse= $adresse;
}
public function setCp($cp) {
	 $this->cp= $cp;
}
public function setDateNaissance($dateNaissance) {
	 $this->dateNaissance= $dateNaissance;
}
public function setIdClient($idClient) {
	 $this->idClient= $idClient;
}
public function setNom($nom) {
	 $this->nom= $nom;
}
public function setPrenom($prenom) {
	 $this->prenom= $prenom;
}
}
