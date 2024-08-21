<?php

declare(strict_types=1);

namespace App\Services\Delivery;

use App\Constants;

final readonly class CalculateDeliveryService
{
    public function __construct(
        private DeliveryContext $deliveryContext
    ) {
    }

    public function __invoke(float $total): float
    {
        if ($total >= Constants::MAX_TOTAL_FOR_FREE_DELIVERY) {
            return Constants::FREE_DELIVERY_AMOUNT;
        }

        if ($total >= Constants::MAX_TOTAL_FOR_GOLD_DELIVERY) {
            $this->deliveryContext->setDelivery(new GoldDeliveryStrategy());
        } else {
            $this->deliveryContext->setDelivery(new SilverDeliveryStrategy());
        }

        return $this->deliveryContext->calculateDelivery();
    }
}
