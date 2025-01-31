<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'default_address',
        'custom_address',
        'status',
        'total_price',
    ];
    

    // Define the relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to OrderDetails
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Define the relationship to Delivery
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
  

}