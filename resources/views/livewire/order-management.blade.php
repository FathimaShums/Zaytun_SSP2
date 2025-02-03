<div>
    <h2 class="text-lg font-bold mb-4">Orders Management</h2>

    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-500 text-white p-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Order ID</th>
                <th class="border p-2">Customer</th>
                <th class="border p-2">Address</th>
                <th class="border p-2">Food Items</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Assign Delivery</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="border p-2">{{ $order->id }}</td>
                    <td class="border p-2">{{ $order->user_id ? $order->user->name : $order->guest_name }}</td>
                    <td class="border p-2">
                        {{ $order->custom_address ?? $order->default_address }}
                    </td>
                    <td class="border p-2">
                        <!-- Loop through the order details to show food items and their quantities -->
                        @foreach($order->orderDetails as $orderDetail)
                            <div>{{ $orderDetail->foodItem->name }} (x{{ $orderDetail->quantity }})</div>
                        @endforeach
                    </td>
                    <td class="border p-2">{{ ucfirst($order->status) }}</td>
                    <td class="border p-2">
                        <select wire:model="selectedDeliveryPersons.{{ $order->id }}" class="border p-1">
                            <option value="">Select Delivery Person</option>
                            @foreach($deliveryMen as $deliveryMan)
                                <option value="{{ $deliveryMan->id }}">{{ $deliveryMan->name }}</option>
                            @endforeach
                        </select>
                        <button wire:click="assignDelivery({{ $order->id }})" class="bg-blue-500 text-white p-2 rounded ml-2">
                            Assign
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
