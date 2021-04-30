<?php

namespace app\Library;
use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Coin; 

class ExchangeRate {
    private $url='https://min-api.cryptocompare.com/data/pricemulti';
    private $coins = "" ;
    private $currency = "USDT" ;
    private $token = "" ;
    private $refresh = 10 ;
    private $newData = false;
    private $dbCoins ;
    
    public function __construct() {
        $this->token = env('EXCHANGE_PRICE_TOKEN');
        $this->refresh = env('EXCHANGE_REFRESH');

        $time = Cache::get('exchangeRate');
        if(!$time){
           Cache::put('exchangeRate', Carbon::now());
           $time= Carbon::now()->subSeconds($this->refresh*2);
        }
        $diff = Carbon::now()->diffInSeconds( new Carbon($time));
        $this->newData = $diff > $this->refresh;
    }
 
    public function getSliderCoin() {
        $this->dbCoins = Coin::where('status', true)->where('slider', true)->get();
        return $this->dbCoins;
        if($this->newData){
            $temp = [];
            foreach($this->dbCoins as $coin){
                $temp[] = $coin->name;
            }
            $this->coins = implode($temp,',');
            return $this->refreshData();
        }
        else 
        return $this->dbCoins;
    }
    public function setDataData($data) {
        foreach($this->dbCoins as $coin){
            $coin->price = $data->{$coin->name}->{$this->currency};
            $coin->save();
        }
    }
    public function refreshData() {
        $client = new Client();
        $res = $client->request('GET', $this->url, [
            'query' => [
                'fsyms'   => $this->coins,
                'tsyms'   =>  $this->currency,
                'api_key' => $this->token
            ]
        ]);
        // echo $res->getStatusCode();
        // 200
        // echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        $data = json_decode($res->getBody());
        $this->setDataData($data);
        return $this->dbCoins;
    }
}