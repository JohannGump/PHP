<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 14/03/2018
 * Time: 10:17
 */

class Admin extends Utilisateur
{

    protected $pseudo;

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }


}