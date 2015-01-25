<?php

require __DIR__.'/_header.php';
$panel = false;


if(!empty($_SESSION['status'])){
    $panel =true;
    echo $twig->render('homePage.html.twig', [
        'username' => $_SESSION['username'],
        'panel' => $panel,
    ]);
    /** @var \Doctrine\ORM\EntityRepository $pokemonRepository */
    $pokemonRepository = $em->getRepository('SteeveJ\PokemonBattle\Model\PokemonModel');
    /** @var SteeveJ\PokemonBattle\Model\PokemonModel $pokemonPlayer */
    $pokemonPlayer = $pokemonRepository->findOneBy([
        'trainer_id' => $_SESSION['Id'],
    ]);
    echo '<div class="container">
                <p>Nom de votre Pokemon : '.$pokemonPlayer->getName().'</p>
                <p>Health : '.$pokemonPlayer->getHP().'</p>
                <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$pokemonPlayer->getHP().'" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                  <span class="sr-only">40% Complete (success)</span>
                  </div>
                </div>
            </div>';
}else{
    echo $twig->render('homePage.html.twig',[
        'panel' => $panel,
    ]);
}
