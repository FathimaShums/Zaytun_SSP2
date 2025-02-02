<div>
    <h2 class="text-2xl font-bold">Checkout</h2>

    @if(session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-2">
            {{ session('message') }}
        </div>
    @endif

    @if(!Auth::check())
        <input type="text" wire:model="guest_name" placeholder="Full Name">
        <input type="email" wire:model="guest_email" placeholder="Email">
        <input type="text" wire:model="guest_phone" placeholder="Phone">
    @endif

    <h3>Total: ${{ number_format($totalPrice, 2) }}</h3>

    <button wire:click="placeOrder" class="bg-green-500 text-white px-4 py-2 rounded">
        Place Order
    </button>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('orderPlaced', message => {
                alert(message); // Or replace this with a toast notification
            });
        });
    </script>
</div>
