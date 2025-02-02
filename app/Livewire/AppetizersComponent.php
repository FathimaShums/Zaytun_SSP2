<?php

namespace App\Livewire;

class AppetizersComponent extends FoodCategoryComponent
{
    public function mount($categoryId = 1)
    {
        parent::mount($categoryId); // Category ID for Appetizers
    }
}
