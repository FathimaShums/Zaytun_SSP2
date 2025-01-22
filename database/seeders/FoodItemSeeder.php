<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodItem;
use App\Models\Category;

class FoodItemSeeder extends Seeder
{
    public function run()
    {
        // Fetch category IDs for association
        $appetizersCategory = Category::where('name', 'Appetizers')->first();
        $mainCourseCategory = Category::where('name', 'Main Course')->first();
        $dessertsCategory = Category::where('name', 'Desserts')->first();
        $beveragesCategory = Category::where('name', 'Beverages')->first();

        // Create sample food items and attach categories
        $foodItem1 = FoodItem::create([
            'name' => 'Spring Rolls',
            'description' => 'Crispy rolls filled with veggies and served with sweet chili sauce.',
            'price' => 5.99,
            'quantity' => 25,
            'image' => null, // Set a default image path if needed
        ]);
        $foodItem1->categories()->attach($appetizersCategory);

        $foodItem2 = FoodItem::create([
            'name' => 'Grilled Chicken',
            'description' => 'Tender grilled chicken breast with herbs and spices.',
            'price' => 12.49,
            'quantity' => 15,
            'image' => null,
        ]);
        $foodItem2->categories()->attach($mainCourseCategory);

        $foodItem3 = FoodItem::create([
            'name' => 'Chocolate Lava Cake',
            'description' => 'Rich chocolate cake with a molten center.',
            'price' => 6.99,
            'quantity' => 10,
            'image' => null,
        ]);
        $foodItem3->categories()->attach($dessertsCategory);

        $foodItem4 = FoodItem::create([
            'name' => 'Iced Tea',
            'description' => 'Refreshing iced tea with a hint of lemon.',
            'price' => 2.99,
            'quantity' => 50,
            'image' => null,
        ]);
        $foodItem4->categories()->attach($beveragesCategory);
    }
}