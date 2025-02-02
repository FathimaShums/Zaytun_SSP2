<?php

namespace App\Livewire;
use Livewire\Component;
class DessertsComponent extends FoodCategoryComponent
{
    public function mount($categoryId = 3)
    {
        parent::mount($categoryId); // Category ID for Appetizers
    }
}
