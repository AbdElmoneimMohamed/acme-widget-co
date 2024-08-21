<?php

declare(strict_types=1);

namespace App\Services\Delivery;

interface DeliveryStrategyInterface
{
    public function calculate(): float;
}
