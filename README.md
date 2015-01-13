# A2 - PHP OOP

## Instructions

* Date: Sunday 18th January by 23:59 (I want u to take ur time to understand REALLY what ur doing)
* Create your own repository on GitHub => https://github.com/YourUsername/A2_PHP_OOP_GR1
* Send me an email (thibaud.bardin+iim[at]gmail[dot]com) with A2_PHP_OOP_GR1_FIRSTNAME_LASTNAME as Subject and the url of ur repository as Content

## Entities

### Trainer (use the interface after)

* Id
* Username
* Password (in plain text)

```php
<?php

//namespace PseudoGithub\PokemonBattle\Model;

interface TrainerInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $username
     *
     * @return TrainerInterface
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param string $password
     *
     * @return TrainerInterface
     */
    public function setPassword($password);
}
```

### Pokemon (use the interface after)

* Id
* Name
* HP (Health Point)
* Type (create as many constants in your class as types existing)
* RELATION @OneToOne on Trainer entity

```php
<?php

//namespace PseudoGithub\PokemonBattle\Model;

interface PokemonInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return PokemonInterface
     */
    public function setName($name);

    /**
     * @return int
     */
    public function getHP();

    /**
     * @param int $hp
     *
     * @return PokemonInterface
     */
    public function setHP($hp);

    /**
     * @param int $hp
     *
     * @return int
     */
    public function addHP($hp);

    /**
     * @param int $hp
     *
     * @return int
     */
    public function removeHP($hp);

    /**
     * @return int
     */
    public function getType();

    /**
     * @param int $type
     *
     * @return PokemonInterface
     */
    public function setType($type);
}
```

## Pokemon Battle OOP

* A non logged user can sign up (create a "Trainer")
* A non logged user can sign in
* A logged "Trainer" can create 1 Pokemon maximum
* A Pokemon can have 3 types (Fire, Plant, Water), start with 100 HP
* When I'm logged, my pokemon can attack another "Trainer" (maximum one attack per 6 hours)
* When my pokemon attacks a "Trainer", I have to retrieve the other pokemon and remove HP to him (from 10 to 20)
* Test pokemon's type, eg. if a "fire pokemon" attacks a "plant pokemon", u have to multiply attack by 1.5 (from 15 to 30)
* Test pokemon's type, eg. if a "fire pokemon" attacks a "water pokemon", u have to divide attack by 2 (from 5 to 10)
* If a pokemon died, give the "Trainer" a button to resuscitate the pokemon (add 100 HP), maximum 1 resuscitate per day

## Technology

### PHP OOP [MANDATORY]

* Usage of namespaces
* Usage of classes
* Use the interfaces situated in the "example" directory

### Doctrine ORM [MANDATORY]

* Use Doctrine ORM (implicit Doctrine DBAL too)

### Twig [NOT MANDATORY]

* Use Twig as template engine (bonus points)

## Questions

* For all questions, u have to open an issue on the github repository

## Resources

* [OOP](http://openclassrooms.com/courses/programmez-en-oriente-objet-en-php)
* [Twig Documentation](http://twig.sensiolabs.org/documentation)
