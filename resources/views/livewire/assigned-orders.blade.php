<div class="p-6">
    <h2 class="text-2xl font-semibold mb-6">Assigned Orders</h2>

    @foreach ($assignedOrders as $delivery)
        <div class="bg-white p-5 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-medium text-gray-700">Order ID: #{{ $delivery->order->id }}</h3>
                <span class="text-sm text-gray-500">{{ ucfirst($delivery->delivery_status) }}</span>
            </div>

            <div class="space-y-2">
                <p><strong class="text-gray-600">Customer Name:</strong> {{ $delivery->order->user->name ?? $delivery->order->guest_name }}</p>
                <p><strong class="text-gray-600">Phone Number:</strong> {{ $delivery->order->user->phone_number ?? $delivery->order->guest_phone }}</p>
                <p><strong class="text-gray-600">Address:</strong> {{ $delivery->order->default_address ?? $delivery->order->custom_address }}</p>
            </div>

            <div class="mt-4">
                @if ($delivery->delivery_status == 'assigned')
                    <button wire:click="updateDeliveryStatus({{ $delivery->id }}, 'out for delivery')"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                        Mark as Out for Delivery
                    </button>
                @elseif ($delivery->delivery_status == 'out for delivery')
                    <button wire:click="updateDeliveryStatus({{ $delivery->id }}, 'delivered')"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200">
                        Mark as Delivered
                    </button>
                @endif
            </div>
        </div>
    @endforeach
</div>
