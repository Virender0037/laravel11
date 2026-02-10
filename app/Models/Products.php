<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{   
   use SoftDeletes, HasFactory;  

   protected $fillable = [
        'sku',
        'name',
        'price',
        'stock',
        'status',
        'created_by',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
