<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Constants;
use App\Services\Basket\BasketOperationsService;
use Illuminate\Http\Response;
use Tests\TestCase;

class BasketControllerTest extends TestCase
{
    protected BasketOperationsService $basketOperationsService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->basketOperationsService = $this->createMock(BasketOperationsService::class);
        $this->app->instance(BasketOperationsService::class, $this->basketOperationsService);
    }

    public function testAddValidProductCode(): void
    {
        $this->basketOperationsService
            ->expects($this->once())
            ->method('addProduct')
            ->with(Constants::RED_WIDGET_CODE);

        $response = $this->postJson('/api/basket/add', [
            'product_code' => Constants::RED_WIDGET_CODE,
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'Product added to basket',
            ]);
    }

    public function testAddInvalidProductCode(): void
    {
        $response = $this->postJson('/api/basket/add', [
            'product_code' => 'invalid Code',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The product code is not valid.',
            ]);
    }

    public function testRequiredProductCode(): void
    {
        $response = $this->postJson('/api/basket/add');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The product code is required.',
            ]);
    }

    public function testGetTotal(): void
    {
        $this->basketOperationsService
            ->expects($this->once())
            ->method('calculateTotal')
            ->willReturn(54.37);

        $response = $this->getJson('/api/basket/total');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'total' => 54.37,
            ]);
    }
}
