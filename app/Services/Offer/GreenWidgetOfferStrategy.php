<?php

declare(strict_types=1);

namespace App\Services\Offer;

use App\Constants;
use App\Models\Product;

class GreenWidgetOfferStrategy implements OfferStrategyInterface
{
    /**
     * buy 2 green widgets, get the third for free.
     *
     * @param array<Product> $products
     */
    public function apply(array $products, float $total): float
    {
        $greenWidgets = array_filter($products, fn ($product) => $product->code === Constants::GREEN_WIDGET_CODE);

        foreach ($greenWidgets as $key => $widget) {
            if ($key % 3 === 1) {
                $total -= $widget->price;
            }
        }

        return $total;
    }
}
