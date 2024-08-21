<?php

declare(strict_types=1);

namespace App\Services\Offer;

use App\Models\Product;

interface OfferStrategyInterface
{
    /**
     * @param array<Product> $products
     */
    public function apply(array $products, float $total): float;
}
