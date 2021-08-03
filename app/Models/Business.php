<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table="business";

    public $timestamps=false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class,'to');
    }
    public function paymenttype()
    {
        return $this->hasOne(PaymentType::class,'business_id');
    }
}
