<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function sender()
    {
        return $this->belongsTo(User::class,'from');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class,'to');
    }
    public function user()
    {
        return $this->belongsTo(Business::class);
    }
}
