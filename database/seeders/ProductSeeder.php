<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->create([
            'code' => 'R01',
            'name' => 'Red Widget',
            'price' => 32.95,
        ]);

        Product::factory()->create([
            'code' => 'G01',
            'name' => 'Green Widget',
            'price' => 24.95,
        ]);

        Product::factory()->create([
            'code' => 'B01',
            'name' => 'Blue Widget',
            'price' => 7.95,
        ]);
    }
}
