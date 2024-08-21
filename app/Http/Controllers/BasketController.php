<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\Basket\BasketOperationsService;
use Illuminate\Http\JsonResponse;
use Webmozart\Assert\Assert;

final class BasketController extends Controller
{
    public function __construct(
        private readonly BasketOperationsService $basketOperationService
    ) {
    }

    public function addProduct(ProductRequest $request): JsonResponse
    {
        $code = $request->validated(['product_code']);

        Assert::string($code);

        $this->basketOperationService->addProduct($code);

        return response()->json([
            'message' => 'Product added to basket',
        ]);
    }

    public function getTotal(): JsonResponse
    {
        $total = $this->basketOperationService->calculateTotal();

        return response()->json([
            'total' => $total,
        ]);
    }
}
