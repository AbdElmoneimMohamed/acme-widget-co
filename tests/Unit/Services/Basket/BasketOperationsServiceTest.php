<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Basket;

use App\Constants;
use App\Repositories\ProductRepository;
use App\Services\Basket\ApplyOfferService;
use App\Services\Basket\BasketOperationsService;
use App\Services\Delivery\CalculateDeliveryService;
use App\Services\Offer\OfferContext;
use Tests\TestCase;

class BasketOperationsServiceTest extends TestCase
{
    protected BasketOperationsService $basket;

    protected function setUp(): void
    {
        parent::setUp();

        $productRepository = new ProductRepository();
        $deliveryStrategy = new CalculateDeliveryService();
        $offerStrategy = new ApplyOfferService(new OfferContext());

        $this->basket = new BasketOperationsService($productRepository, $deliveryStrategy, $offerStrategy);
    }

    public function testBasketCalculateTotalWithoutAnyOffer(): void
    {
        $this->basket->addProduct(Constants::BLUE_WIDGET_CODE);

        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);

        $this->assertEquals(37.85, $this->basket->calculateTotal());
    }

    public function testBasketCalculateTotalWithRedWidgetOffer(): void
    {
        $this->basket->addProduct(Constants::RED_WIDGET_CODE);
        $this->basket->addProduct(Constants::RED_WIDGET_CODE);

        $this->assertEquals(54.37, $this->basket->calculateTotal(Constants::RED_WIDGET_OFFER));
    }

    public function testBasketCalculateTotalWithGreenWidgetOffer(): void
    {
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);

        $this->assertEquals(54.85, $this->basket->calculateTotal(Constants::GREEN_WIDGET_OFFER));
    }

    public function testBasketCalculateTotalWithInvalidOffer(): void
    {
        $this->basket->addProduct(Constants::RED_WIDGET_CODE);

        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);

        $this->assertEquals(60.85, $this->basket->calculateTotal(5));
    }

    public function testApplyRedWidgetOfferOnJustTwoWidgetIfIChooseThreeWidgits(): void
    {
        $this->basket->addProduct(Constants::BLUE_WIDGET_CODE);
        $this->basket->addProduct(Constants::BLUE_WIDGET_CODE);

        $this->basket->addProduct(Constants::RED_WIDGET_CODE);
        $this->basket->addProduct(Constants::RED_WIDGET_CODE);
        $this->basket->addProduct(Constants::RED_WIDGET_CODE);

        $this->assertEquals(98.27, $this->basket->calculateTotal(Constants::RED_WIDGET_OFFER));
    }

    public function testApplyJustRedWidgetOfferEvenIHaveGreenWidgetOffer(): void
    {
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);

        $this->basket->addProduct(Constants::RED_WIDGET_CODE);
        $this->basket->addProduct(Constants::RED_WIDGET_CODE);

        $this->assertEquals(124.27, $this->basket->calculateTotal(Constants::RED_WIDGET_OFFER));
    }

    public function testApplyJustGreenWidgetOfferEvenIHaveRedWidgetOffer(): void
    {
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);
        $this->basket->addProduct(Constants::GREEN_WIDGET_CODE);

        $this->basket->addProduct(Constants::RED_WIDGET_CODE);
        $this->basket->addProduct(Constants::RED_WIDGET_CODE);

        $this->assertEquals(115.8, $this->basket->calculateTotal(Constants::GREEN_WIDGET_OFFER));
    }
}
