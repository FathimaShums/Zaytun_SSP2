<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Appetizers'],
            ['name' => 'Main Course'],
            ['name' => 'Desserts'],
            ['name' => 'Beverages'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}