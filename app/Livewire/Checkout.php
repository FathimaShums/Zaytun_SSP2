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
    public $useDefaultAddress = true;  // Declare this inside the class
    public $custom_address = '';

    public function mount()
    {
        $this->cart = Session::get('cart', []);
        $this->totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->cart));
    }

    public function placeOrder()
    {
        if (!$this->cart) return;
    
        // Determine the address based on the condition
        $address = null;
    
        if (Auth::check()) {
            // If using default address, take from the User model
            if ($this->useDefaultAddress) {
                $address = Auth::user()->address;
            } else {
                // If custom address is provided, use that
                $address = $this->custom_address;
            }
        } else {
            // If guest, custom address is required
            $address = $this->custom_address;
        }
    
        // Log the address value for debugging
        \Log::info('Address:', ['address' => $address]);
        
        // Validate if address is provided for non-logged-in users
        if (empty($address) && !Auth::check()) {
            session()->flash('message', 'Please provide an address.');
            return;
        }
    
        // Create the order
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'guest_name' => $this->guest_name,
            'guest_email' => $this->guest_email,
            'guest_phone' => $this->guest_phone,
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
    
        $this->cart = [];
        $this->totalPrice = 0;
    
        // Clear guest input fields only if the user is not logged in
        if (!Auth::check()) {
            $this->guest_name = '';
            $this->guest_email = '';
            $this->guest_phone = '';
        }
    
        // Flash success message
        $this->dispatch('orderPlaced', 'Your order has been placed successfully!');
    }
    

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.app');
    }
}
