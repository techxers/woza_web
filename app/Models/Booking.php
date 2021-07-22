<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function business()
    {
        return $this->belongsTo(Business::class,'service_provider_id');
    }
    public function booker()
    {
        return $this->belongsTo(User::class,'booker_id');
    }
}

