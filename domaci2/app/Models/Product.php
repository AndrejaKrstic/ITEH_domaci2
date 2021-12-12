<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
    public function type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
