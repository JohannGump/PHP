class Produits{
private $designation;
private $idProduit;
private $photo;
private $prix;
private $qteStockee;
public function  __construct($designation='' ,$idProduit='' ,$photo='' ,$prix='' ,$qteStockee='' );
public function getDesignation() {
	return $this->designation;
}
public function getIdProduit() {
	return $this->idProduit;
}
public function getPhoto() {
	return $this->photo;
}
public function getPrix() {
	return $this->prix;
}
public function getQteStockee() {
	return $this->qteStockee;
}
public function setDesignation($designation) {
	 $this->designation= $designation;
}
public function setIdProduit($idProduit) {
	 $this->idProduit= $idProduit;
}
public function setPhoto($photo) {
	 $this->photo= $photo;
}
public function setPrix($prix) {
	 $this->prix= $prix;
}
public function setQteStockee($qteStockee) {
	 $this->qteStockee= $qteStockee;
}
}
