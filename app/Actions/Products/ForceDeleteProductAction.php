<?php

namespace App\Actions\Products;
use App\Models\Products;

class ForceDeleteProductAction
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(Products $product): bool
    {
        if( !$product->trashed()){
            return false;
        }

        $product->forceDelete();
        return true;
    }
}




