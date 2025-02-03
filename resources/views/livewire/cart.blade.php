<div>
    <h2 class="text-2xl font-bold mb-4">Shopping Cart</h2>

    @if(empty($cart))
        <p class="text-gray-500">Your cart is empty.</p>
    @else
        @php
            $cartTotal = 0;
        @endphp

        @foreach ($cart as $item)
            @php
                $itemTotal = $item['price'] * $item['quantity'];
                $cartTotal += $itemTotal;
            @endphp

            <div class="flex justify-between items-center border p-4 rounded-lg shadow-md mb-2">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 object-cover rounded">
                    <div>
                        <p class="text-lg font-bold">{{ $item['name'] }}</p>
                        <p class="text-gray-600 text-sm">Quantity: <span class="font-semibold">{{ $item['quantity'] }}</span></p>
                        <p class="text-green-600 font-semibold">${{ number_format($itemTotal, 2) }}</p>
                    </div>
                </div>
                
                <button wire:click="removeItem({{ $item['id'] }})" class="text-red-600 hover:underline">
                    Remove
                </button>
            </div>
        @endforeach

        <!-- Cart Total Section -->
        <div class="mt-4 p-4 border-t font-semibold text-lg flex justify-between">
            <span>Total:</span>
            <span class="text-green-600">${{ number_format($cartTotal, 2) }}</span>
        </div>

        <button wire:click="proceedToCheckout" class="bg-green-500 text-white px-4 py-2 rounded mt-4 w-full text-center">
            Proceed to Checkout
        </button>
    @endif
</div>
