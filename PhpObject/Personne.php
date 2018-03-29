<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 12/03/2018
 * Time: 09:30
 */

class Personne
{
    // propriétés de la classe
    private $nom;
    private $prenom;
    private $telephone;
    private $email;
    private $siteweb;
    private $adresse;

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    // $this référence à l'instance et self à la classe

    static public $planete = "Terre";
    static private $planete2 = "Mars";

    /**
     * @return mixed
     */
    public function getSiteweb()
    {
        if (strpos($this->siteweb, "http://") === false){
            $this->siteweb = "http://".$this->siteweb;
        }
        return $this->siteweb;
    }

    /**
     * @param mixed $siteweb
     */
    public function setSiteweb($siteweb)
    {
        $this->siteweb = $siteweb;
    }

    /**
     * GETTET ET SETTER / accesserus et mutateurs
     * permet de centraliszer l'accès aux valeurs des atttributs
     */

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        if (strlen($telephone) == 10){
            $this->telephone = $telephone;
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // constructeur, appelé lors de l'instanciation de la classe
    public function __construct($nom, $prenom, $telephone="0320202020", $email="jo@mail.fr"){
        if ($telephone == null){
            $telephone = "0320202020";
        }
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setTelephone($telephone);
        $this->setEmail($email);

        echo "Personne instanciée <br />";
        //$this->parler();
        echo "Planete 2: ". Personne::$planete2."</br>";
        echo "Planete 2: ". self::$planete2."</br>";
    }

    // méthodes de classe
    public function parler(){
        echo "<br> Je m'appelle ". $this->prenom." ".$this->nom."<br>";
        echo self::$planete;
    }

    static public function direBonjour(){

        // Dans une méthode statique, le mot clé $this ne peut pas être utilisé
        // une méthode statique fait référence à la classe et non à une instance en particulier
        // seules les propriétés statiques de la classe sont utilisables
        echo "<br> Bonjour !".self::$planete;

        // impossible de faire par ex:
        // echo $this->nom;
    }
}


?>