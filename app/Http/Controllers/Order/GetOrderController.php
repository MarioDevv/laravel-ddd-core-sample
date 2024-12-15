<?php

namespace App\Http\Controllers\Order;

use App\Doctrine\Repository\Order\DoctrineOrderRepository;
use ddd\core\Order\Application\Find\FindOrder;
use ddd\core\Order\Application\Find\FindOrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class GetOrderController
{
    private readonly FindOrder $findOrder;

    public function __construct()
    {
        $this->findOrder = new FindOrder(App::make(DoctrineOrderRepository::class));
    }

    public function __invoke(Request $request): JsonResponse
    {

        try {


            if (!$request->id) {
                return response()->json('Id is required', 400);
            }

            $request = new FindOrderRequest(id: (int) $request->id);

            $response = $this->findOrder->__invoke($request);

            return response()->json([
                'message' => 'Order returned successfully',
                'order' => $response->json()
            ], 201);

        } catch (\Throwable $th) {
            Log::error('GetOrderController: ' . $th->getMessage());
            return response()->json('Error while returning order');
        }

    }
}
