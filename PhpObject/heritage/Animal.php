<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 13/03/2018
 * Time: 14:46
 */

class Animal
{
    private $couleur;
    private $poids;

    /**
     * Animal constructor.
     * @param $couleur
     * @param $poids
     */
    public function __construct($couleur, $poids)
    {
        $this->couleur = $couleur;
        $this->poids = $poids;
    }


    /**
     * @return mixed
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param mixed $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    /**
     * @return mixed
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * @param mixed $poids
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    }


}