<?php
/**
 * Created by PhpStorm.
 * User: bengu_000
 * Date: 12/01/2015
 * Time: 12:56
 */

namespace SteeveJ\PokemonBattle\Model;

/**
 * Class TrainerModel
 * @package SteeveJ\PokemonBattle\Model
 *
 * @Entity
 * @Table(name="trainer")
 */
class TrainerModel implements TrainerInterface
{
    /**
     * @var int
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(name="id", type="integer")
     */
    private $Id;

    /**
     * @var string
     * @Column(name="username", type="string", length=30)
     */
    private $UserName;

    /**
     * @var string
     * @Column(name="password", type="string", length=40)
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
     * @return string
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     * @return TrainerModel|TrainerInterface
     * @throws \Exception
     */
    public function setPassword($Password)
    {
        if(is_string($Password)){
            $this->Password = $Password;
        }
        else{
            throw new \Exception('Password must be a string');
        }
        return $this;

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
     * @return TrainerModel|TrainerInterface
     * @throws \Exception
     */
    public function setUserName($UserName)
    {
        if(is_string($UserName)){
            $this->UserName = $UserName;
        }
        else{
            throw new \Exception('Username must be a string');
        }
        return $this;
    }
}