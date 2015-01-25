<?php
require __DIR__.'/vendor/autoload.php';



/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__ . "/bootstrap.php";

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem([
    __DIR__ .'\src\Resources\views',
]);

$twig = new Twig_Environment($loader,[
    // 'cache' => null
    'debug' => true,
]);
$twig->addExtension(new Twig_Extension_Debug());
session_start();