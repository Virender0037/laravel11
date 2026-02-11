<?php

namespace App\Actions\Products;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CreateProductAction
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data): Products
    {
        $data['created_by'] = Auth::id();

        return Products::create($data);
    }
}
