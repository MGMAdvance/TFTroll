<?php
require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/classes/lol.class.php";

// Get a API KEY fron .env
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader, [
    'cache' => '/cache',
]);

$data = ['icon'   => '3148',
         'name'   => 'Rock',
         'league' => 'bronze',
         'points' => '18'];

echo $twig->render('index.twig', $data);

// $API_KEY = getenv('API_KEY');

// $lol = new ranked();
// $lol->setApiKey($API_KEY);
// $lol->getSummonerIdByName('ROCK');