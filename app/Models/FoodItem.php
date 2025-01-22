<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
    ];

    // Define the many-to-many relationship with categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_food_item');
    }

    // Define the relationship to OrderDetails
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}