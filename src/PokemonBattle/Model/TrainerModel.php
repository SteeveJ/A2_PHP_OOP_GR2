<?php


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
     * @var \DateTime
     * @Column(name="latestBattle_at", type="time")
     */
    private $latestBattle_at;


    /**
     * @var int
     * @Column(name="nbattle", type="integer")
     */
    private $nbBattle;

    /**
     * @return int
     */
    public function getNbBattle()
    {
        return $this->nbBattle;
    }

    /**
     * @param int $nbBattle
     * @return TrainerModel
     * @throws \Exception
     */
    public function setNbBattle($nbBattle)
    {
        if(is_int($nbBattle)){
            $this->nbBattle = $nbBattle;
        }
        else{
            throw new \Exception('nbBattle must be an integer');
        }
        return $this;

    }
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
     * @return \DateTime
     */
    public function getLatestBattleAt()
    {
        return $this->latestBattle_at;
    }

    /**
     * @param \DateTime $latestBattle_at
     */
    public function setLatestBattleAt($latestBattle_at)
    {
        $this->latestBattle_at = $latestBattle_at;
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
    /**
     * @param array $user
     *
     * @return bool
     */
    function addSession(array $user)
    {
        $_SESSION['status'] = 'connected';
        $_SESSION['username'] = $user['username'];

        return true;
    }
    /**
     * @return array
     */
    function getSession()
    {
        return [
            'connected' => !empty($_SESSION['status']) ? $_SESSION['status'] : null,
            'username'  => !empty($_SESSION['username']) ? $_SESSION['username'] : null,
        ];
    }

    /**
     * @return bool
     */
    function isConnected()
    {
        if (!empty($_SESSION['status']) && $_SESSION['status'] == 'connected') {
            return true;
        } else {
            return false;
        }
    }
}