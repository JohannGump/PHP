<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 12/03/2018
 * Time: 12:02
 */

/* TODO EXERCICE
    Créer une classe adresse avec les propriétés suivantes :
    - rue
    - code postal
    - adresse

    Ces propriétés ne doivent pouvoir être accessibles depuis l'extérieur de la classe.
    Le code postal doit toujours être une chaine de caractère à 5 caractères

    Lors de l'instanciation, il doit être possible de passer directement des valeurs
*/

class Adresse
{

    private $rue;
    private $codePostal;
    private $adresse;

    /**
     * Adresse constructor.
     * @param $rue
     * @param $codePostal
     * @param $adresse
     */

    public function __construct($rue=null, $codePostal=null, $adresse=null)
    {
        $this->setRue($rue);
        $this->setCodePostal($codePostal);
        $this->setAdresse($adresse);
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     */
    public function setCodePostal($codePostal)
    {
        if (is_string($codePostal) && strlen($codePostal) == 5) {
            $this->codePostal = $codePostal;
        }
    }

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

    public function afficher() {
        return "<br>".$this->getRue()." ".$this->getCodePostal()." ".$this->getAdresse();
    }


}