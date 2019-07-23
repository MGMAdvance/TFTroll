<?php
require_once "vendor/autoload.php";
require_once "classes/lol.class.php";

// Get a API KEY fron .env
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$API_KEY = getenv('API_KEY');

$lol = new ranked($API_KEY);
$lol->getSummonerIdByName('oi');