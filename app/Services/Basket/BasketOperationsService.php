<?php

declare(strict_types=1);

namespace App\Services\Basket;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use App\Services\Delivery\CalculateDeliveryService;

class BasketOperationsService
{
    /**
     * @var array<Product>
     */
    protected array $products = [];

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly CalculateDeliveryService $deliveryService,
        private readonly ApplyOfferService $applyOfferService
    ) {
    }

    public function addProduct(string $productCode): void
    {
        $product = $this->productRepository->getProductByCode($productCode);

        if ($product instanceof Product) {
            $this->products[] = $product;
        }
    }

    public function calculateTotal(int $offer = 0): float
    {
        $total = array_reduce($this->products, fn ($sum, $product) => $sum + $product->price, 0);

        $totalAfterOffer = ($this->applyOfferService)($offer, $total, $this->products);

        $deliveryCost = ($this->deliveryService)($totalAfterOffer);

        return round($totalAfterOffer + $deliveryCost, 2, PHP_ROUND_HALF_DOWN);
    }
}
