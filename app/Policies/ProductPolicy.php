<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Products;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
        public function viewAny(User $user){
            return true;
        }

        public function viewTrashed(User $user){
            return true;
        }

        public function view(User $user, Products $products){
            return true;
        }

        public function restore(User $user, Products $products){
            return (int)$user->is_admin === 1;
        }

        public function forcedelete(User $user, Products $products){
            return (int)$user->is_admin === 1;
        }

        public function create(User $user){
            return (int)$user->is_admin === 1;
        }

        public function update(User $user, Products $products){
            return (int)$user->is_admin === 1 || $products->created_by === (int)$user->id;
        }

        public function delete(User $user, Products $products){
            return (int)$user->is_admin === 1 || $products->created_by === (int)$user->id;
        }
    }

