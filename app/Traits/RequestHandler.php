<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait RequestHandler
{

    private $APIKey = 'd7097d0a-48c7-49fa-b526-f7d6274cf863';

    function fectCoinsCurrentPrices($limit = 50){
        $api_key = $this->APIKey;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-CMC_PRO_API_KEY' => $api_key,
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [ 
            'start' => '1',
            'limit' => $limit,
            'convert' => 'USD',
        ]);

        $decoded_response = json_decode($response, true);

        return $decoded_response;
    }

    function fectCoinsCurrentLogo($coin){
        $api_key = $this->APIKey;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-CMC_PRO_API_KEY' => $api_key,
        ])->get('https://pro-api.coinmarketcap.com/v2/cryptocurrency/info', [
            'symbol' => $coin,
        ]);

        $decoded_response = json_decode($response, true);

        return $decoded_response;
    }

    function fectSingleCoinsCurrentPrices($coin){
        $api_key = $this->APIKey;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-CMC_PRO_API_KEY' => $api_key,
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest', [ 
            'symbol' => $coin,
           
        ]);

        $decoded_response = json_decode($response, true);

        return $decoded_response;
    }

}
