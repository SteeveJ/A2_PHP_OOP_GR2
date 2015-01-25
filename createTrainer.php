<?php

require __DIR__.'/_header.php';
use SteeveJ\PokemonBattle\Model\TrainerModel;
use SteeveJ\PokemonBattle\Model\PokemonModel;

if(!empty($_SESSION['status']) && $_SESSION['status'] == 'connected'){
    header('Location: index.php');
}
if(!empty($_POST['username'])){
    /** @var \Doctrine\ORM\EntityRepository $trainerRepository */
    $trainerRepository = $em->getRepository('SteeveJ\PokemonBattle\Model\TrainerModel');
    $trainers = $trainerRepository->findAll();
    $usernameError = false;
    foreach($trainers as $trainer){
        if($trainer->getUserName() == $_POST['username']){
            $usernameError = true;
            break;
        }
    }
    if($usernameError == true){
        echo $twig->render('createT.html.twig', [
            'usernameError'=>$usernameError,
        ]);
    }
    if(!empty($_POST['password']) && !empty($_POST['passwordVerification']) && $usernameError == false){
        if($_POST['password'] == $_POST['passwordVerification']){

            $trainer = new TrainerModel();

            $trainer->setUserName($_POST['username'])
                    ->setPassword($_POST['password'])
                    ->setLatestBattleAt(new \DateTime());
            $trainer->setNbBattle(0);
            $em->persist($trainer);
            $em->flush();
            echo $idTrainer = $trainer->getId();
            if($_POST['pokemon'] == 'Salamèche'){
                $pokemon = new PokemonModel();
                $pokemon->setType(PokemonModel::TYPE_FIRE)
                        ->setHP(100)
                        ->setName('Salamèche')
                        ->setTrainerId($trainer);

            }
            if($_POST['pokemon'] == 'Carapuce'){
                $pokemon = new PokemonModel();
                $pokemon->setType(PokemonModel::TYPE_WATER)
                    ->setHP(100)
                    ->setName('Carapuce')
                    ->setTrainerId($trainer);
            }
            if($_POST['pokemon'] == 'Bulbizarre'){
                $pokemon = new PokemonModel();
                $pokemon->setType(PokemonModel::TYPE_PLANT)
                    ->setHP(100)
                    ->setName('Bulbizarre')
                    ->setTrainerId($trainer);
            }
            $em->persist($pokemon);
            $em->flush();
            $_SESSION['Id'] = $trainer->getId();
            $_SESSION['username'] = $trainer->getUserName();
            $_SESSION['status'] = 'connected';
            if(!empty($_SESSION['Id']) && !empty($_SESSION['username']))
            {
                header('Location: index.php');
            }
        }else{
            $passwordError = true;
            echo $twig->render('createT.html.twig', [
                'passwordError'=>$passwordError,
            ]);
        }

    }
}
if(empty($_POST['username']) && empty($_POST['password'])){
    echo $twig->render('createT.html.twig');
}
