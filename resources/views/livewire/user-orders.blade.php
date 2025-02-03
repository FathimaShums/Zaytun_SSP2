<div class="p-6">
    <h2 class="text-2xl font-semibold mb-6">My Orders</h2>

    @forelse ($orders as $order)
        <div class="bg-white p-5 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-medium text-gray-700">Order ID: #{{ $order->id }}</h3>
                <span class="text-sm text-gray-500">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="space-y-2">
                <p><strong class="text-gray-600">Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                <p><strong class="text-gray-600">Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
            </div>

            <div class="mt-4">
                <h4 class="text-lg font-semibold text-gray-700">Order Details:</h4>
                <ul>
                    @foreach ($order->orderDetails as $orderDetail)
                        <li class="flex justify-between mb-2">
                            <span>{{ $orderDetail->foodItem->name }} ({{ $orderDetail->quantity }})</span>
                            <span>${{ number_format($orderDetail->price * $orderDetail->quantity, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p class="text-gray-500">You have no orders yet.</p>
    @endforelse
</div>

