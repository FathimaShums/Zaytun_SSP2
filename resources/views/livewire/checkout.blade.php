<div class="checkout-container max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    @if(session()->has('message'))
        <div class="alert alert-warning bg-yellow-200 text-yellow-800 p-4 rounded-md mb-6">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-3xl font-semibold text-center mb-6">Checkout</h2>

    <div x-data="{ show: false, message: '' }" x-init="@this.on('orderPlaced', (message) => { show = true; message = message; setTimeout(() => show = false, 5000); })">
        <div x-show="show" x-transition class="alert alert-success bg-green-200 text-green-800 p-4 rounded-md mb-6">
            <span x-text="message"></span>
        </div>
    </div>

    <form wire:submit.prevent="placeOrder" class="space-y-6">
        @if(!Auth::check())
            <div class="form-group space-y-3">
                <div>
                    <label for="guest_name" class="block text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" id="guest_name" wire:model="guest_name" class="w-full p-3 border rounded-md">
                </div>
                <div>
                    <label for="guest_email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="guest_email" wire:model="guest_email" class="w-full p-3 border rounded-md">
                </div>
                <div>
                    <label for="guest_phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                    <input type="text" id="guest_phone" wire:model="guest_phone" class="w-full p-3 border rounded-md">
                </div>
            </div>
        @endif

        <div class="form-group space-y-3">
            @if(Auth::check())
                <div class="flex items-center">
                    <label for="useDefaultAddress" class="text-sm font-medium text-gray-700">Use Default Address</label>
                    <input type="checkbox" id="useDefaultAddress" wire:model="useDefaultAddress" class="ml-2">
                </div>

                @if($useDefaultAddress)
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Default Address:</label>
                        <p class="text-gray-600">{{ Auth::user()->address }}</p>
                    </div>
                @endif
            @endif

            @if(!$useDefaultAddress || !Auth::check())
                <div class="mt-4">
                    <label for="custom_address" class="block text-sm font-medium text-gray-700">Custom Address:</label>
                    <textarea id="custom_address" wire:model="custom_address" class="w-full p-3 border rounded-md"></textarea>
                </div>
            @endif
        </div>

        <h3 class="text-xl font-semibold mb-4">Cart Summary</h3>
        <ul class="space-y-3">
            @foreach($cart as $item)
                <li class="flex items-center space-x-4">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium">{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                        <span class="text-sm text-gray-600">${{ number_format($item['price'], 2) }}</span>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="flex justify-between mt-4">
            <strong>Total:</strong>
            <span class="text-lg font-semibold">${{ number_format($totalPrice, 2) }}</span>
        </div>

        <button type="submit" class="w-full py-3 mt-6 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Place Order</button>
    </form>

    @if(!Auth::check())
    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="inline-block px-6 py-3 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white">
            Return to Home
        </a>
    </div>
    @endif
</div>
