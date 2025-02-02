<?php

namespace App\Livewire;

use Livewire\Component;

namespace App\Livewire;

class BeveragesComponent extends FoodCategoryComponent
{
    public function mount($categoryId = 4)
    {
        parent::mount($categoryId); // Category ID for Appetizers
    }
}
