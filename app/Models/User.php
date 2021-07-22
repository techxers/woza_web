<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table ='tbl_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'mobile',
        'user_type',
        'roleId',
        'uType',
        'password',
        'country_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $primaryKey = 'userId';
    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function address()
    {
       return $this->hasOne(Address::class);
    }
    public function business()
    {
        return $this->hasOne(Business::class,'user_id');
    }
    public function sentnotifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function receivednotifications()
    {
        return $this->hasMany(Notification::class,'to');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class,'userId','bodaid');
    }
}
