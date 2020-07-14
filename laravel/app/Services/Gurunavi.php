<?php

namespace App\Services;

use GuzzleHttp\Client;

class Gurunavi
{
    public function searchRestaurants($word)
    {
        $client = new Client();
        $response = $client
            ->get('https://api.gnavi.co.jp/RestSearchAPI/v3/', [
                'query' => [
                    'keyid' => env('GURUNAVI_ACCESS_KEY'),
                    'freeword' => str_replace(' ', ',', $word), # str_replace関数で半角スペースがあればカンマ（,）に変換
                ],
            ]);
            
        return json_decode($response->getBody()->getContents(), true);
    }
}