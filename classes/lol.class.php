<?php

class ranked {

    public $summonerID;
    public $RegionID;
    public $API_KEY;
    const REGIONS = [
        0 => "br1.api.riotgames.com"
    ];
    const ENDPOINTS = [
        "GetLeaguesSummoner" => "/lol/league/v4/entries/by-summoner/",
        "GetSummonerIdByName" => "/lol/summoner/v4/summoners/by-name/"
    ];

    public function _construct(){}

    public function setApiKey($KEY){
        $this->API_KEY = $KEY;
    }

    public function getSummonerIdByName($name){
        echo $name;
        echo $this->API_KEY;
    }

    public function getSummonerIcon($icon){

    }

    public function getSummonerEloTFT($summonerID){

    }

    public function teste(){
        echo self::REGIONS[0];
    }

}
