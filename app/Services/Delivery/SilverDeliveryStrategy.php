<?php

declare(strict_types=1);

namespace App\Services\Delivery;

use App\Constants;

class SilverDeliveryStrategy implements DeliveryStrategyInterface
{
    public function calculate(): float
    {
        return Constants::SLIVER_DELIVERY_AMOUNT;
    }
}
