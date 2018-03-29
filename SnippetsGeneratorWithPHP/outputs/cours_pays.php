class Pays{
private $idPays;
private $nomPays;
public function  __construct($idPays='' ,$nomPays='' );
public function getIdPays() {
	return $this->idPays;
}
public function getNomPays() {
	return $this->nomPays;
}
public function setIdPays($idPays) {
	 $this->idPays= $idPays;
}
public function setNomPays($nomPays) {
	 $this->nomPays= $nomPays;
}
}
