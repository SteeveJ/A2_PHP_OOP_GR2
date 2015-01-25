<?php
require __DIR__.'/_header.php';
if(empty($_SESSION['status']) && $_SESSION['status'] == 'connected'){
    header('Location: index.php');
}
else{
    /** @var \Doctrine\ORM\EntityRepository $pokemonRepository */
    $pokemonRepository = $em->getRepository('SteeveJ\PokemonBattle\Model\PokemonModel');
    /** @var SteeveJ\PokemonBattle\Model\PokemonModel $pokemonPlayer */
    $pokemonPlayer = $pokemonRepository->findOneBy([
        'trainer_id' => $_SESSION['Id'],
    ]);
    $pokemonPlayer->setHP(100);
    $em->flush();
    if($pokemonPlayer->getHP() == 100){
        header('Location: index.php');
    }

}