<div>
    <h2 class="text-2xl font-bold">Checkout</h2>

    @if(!Auth::check())
        <input type="text" wire:model="guest_name" placeholder="Full Name">
        <input type="email" wire:model="guest_email" placeholder="Email">
        <input type="text" wire:model="guest_phone" placeholder="Phone">
    @endif

    <h3>Total: ${{ number_format($totalPrice, 2) }}</h3>

    <button wire:click="placeOrder" class="bg-green-500 text-white px-4 py-2 rounded">
        Place Order
    </button>
</div>
