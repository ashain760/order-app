<?php

namespace App\Http\Controllers;

use App\Facade\Orders\OrderFacade;
use App\Http\Requests\OrderRequestCreate;
use App\Jobs\SendOrderJob;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;

    /**
     * @param Request $request
     * @param OrderRequestCreate $orderRequestCreate
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, OrderRequestCreate $orderRequestCreate){

        // create new order
        $res = OrderFacade::createOrder($request);
        $response = [
            'order_id' => str_pad($res->id, 4, '0', STR_PAD_LEFT),
            'process_id' => $res->process_id,
            'status' => $res->status,
        ];

        // send order details to https://wibip.free.beeceptor.com/order Queue
        SendOrderJob::dispatch($res->id);

        return $this->response("Order details successfully added.", 201, $response);
    }
}
