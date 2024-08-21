<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getProductByCode(string $code): ?Product;

    /**
     * @return Collection<int, Product>
     */
    public function getAllProducts(): Collection;
}
