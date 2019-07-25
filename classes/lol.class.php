<?php

class ranked {

    public $summonerDTO; // Basic informations
    public $leagues;
    public $summonerRegion;

    public $RegionID;
    public $API_KEY;
    const REGIONS = [
        0 => "br1.api.riotgames.com",
        1 => "eun1.api.riotgames.com",
        2 => "euw1.api.riotgames.com",
        3 => "jp1.api.riotgames.com",
        4 => "kr.api.riotgames.com",
        5 => "la1.api.riotgames.com",
        6 => "la2.api.riotgames.com",
        7 => "na1.api.riotgames.com",
        8 => "oc1.api.riotgames.com",
        9 => "tr1.api.riotgames.com",
        10 => "ru.api.riotgames.com",
        11 => "pbe1.api.riotgames.com"
    ];
    const ENDPOINTS = [
        "GetLeaguesSummoner" => "/lol/league/v4/entries/by-summoner/",
        "GetSummonerIdByName" => "/lol/summoner/v4/summoners/by-name/"
    ];

    /**
     * Instantiate object with API KEY from Riot Games
     *
     * @param [string] $KEY
     */
    public function __construct($KEY){
        $this->API_KEY = $KEY;
    }

    public function getSummonerDTO(int $region, string $name){
        try{
            $this->summonerRegion = $region;
            $name = self::FilterName($name);
            $url = 'https://'.self::REGIONS[$region].self::ENDPOINTS['GetSummonerIdByName'].$name;
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'X-Riot-Token: '.$this->API_KEY,
                'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            if(!$result){ die("Vish!!!"); }
            
            curl_close($curl);

            $this->summonerDTO = json_decode($result, true);

            

        }catch(Exception $e){
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function getSummonerIcon(){
        return $this->summonerDTO['profileIconId'];
    }

    public function getSummonerLeagues(){
        $id = $this->getSummonerId();
        $region = $this->summonerRegion;
        try{
            $url = 'https://'.self::REGIONS[$region].self::ENDPOINTS['GetLeaguesSummoner'].$id;
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'X-Riot-Token: '.$this->API_KEY,
                'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            if(!$result){ die("Problema para capturar as ligas! :/"); }
            
            curl_close($curl);

            $this->leagues = json_decode($result, true); 

        }catch(Exception $e){
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function getSummonerTftData(){
        for ($i=0; $i < count($this->leagues); $i++) { 
            for ($t=0; $t < 4; $t++) {
                if($this->leagues[$i]['queueType'] == "RANKED_TFT"){
                    $index = $i;
                }
            }
        }
        
        return $this->leagues[$index];
    }

    public function getSummonerName(){
        return $this->summonerDTO['name'];
    }

    public function getSummonerId(){
        return $this->summonerDTO['id'];
    }

    /**
     * Filter the summoner name to URL format
     *
     * @param string $name
     * @return void
     */
    public static function FilterName(string $name){
        return rawurlencode(htmlentities($name));
    }

}
