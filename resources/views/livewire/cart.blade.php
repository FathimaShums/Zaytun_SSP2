<div>
    <h2 class="text-2xl font-bold">Shopping Cart</h2>

    @if(empty($cart))
        <p class="text-gray-500">Your cart is empty.</p>
    @else
        @foreach ($cart as $item)
            <div class="flex justify-between items-center border p-4 rounded-lg">
                <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 object-cover rounded">
                <p class="text-lg font-bold">{{ $item['name'] }}</p>
                <p>${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                <button wire:click="removeItem({{ $item['id'] }})" class="text-red-600">Remove</button>
            </div>
        @endforeach

        <button wire:click="proceedToCheckout" class="bg-green-500 text-white px-4 py-2 rounded mt-4">
            Proceed to Checkout
        </button>
    @endif
</div>
