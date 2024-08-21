<?php

declare(strict_types=1);

namespace App\Services\Delivery;

final readonly class CalculateDeliveryService
{
    public function __invoke(float $total): float
    {
        if ($total >= 90) {
            return 0;
        } elseif ($total >= 50) {
            return 2.95;
        }

        return 4.95;
    }
}
