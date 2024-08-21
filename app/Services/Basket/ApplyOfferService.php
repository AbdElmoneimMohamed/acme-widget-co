<?php

declare(strict_types=1);

namespace App\Services\Basket;

use App\Constants;
use App\Models\Product;
use App\Services\Offer\GreenWidgetOfferStrategy;
use App\Services\Offer\OfferContext;
use App\Services\Offer\RedWidgetOfferStrategy;

final readonly class ApplyOfferService
{
    public function __construct(
        private OfferContext $offerContext
    ) {
    }

    /**
     * @param array<Product> $products
     * @return float
     */
    public function __invoke(int $offer, float $total, array $products)
    {
        if (in_array($offer, [Constants::RED_WIDGET_OFFER, Constants::GREEN_WIDGET_OFFER], true)) {
            match ($offer) {
                Constants::RED_WIDGET_OFFER => $this->offerContext->setOffer(new RedWidgetOfferStrategy()),
                Constants::GREEN_WIDGET_OFFER => $this->offerContext->setOffer(new GreenWidgetOfferStrategy()),
            };

            $total = $this->offerContext->applyOffer($products, $total);
        }

        return $total;
    }
}
