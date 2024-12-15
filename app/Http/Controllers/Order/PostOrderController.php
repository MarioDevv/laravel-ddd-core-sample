<?php

namespace App\Http\Controllers\Order;

use App\Doctrine\Repository\Order\DoctrineOrderRepository;
use App\Http\Controllers\Controller;
use ddd\core\Order\Application\Create\CreateOrderRequest;
use ddd\core\Order\Application\Create\CreateOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PostOrderController extends Controller
{
    private readonly CreateOrder $createOrder;

    public function __construct()
    {
        $this->createOrder = new CreateOrder(App::make(DoctrineOrderRepository::class));
    }

    public function __invoke(): JsonResponse
    {

        try {

            $request = $this->randomOrderRequest();

            $response = $this->createOrder->__invoke($request);

           return response()->json([
               'message' => 'Order created',
               'order' => $response->json()
           ], 201);

        } catch (\Throwable $th) {
            Log::error('PostOrderController: ' . $th->getMessage());
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
                'price' => rand(500, 10000)
            ];
        }

        return new CreateOrderRequest(
            rand(1, 1000),
            $lines
        );
    }
}
