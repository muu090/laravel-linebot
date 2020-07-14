<?php

namespace App\Services;

use GuzzleHttp\Client;

class Gurunavi
{
    private const RESTAURANTS_SEARCH_API_URL = 'https://api.gnavi.co.jp/RestSearchAPI/v3/';

    public function searchRestaurants(string $word): array
     # ユーザから送られてくる$wordは文字列（string）であると宣言
     # searchRestaurantsメソッドの戻り値が配列（array）であると宣言
    {
        $client = new Client();
        $response = $client
            ->get(self::RESTAURANTS_SEARCH_API_URL, [
                'query' => [
                    'keyid' => env('GURUNAVI_ACCESS_KEY'),
                    'freeword' => str_replace(' ', ',', $word), # str_replace関数で半角スペースがあればカンマ（,）に変換
                ],
                'http_errors' => false,
            ]);
            
        return json_decode($response->getBody()->getContents(), true);
    }
}