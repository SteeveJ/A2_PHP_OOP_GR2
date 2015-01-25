<?php

namespace SteeveJ\PokemonBattle\Model;
use DateTime;
/**
 * Class PokemonModel
 * @package SteeveJ\PokemonBattle\Model
 *
 * @Entity
 * @Table(name="pokemon")
 */
class PokemonModel implements PokemonInterface
{
    /**
     * @var int
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(name="id", type="integer")
     */
    private $Id;

    /**
     * @var TrainerModel
     * @ManyToOne(targetEntity="TrainerModel")
     * @JoinColumn(name="trainer_id", referencedColumnName="id")
     */
    private $trainer_id;


    /**
     * @var string
     * @Column(name="name", type="string", length=40)
     */
    private $name;

    /**
     * @var int
     * @Column(name="hp", type="integer")
     */
    private $hp;

    /**
     * @var int
     * @Column(name="type", type="smallint", length=1)
     */
    private $type;


    const TYPE_FIRE     = 0;
    const TYPE_WATER    = 1;
    const TYPE_PLANT    = 2;






    /**
     * @return TrainerModel
     */
    public function getTrainerId()
    {
        return $this->trainer_id;
    }

    /**
     * @param TrainerModel $trainer_id
     */
    public function setTrainerId($trainer_id)
    {
        $this->trainer_id = $trainer_id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setName($name)
    {
        if (is_string($name))
            $this->name = $name;
        else
            throw new \Exception('Name => string');

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getHP()
    {
        return $this->hp;
    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setHP($hp)
    {
        if (is_int($hp) && $hp > 0)
            $this->hp = $hp;
        else
            throw new \Exception('HP => int && > 0');

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function addHP($hp)
    {
        if (is_int($hp) && $hp > 0)
            $this->hp += $hp;
        else
            throw new \Exception('HP => int && > 0');

        return $this->hp;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function removeHP($hp)
    {
        if (is_int($hp) && $hp > 0)
            $this->hp = ($this->hp <= $hp) ? 0 : $this->hp - $hp;
        else
            throw new \Exception('HP => int && > 0');

        return $this->hp;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setType($type)
    {
        if (true === in_array($type, [
            self::TYPE_FIRE,
            self::TYPE_WATER,
            self::TYPE_PLANT,
        ]))
            $this->type = $type;
        else
            throw new \Exception('Type => Bad');

        return $this;
    }

    /**
     * @param $type
     * @param $myType
     * @return bool
     */
    public function isTypeWeak($type, $myType){
        $request = false;
        if(self::TYPE_FIRE === $myType){
            if(self::TYPE_WATER === $type){
                $request = true;
            }
        }
        if(self::TYPE_WATER === $myType){
            if(self::TYPE_PLANT === $type){
                $request = true;
            }
        }
        if(self::TYPE_PLANT === $myType){
            if(self::TYPE_FIRE === $type){
                $request = true;
            }
        }
        return $request;
    }

    /**
     * @param $type
     * @param $myType
     * @return bool
     */
    public function isTypeStrong($type, $myType){
        $request = false;
        if(self::TYPE_FIRE === $myType){
            if(self::TYPE_PLANT === $type){
                $request = true;
            }
        }
        if(self::TYPE_WATER === $myType){
            if(self::TYPE_FIRE === $type){
                $request = true;
            }
        }
        if(self::TYPE_PLANT === $myType){
            if(self::TYPE_WATER === $type){
                $request = true;
            }
        }
        return $request;
    }
}