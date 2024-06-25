<?php
namespace App\Facade\Orders;

use App\Interfaces\OrderServiceInterface;
use App\Repositories\mysql\OrderRepository;

class Order{

    private $orderRepository;
    private $orderServiceInterface;

    /**
     * Order constructor.
     * @param OrderRepository $orderRepository
     * @param OrderServiceInterface $orderServiceInterface
     */
    public function __construct(
        OrderRepository $orderRepository,
        OrderServiceInterface $orderServiceInterface
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderServiceInterface = $orderServiceInterface;
    }

    /**
     * @param $request
     * @return \App\Models\Order
     * @throws \App\Exceptions\CustomErrorException
     */
    public function createOrder($request){
        return $this->orderRepository->createOrder($request);
    }

    /**
     * @param $orderId
     * @return mixed
     * @throws \App\Exceptions\CustomErrorException
     */
    public function sendOrder($orderId){

        $res = $this->orderRepository->getOrderById($orderId);
        $data = [
            "Order_ID" => str_pad($res->id, 4, '0', STR_PAD_LEFT),
            "Customer_Name" => $res->customer_name,
            "Order_Value" => $res->order_value,
            "Order_Date" => $res->created_at->format("Y-m-d"),
            "Order_Status" => $res->status,
            "Process_ID" => $res->process_id
        ];

        return $this->orderServiceInterface->sendOrder($data);
    }
}
