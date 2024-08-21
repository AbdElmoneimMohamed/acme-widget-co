<?php

declare(strict_types=1);

namespace App\Services\Offer;

use App\Constants;
use App\Models\Product;

class RedWidgetOfferStrategy implements OfferStrategyInterface
{
    /**
     * buy one red widget, get the second half price.
     *
     * @param array<Product> $products
     */
    public function apply(array $products, float $total): float
    {
        $redWidgets = array_filter($products, fn ($product) => $product->code === Constants::RED_WIDGET_CODE);

        foreach ($redWidgets as $key => $widget) {
            if ($key % 2 === 1) {
                $total -= $widget->price / 2;
            }
        }

        return $total;
    }
}
