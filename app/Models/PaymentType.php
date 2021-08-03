<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
