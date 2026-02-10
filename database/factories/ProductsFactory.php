<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    protected $model = Products::class;

    public function definition(): array
    {
        return [
            'sku'        => $this->faker->unique()->bothify('SKU-#####'),
            'name'       => $this->faker->words(3, true),
            'price'      => $this->faker->randomFloat(2, 1, 99999),
            'stock'      => $this->faker->numberBetween(0, 500),
            'status'     => 'active',
            'created_by' => User::factory(),
        ];
    }
}
