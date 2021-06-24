<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Business::class,'business_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
