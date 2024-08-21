<?php

declare(strict_types=1);

namespace App\Services\Offer;

use App\Models\Product;

class OfferContext
{
    protected OfferStrategyInterface $strategy;

    public function setOffer(OfferStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * @param array<Product> $products
     */
    public function applyOffer(array $products, float $total): float
    {
        return $this->strategy->apply($products, $total);
    }
}
