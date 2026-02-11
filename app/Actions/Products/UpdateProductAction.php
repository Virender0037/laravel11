<?php

namespace App\Actions\Products;
use App\Models\Products;

class UpdateProductAction
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(Products $product, array $data): Products
    {
        $product->update($data);

        return $product;
    }
}

