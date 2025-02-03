<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'delivery_person_id',
        'delivery_status',
        'delivery_time',
    ];

    // Define the relationship to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship to User (as delivery person)
    public function deliveryPerson()
    {
        return $this->belongsTo(User::class, 'delivery_person_id');
    }
    protected $casts = [
        'delivery_status' => 'string',
    ];
    
}