<?php

require __DIR__.'/_header.php';

if(!empty($_SESSION['status']) && $_SESSION['status'] == 'connected'){
    header('Location: index.php');
}
if(!empty($_POST["username"]) && !empty($_POST["password"])) {

    /** @var \Doctrine\ORM\EntityRepository $trainerRepository */
    $trainerRepository = $em->getRepository('SteeveJ\PokemonBattle\Model\TrainerModel');

    $trainers = $trainerRepository->findAll();

    foreach($trainers as $trainer){
        if($trainer->getUserName() == $_POST["username"]){
            $_SESSION['Id'] = $trainer->getId();
            $_SESSION['username'] = $trainer->getUserName();
            $_SESSION['status'] = 'connected';
            if(!empty($_SESSION['Id']) && !empty($_SESSION['username']))
            {
                header('Location: index.php');
                break;
            }
        }else{
            throw new Exception('Error');
        }
    }

}
echo $twig->render('login.html.twig');