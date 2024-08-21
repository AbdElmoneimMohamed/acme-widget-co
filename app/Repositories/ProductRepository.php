<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function getProductByCode(string $code): ?Product
    {
        return Product::query()->where('code', $code)->first();
    }

    /**
     * @return Collection<int, Product>
     */
    public function getAllProducts(): Collection
    {
        return Product::query()->get();
    }
}
