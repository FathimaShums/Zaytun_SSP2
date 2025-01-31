<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Step 1: Validate the request data
        $request->validate([
            'guest_name' => 'required_without:user_id|string|max:255',
            'guest_email' => 'required_without:user_id|email|max:255',
            'guest_phone' => 'required_without:user_id|string|max:15',
            'custom_address' => 'required|string|max:255',
        ]);

        // Step 2: Retrieve cart from session
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Step 3: Calculate total price
        $totalPrice = array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart));

        // Step 4: Save the order to the database
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null, // Associate with logged-in user or null for guests
            'guest_name' => $request->input('guest_name'),
            'guest_email' => $request->input('guest_email'),
            'guest_phone' => $request->input('guest_phone'),
            'custom_address' => $request->input('custom_address'),
            'default_address' => Auth::check(), // Default to user's saved address if logged in
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        // Step 5: Save order items (details)
        foreach ($cart as $id => $item) {
            $order->orderDetails()->create([
                'food_item_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Step 6: Clear the cart from session
        session()->forget('cart');

        // Step 7: Redirect to a thank-you page with a success message
        return redirect()->route('thankyou')->with('success', 'Your order has been placed successfully!');
    }
}
