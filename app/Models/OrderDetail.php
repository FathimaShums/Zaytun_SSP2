<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'food_item_id',
        'quantity',
        'price',
    ];

    // Define the relationship to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship to FoodItem
    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }
}