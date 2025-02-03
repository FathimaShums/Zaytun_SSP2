<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class UserOrders extends Component
{
    public $orders;

    public function mount()
    {
        // Get all orders for the logged-in user
        $this->orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->with(['orderDetails', 'orderDetails.foodItem']) // Eager load order details and food items
            ->get();
    }

    public function render()
    {
        return view('livewire.user-orders')->layout('layouts.app');;
    }
}

