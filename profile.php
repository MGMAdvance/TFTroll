<?php
require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/classes/lol.class.php";

// Set template
$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);

$region = isset($_GET['region']) ? $_GET['region'] : '0';
$user = isset($_GET['user']) ? $_GET['user'] : 'relyt OFWGKTA';

// Get a API KEY fron .env
try{
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
}catch(Exception $e){
    
}

$API_KEY = getenv('API_KEY');

// Prepare data
$lol = new ranked($API_KEY);
$lol->getSummonerDTO($region, $user);
$lol->getSummonerLeagues();
$data = $lol->getSummonerTftData();
$data['icon'] = $lol->getSummonerIcon();

echo $twig->render('search.twig', $data);
