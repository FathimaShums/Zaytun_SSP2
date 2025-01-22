<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the many-to-many relationship with food items
    public function foodItems()
    {
        return $this->belongsToMany(FoodItem::class, 'category_food_item');
    }
}