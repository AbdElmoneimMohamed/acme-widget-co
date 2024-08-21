<?php

declare(strict_types=1);

namespace App\Services\Delivery;

use App\Constants;

class GoldDeliveryStrategy implements DeliveryStrategyInterface
{
    public function calculate(): float
    {
        return Constants::GOLD_DELIVERY_AMOUNT;
    }
}
