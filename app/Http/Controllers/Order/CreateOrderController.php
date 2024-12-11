<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use ddd\core\Order\Application\Create\CreateOrderRequest;
use ddd\core\Order\Application\Create\CreateOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CreateOrderController extends Controller
{
    private readonly CreateOrder $createOrder;

    public function __construct()
    {
        $this->createOrder = new CreateOrder();
    }

    public function __invoke(): JsonResponse
    {

        try {


            $request = $this->randomOrderRequest();

            $this->createOrder->__invoke($request);

           return response()->json('Order created successfully');

        } catch (\Throwable $th) {
            Log::error('CreateOrderController: ' . $th->getMessage());
            return response()->json('Error while creating order');
        }

    }


    private function randomOrderRequest(): CreateOrderRequest
    {

        $lines = [];

        for ($i = 0; $i < 3; $i++) {
            $lines[] = [
                'name' => 'Product ' . $i,
                'quantity' => rand(1, 10),
                'price' => rand(1, 100)
            ];
        }

        return new CreateOrderRequest(
            rand(1, 1000),
            $lines
        );
    }
}
