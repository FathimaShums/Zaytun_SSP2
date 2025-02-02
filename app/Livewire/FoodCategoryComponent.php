<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FoodItem;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class FoodCategoryComponent extends Component
{
    public $categoryId;
    public $foodItems = [];
    public $cart = [];
    public $quantities = [];

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
        $category = Category::with('foodItems')->find($categoryId);

        $this->foodItems = $category ? $category->foodItems : collect(); 
        $this->cart = Session::get('cart', []);
    }

    public function addToCart($foodItemId)
    {
        $quantity = $this->quantities[$foodItemId] ?? 1; // Default to 1 if not set
    
        $foodItem = FoodItem::find($foodItemId);
        if (!$foodItem) {
            return;
        }
    
        $cart = Session::get('cart', []);
    
        if (isset($cart[$foodItemId])) {
            $cart[$foodItemId]['quantity'] += $quantity;
        } else {
            $cart[$foodItemId] = [
                'id' => $foodItemId,
                'name' => $foodItem->name,
                'price' => $foodItem->price,
                'image' => $foodItem->image,
                'quantity' => $quantity
            ];
        }
    
        Session::put('cart', $cart);
        $this->cart = $cart;
    
        // Reset the quantity input field after adding to cart
        $this->quantities[$foodItemId] = 1;
    
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.food-category-component')->layout('layouts.app');;
    }
}
