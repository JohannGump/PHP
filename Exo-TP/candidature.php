<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 15/03/2018
 * Time: 14:12
 */

class Candidature
{
    private $civilite;
    private $nom;
    private $dateNaissance;
    private $email;
    private $cp;
    private $telephone;
    private $cv;

    /**
     * Candidature constructor.
     * @param $civilite
     * @param $nom
     * @param $dateNaissance
     * @param $email
     * @param $cp
     * @param $telephone
     * @param $cv
     */
    public function __construct($cv, $nom, $dateNaissance, $email, $cp=null, $telephone=null, $civilite=null)
    {
        $this->civilite = $civilite;
        $this->nom = $nom;
        $this->dateNaissance = $dateNaissance;
        $this->email = $email;
        $this->cp = $cp;
        $this->telephone = $telephone;
        $this->cv = $cv;
    }

    /**
     * @return null
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param null $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
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
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
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

    /**
     * @return null
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param null $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return null
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param null $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * @param mixed $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
    }



}