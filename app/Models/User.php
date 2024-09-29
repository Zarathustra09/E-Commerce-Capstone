<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship: One user can have many addresses
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // Relationship: One user can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship: One user can have many cart items
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    // Relationship: One user can have many payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
