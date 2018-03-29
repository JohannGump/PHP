<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 12/03/2018
 * Time: 15:50
 */

class Personnage
{

    private $nom;
    private $forceCaresse;
    private $douceur;

    /**
     * Personnage constructor.
     * @param $nom
     * @param $forceCaresse
     * @param int $douceur
     */
    public function __construct($nom, $douceur=0, $forceCaresse=null)
    {
        $this->nom = $nom;
        $this->douceur = $douceur;
        if ($forceCaresse == null){
            $this->forceCaresse = rand(0,100);
        } else {
            $this->forceCaresse = $forceCaresse;
        }
    }

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
     * @return int
     */
    public function getForceCaresse()
    {
        return $this->forceCaresse;
    }

    /**
     * @param int $forceCaresse
     */

    public function setForceCaresse($forceCaresse)
    {
        $this->forceCaresse = $forceCaresse;
     }

    /**
     * @return int
     */
    public function getDouceur()
    {
        return $this->douceur;
    }

    /**
     * @param int $douceur
     */
    public function setDouceur($douceur)
    {
        $this->douceur =  $douceur;
    }


    public function caresser($personnage)
    {
        $initDouceur = $personnage->getDouceur();
        $personnage->setDouceur(rand($this->getForceCaresse()/2, $this->getForceCaresse()) + $initDouceur);
    }

    public function caresserSurement($personnage)
    {
        $initDouceur = $personnage->getDouceur();
        $personnage->setDouceur(0.75 * $this->getForceCaresse() + $initDouceur);
    }

}