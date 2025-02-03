<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Cart extends Component
{
    public $cart = [];

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
    }

    public function removeItem($foodItemId)
    {
        $cart = Session::get('cart', []);
        unset($cart[$foodItemId]);
        Session::put('cart', $cart);
        $this->cart = $cart;
    }

    public function proceedToCheckout()
    {
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.cart')->layout('layouts.app');
    }
}
