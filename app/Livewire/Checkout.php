<?php


namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetail;

class Checkout extends Component
{
    public $cart;
    public $guest_name, $guest_email, $guest_phone;
    public $totalPrice = 0;
    public $useDefaultAddress = true;  
    public $custom_address = '';

    public function mount()
    {
        $this->cart = Session::get('cart', []);
        $this->totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->cart));

        if (Auth::check()) {
            // Prefill logged-in user's details
            $user = Auth::user();
            $this->guest_name = $user->name;
            $this->guest_email = $user->email;
            $this->guest_phone = $user->phone_number;
        }
    }

    public function placeOrder()
    {
        if (!$this->cart) return;

        // Determine address
        $address = $this->useDefaultAddress && Auth::check() ? Auth::user()->address : $this->custom_address;

        if (empty($address)) {
            session()->flash('message', 'Please provide an address.');
            return;
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'guest_name' => Auth::check() ? Auth::user()->name : $this->guest_name,
            'guest_email' => Auth::check() ? Auth::user()->email : $this->guest_email,
            'guest_phone' => Auth::check() ? Auth::user()->phone_number : $this->guest_phone,
            'default_address' => Auth::check() && $this->useDefaultAddress ? Auth::user()->address : null,
            'custom_address' => $address,
            'status' => 'pending',
            'total_price' => $this->totalPrice,
        ]);

        foreach ($this->cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'food_item_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart and fields
        $this->cart = [];
        $this->totalPrice = 0;
        if (!Auth::check()) {
            $this->guest_name = '';
            $this->guest_email = '';
            $this->guest_phone = '';
        }

        $this->dispatch('orderPlaced', 'Your order has been placed successfully!');
        return redirect()->route('checkout')->with('successMessage', 'Your order has been placed successfully!');
    }

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.app');
    }
}
