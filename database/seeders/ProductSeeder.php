<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@admin.com')->firstOrFail();
        $user  = User::where('email', 'user@user.com')->firstOrFail();

        // 10 products each
        $adminProducts = Products::factory()->count(10)->create([
            'created_by' => $admin->id,
        ]);

        $userProducts = Products::factory()->count(10)->create([
            'created_by' => $user->id,
        ]);

        // Soft-delete a few for trash demo
        $adminProducts->take(3)->each->delete();
        $userProducts->take(2)->each->delete();
    }
}
