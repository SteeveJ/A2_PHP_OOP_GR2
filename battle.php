<?php

require __DIR__.'/_header.php';
if(empty($_SESSION['status']) && $_SESSION['status'] == 'connected'){
    header('Location: index.php');
}
/** @var \Doctrine\ORM\EntityRepository $trainerRepository */
$trainerRepository = $em->getRepository('SteeveJ\PokemonBattle\Model\TrainerModel');

/** @var \Doctrine\ORM\EntityRepository $pokemonRepository */
$pokemonRepository = $em->getRepository('SteeveJ\PokemonBattle\Model\PokemonModel');

$trainers = $trainerRepository->findAll();
/** @var SteeveJ\PokemonBattle\Model\PokemonModel $pokemonPlayer */
$pokemonPlayer = $pokemonRepository->findOneBy([
    'trainer_id' => $_SESSION['Id'],
]);

if(!empty($_GET['id'])){
    // search pokemon Enemy
    /** @var SteeveJ\PokemonBattle\Model\PokemonModel $pokemonEnemy */
    $pokemonEnemy = $pokemonRepository->findOneBy([
        'trainer_id' => $_GET['id'],
    ]);
    // time of day
    $hours = date("H");
    $minutes = date("H");

    $datePlayer = $pokemonPlayer->getTrainerId()->getLatestBattleAt()->format('H');
    $minutesPlayer = $pokemonPlayer->getTrainerId()->getLatestBattleAt()->format('i');

    $nbBattlePlayer = $pokemonPlayer->getTrainerId()->getNbBattle();


    $latestBattlePlayer = (int)$datePlayer;
    $minutesPlayer = (int)$minutesPlayer;
    $hours = (int)$hours;
    $minutes = (int)$minutes;

    if($minutes < 60 && $minutes != 0 && $minutesPlayer && $minutesPlayer !=0){

        if($minutes > $minutesPlayer){
            if($hours > $latestBattlePlayer){
                $jetLag = $hours - $latestBattlePlayer;
                $jetLagPerMinute = $minutes - $minutesPlayer;
                $hoursRemainder = true;
                $minutesRemainder = true;
            }else{
                $jetLag = $latestBattlePlayer - $hours;
                $jetLagPerMinute = $minutes - $minutesPlayer;
                $hoursRemainder = false;
                $minutesRemainder = true;
            }
        }else{
            if($latestBattlePlayer > $hours){
                $jetLag = $latestBattlePlayer - $hours;
                $jetLagPerMinute = $minutesPlayer - $minutes;
                $hoursRemainder = true;
                $minutesRemainder = true;
            }else{
                $jetLag = $hours - $latestBattlePlayer;
                $jetLagPerMinute = $minutesPlayer - $minutes;
                $hoursRemainder = true;
                $minutesRemainder = false;
            }
        }
    }else{
        $jetLag = $hours - $latestBattlePlayer ;
        $hoursRemainder = true;
    }




    if($jetLag > 0 && $jetLag < 7 && $nbBattlePlayer != 0)
    {


        $alertTime = true;
        echo $twig->render('battle.html.twig',[
            'trainers'=> $trainers,
            'idTrainer'=>$_SESSION['Id'],
            'username'=>$_SESSION['username'],
            'alertTime'=>$alertTime,
            'jetLag'=>$jetLag,
            'jetLagPerMinute'=>$jetLagPerMinute,
            'hoursRemainder'=>$hoursRemainder,
            'minutesRemainder'=>$minutesRemainder,
        ]);
    }
    else{

        if($pokemonPlayer->getHP() != 0 && $pokemonEnemy->getHP() != 0){

            echo $twig->render('battle.html.twig',[
                'trainers'=> $trainers,
                'idTrainer'=>$_SESSION['Id'],
                'username'=>$_SESSION['username'],
            ]);
            $striker    = $pokemonPlayer;
            $goal       = $pokemonEnemy;

            /**
             * Parameters
             */
            $roundNumber = 1;
            $matchOver   = false;

            echo '<h1>'.$striker->getName().' VS '.$goal->getName().'</h1>';

            /**
             * Logic
             */
            while (false === $matchOver) {
                echo '<h2>Round n°'.$roundNumber.'</h2>';

                $attackNumber = mt_rand(1, 2);

                for ($i = 0; $i < $attackNumber; $i++) {
                    $attackValue = mt_rand(7, 28);

                    if ($striker->isTypeWeak($goal->getType(), $striker->getType()))
                        $attackValue = ceil($attackValue / 2);

                    if ($striker->isTypeStrong($goal->getType(), $striker->getType()))
                        $attackValue = ceil($attackValue * 1.5);

                    $goal->removeHP((int)$attackValue);

                    echo '<h3>'.$striker->getName().' attacks '.$goal->getName().'. Attack n°'.($i+1).' on '.$attackNumber.'. Dommage : '.$attackValue.' HP removed. '.$goal->getName().' have '.$goal->getHP().'HP left</h3>';

                    if (0 === $goal->getHP()) {
                        $matchOver = true;
                        break;
                    }
                }

                if (false === $matchOver)
                    list($striker, $goal) = [$goal, $striker];

                $roundNumber++;
            }

            echo '<h1>'.$striker->getName().' de '.$striker->getTrainerId()->getUserName().' win!</h1>';
            echo '<h4>'.$striker->getHP().'HP left.</h4>';
            $nbBattlePlayer = $nbBattlePlayer + 1;
            $pokemonPlayer->getTrainerId()->setNbBattle($nbBattlePlayer);
            $pokemonPlayer->getTrainerId()->setLatestBattleAt(new \DateTime());
            $pokemonEnemy->setHP(100);
            $em->flush();

        }
        else{
            $pokemonPlayerTired=false;
            $pokemonEnemyTired=false;
            if($pokemonPlayer->getHP() == 0){
                $pokemonPlayerTired=true;
            }if($pokemonEnemy->getHP() == 0){
                $pokemonEnemyTired=true;
            }

            echo $twig->render('battle.html.twig',[
                'trainers'=> $trainers,
                'idTrainer'=>$_SESSION['Id'],
                'username'=>$_SESSION['username'],
                'playerTired'=>$pokemonPlayerTired,
                'enemyTired'=>$pokemonPlayerTired,
            ]);
        }
    }
}
if(empty($_GET['id'])){
    echo $twig->render('battle.html.twig',[
        'trainers'=> $trainers,
        'idTrainer'=>$_SESSION['Id'],
        'username'=>$_SESSION['username'],
    ]);
}
