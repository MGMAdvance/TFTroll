<?php
require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/classes/lol.class.php";

$region = isset($_GET['region']) ? $_GET['region'] : '';
$user = isset($_GET['q']) ? $_GET['q'] : '';

// Get a API KEY fron .env
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$API_KEY = getenv('API_KEY');

$lol = new ranked($API_KEY);
//$lol->setApiKey($API_KEY);
$lol->getSummonerDTO(0, 'relyt OFWGKTA');
$lol->getSummonerLeagues();
var_dump($lol->getSummonerTftData());

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);

$data = ['icon'   => '3148',
         'name'   => 'Rock',
         'league' => 'bronze',
         'points' => '18'];

echo $twig->render('index.twig', $data);