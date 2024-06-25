<?php

namespace App\Http\Services;

use App\Interfaces\OrderServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class OrderSvc implements OrderServiceInterface{

    /**
     * @param $data
     * @return mixed|void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendOrder($data){

        try {
            $client = new Client();
            $response = $client->post(env('ORDER_SERVICE'), [
                'json' => $data,
            ]);
            log::info(json_decode($response->getBody()->getContents(), true));
        } catch (RequestException $e) {
            log::error($e->getMessage());
        }

    }

}
