<?php

namespace App\Repositories\mysql;
use App\Exceptions\CustomErrorException;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderRepository implements OrderRepositoryInterface
{

    /**
     * @param $request
     * @return Order|mixed
     * @throws CustomErrorException
     */
    public function createOrder($request)
    {
        try {
            $req = $request->all();

            $order = new Order();
            $order->customer_name = $req['customer_name'];
            $order->order_value = $req['order_value'];
            $order->process_id = mt_rand(1, 10);
            $order->status = config('constants.PROCESSING');
            $order->save();

            return $order;

        } catch (\Exception $e) {
            log::error($e->getMessage());
            throw new CustomErrorException($e);
        }
    }

    /**
     * @param $orderId
     * @return mixed
     * @throws CustomErrorException
     */
    public function getOrderById($orderId)
    {
        try {
            return Order::find($orderId);
        } catch (\Exception $e) {
            log::error($e->getMessage());
            throw new CustomErrorException($e);
        }
    }

}
