<?php

namespace App\Actions\Products;
use App\Models\Products;

class DeleteProductAction
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(Products $product): void
    {
        $product->delete();
    }
}

