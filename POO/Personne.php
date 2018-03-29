<?php
class Personne {
    // --- Propriétés
    private $nom;
    private $age;

    // --- Méthodes
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getNom() {
        return strToUpper($this->nom);
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getAge() {
        return $this->age;
    }
}
?>
