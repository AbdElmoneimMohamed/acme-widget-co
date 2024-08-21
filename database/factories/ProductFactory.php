<?php

namespace Database\Factories;

use App\Constants;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->randomElement([Constants::RED_WIDGET_CODE, Constants::GREEN_WIDGET_CODE, Constants::BLUE_WIDGET_CODE]),
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 7.95, 32.95),
        ];
    }
}
