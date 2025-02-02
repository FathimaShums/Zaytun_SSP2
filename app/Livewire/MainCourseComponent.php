<?php

namespace App\Livewire;

use Livewire\Component;

namespace App\Livewire;

class MainCourseComponent extends FoodCategoryComponent
{
    public function mount($categoryId = 5)
    {
        parent::mount($categoryId); // Category ID for Appetizers
    }
}
