<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 14/03/2018
 * Time: 09:42
 */

class Utilisateur
{

    protected $name;
    protected $email;
    protected $telephone;
    protected $activated;
    protected $creationDate;
    protected $modificationDate;
    protected $accountType;
    protected $pseudo;

    const ACCOUNT_ENABLED = 1;
    const ACCOUNT_DISABLED = 0;

    const TYPE_ACCOUNT_ADMIN = 1;
    const TYPE_ACCOUNT_STANDARD = 0;

    /**
     * Utilisateur constructor.
     * @param $name
     * @param $email
     * @param $telephone
     * @param $activated
     * @param $creationDate
     * @param $modificationDate
     * @param $accountType
     */
    public function __construct($name="", $email="", $telephone="", $activated="", $accountType="", $pseudo="")
    {
        $this->name = $name;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->activated = $activated;
        $this->creationDate = date('Y-m-d H:i:s');
        $this->accountType = $accountType;
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * @param mixed $activated
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * @param mixed $modificationDate
     */
    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    /**
     * @return mixed
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * @param mixed $accountType
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;
    }

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
        $this->pseudo = $pseudo;    }

    public static function getData(PDO $pdo)
    {
        try {
            $lsSQL = 'SELECT * FROM utilisateur';
            $lrs = $pdo->query($lsSQL);
            $tData = $lrs->fetchAll(PDO::FETCH_ASSOC);
            $lrs->closeCursor();
        } catch (Exception $e) {
            $lsMessage = $e->getMessage();
            $tData = array();
            array_push($tData, $lsMessage);
        }
        //var_dump($tData);
        return $tData;
    }

    public function addUser(PDO $pdo)
    {
        try {
            $lsSQL = 'INSERT INTO utilisateur(name, email, telephone, account , creation_date, type_account, pseudo) 
                          VALUES(?, ?, ?, ?, ?, ?, ?)';
            initialiser($pdo);
            $lcmd = $pdo->prepare($lsSQL);
            $this->activated == "on" ? $activated = 1 : $activated = 0;
            $lcmd->execute(array($this->name, $this->email, $this->telephone, $activated, $this->creationDate, $this->accountType, $this->pseudo));
            valider($pdo);
        } catch (Exception $e) {
            annuler($pdo);
            var_dump($e);
        }
    }

    public function updateUser(PDO $pdo, $id){
        try {
            $lsSQL = 'UPDATE utilisateur 
                      SET name=?, email=?, telephone=?, account=?, creation_date=?, modification_date=?, type_account=?, pseudo=?
                      WHERE id = $id';
            initialiser($pdo);
            $lcmd = $pdo->prepare($lsSQL);
            $lcmd->execute(array($this->name, $this->email, $this->telephone, $activated, $this->creationDate, $this->modificationDate, $this->accountType, $this->pseudo));
            valider($pdo);
        } catch (Exception $e) {
            annuler($pdo);
            var_dump($e);
        }
    }

    public function getUser(PDO $pdo, $id){
        try {
            $lsSQL = 'SELECT * FROM utilisateur WHERE id= :id';
            $lrs = $pdo->prepare($lsSQL);
            $lrs->bindParam(':id', $id);
            $lrs->execute();
            $tData = $lrs->fetchAll(PDO::FETCH_ASSOC);
            $lrs->closeCursor();
        } catch (Exception $e) {
            $lsMessage = $e->getMessage();
            $tData = array();
            array_push($tData, $lsMessage);
            var_dump($e);
        }
        return $tData;
    }



}