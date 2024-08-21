<?php

declare(strict_types=1);

namespace App\Services\Delivery;

class DeliveryContext
{
    protected DeliveryStrategyInterface $strategy;

    public function setDelivery(DeliveryStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function calculateDelivery(): float
    {
        return $this->strategy->calculate();
    }
}
