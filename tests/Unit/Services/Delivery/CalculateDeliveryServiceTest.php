<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Delivery;

use App\Constants;
use App\Services\Delivery\CalculateDeliveryService;
use App\Services\Delivery\DeliveryContext;
use Tests\TestCase;

class CalculateDeliveryServiceTest extends TestCase
{
    protected CalculateDeliveryService $deliveryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->deliveryService = new CalculateDeliveryService(new DeliveryContext());
    }

    public function testDeliveryIsFreeForTotalAboveOrEqualTo90(): void
    {
        $this->assertEquals(Constants::FREE_DELIVERY_AMOUNT, ($this->deliveryService)(90.00));
        $this->assertEquals(Constants::FREE_DELIVERY_AMOUNT, ($this->deliveryService)(100.00));
    }

    public function testDeliveryIs295ForTotalBetween50And90(): void
    {
        $this->assertEquals(Constants::GOLD_DELIVERY_AMOUNT, ($this->deliveryService)(50.00));
        $this->assertEquals(Constants::GOLD_DELIVERY_AMOUNT, ($this->deliveryService)(89.99));
    }

    public function testDeliveryIs495ForTotalBelow50(): void
    {
        $this->assertEquals(Constants::SLIVER_DELIVERY_AMOUNT, ($this->deliveryService)(0.00));
        $this->assertEquals(Constants::SLIVER_DELIVERY_AMOUNT, ($this->deliveryService)(49.99));
    }

    public function testDeliveryIs295ForTotalExactly50(): void
    {
        $this->assertEquals(Constants::GOLD_DELIVERY_AMOUNT, ($this->deliveryService)(50.00));
    }

    public function testDeliveryIsFreeForTotalExactly90(): void
    {
        $this->assertEquals(Constants::FREE_DELIVERY_AMOUNT, ($this->deliveryService)(90.00));
    }

    public function testDeliveryForNegativeTotals(): void
    {
        $this->assertEquals(Constants::SLIVER_DELIVERY_AMOUNT, ($this->deliveryService)(-10.00));
    }

    public function testDeliveryForVeryHighTotals(): void
    {
        $this->assertEquals(Constants::FREE_DELIVERY_AMOUNT, ($this->deliveryService)(1000.00));
    }
}
