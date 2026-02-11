<?php

namespace App\Actions\Products;
use App\Models\Products;

class RestoreProductAction
{
   /**
     * @param array<string, mixed> $data
     */
    public function execute(Products $product): bool
    {
        if( !$product->trashed()){
            return false;
        }

        $product->restore();
        return true;
    }
}


