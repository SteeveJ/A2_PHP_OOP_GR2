<?php
/**
 * Created by PhpStorm.
 * User: bengu_000
 * Date: 12/01/2015
 * Time: 12:56
 */

namespace SteeveJ\PokemonBattle\Model;


class TrainerModel implements TrainerInterface
{
    /**
     * @var int
     */
    private $Id;

    /**
     * @var string
     */
    private $UserName;

    /**
     * @var string
     */
    private $Password;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param int $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->UserName;
    }

    /**
     * @param string $UserName
     */
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;
    }
}