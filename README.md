# TFTroll
Simple application using Riot Games API for game mode TFT.

## Requirements
- PHP 7 or later (Plugin CURL enable);
- Composer;
- Riot Games API Key (Get your **[API Key](https://developer.riotgames.com/)**).

## Getting start
This project is using 
`Summoner-V4` for get information from summoner`League-V4` for get information TFT queue from Summoner 
and `Data Dragon` for get assets.

### How to run
1. Clone this repository
2. Run `composer install` into project folder
3. Edit `.env.example` for `.env` (if you want use a environment variable)
4. Run `php -S localhost:3000`

### How to works
In index have a simple form, where send the `region` and `user` via **GET**.
