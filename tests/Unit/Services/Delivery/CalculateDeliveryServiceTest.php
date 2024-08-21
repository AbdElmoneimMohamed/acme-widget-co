<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Delivery;

use App\Services\Delivery\CalculateDeliveryService;
use Tests\TestCase;

class CalculateDeliveryServiceTest extends TestCase
{
    protected CalculateDeliveryService $deliveryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->deliveryService = new CalculateDeliveryService();
    }

    public function testDeliveryIsFreeForTotalAboveOrEqualTo90(): void
    {
        $this->assertEquals(0, ($this->deliveryService)(90.00));
        $this->assertEquals(0, ($this->deliveryService)(100.00));
    }

    public function testDeliveryIs295ForTotalBetween50And90(): void
    {
        $this->assertEquals(2.95, ($this->deliveryService)(50.00));
        $this->assertEquals(2.95, ($this->deliveryService)(89.99));
    }

    public function testDeliveryIs495ForTotalBelow50(): void
    {
        $this->assertEquals(4.95, ($this->deliveryService)(0.00));
        $this->assertEquals(4.95, ($this->deliveryService)(49.99));
    }

    public function testDeliveryIs295ForTotalExactly50(): void
    {
        $this->assertEquals(2.95, ($this->deliveryService)(50.00));
    }

    public function testDeliveryIsFreeForTotalExactly90(): void
    {
        $this->assertEquals(0, ($this->deliveryService)(90.00));
    }

    public function testDeliveryForNegativeTotals(): void
    {
        $this->assertEquals(4.95, ($this->deliveryService)(-10.00));
    }

    public function testDeliveryForVeryHighTotals(): void
    {
        $this->assertEquals(0, ($this->deliveryService)(1000.00));
    }
}
