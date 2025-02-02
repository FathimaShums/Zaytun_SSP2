<div>
    <h2 class="text-xl font-bold mt-4">{{ $foodItems->first()->category->name ?? 'Category' }}</h2>

    <div class="grid grid-cols-2 gap-6">
        @foreach ($foodItems as $foodItem)
            <div class="border border-gray-300 rounded-lg p-4">
                <img src="{{ asset('storage/' . $foodItem->image) }}" alt="{{ $foodItem->name }}" class="w-full h-32 object-cover rounded-lg">
                
                <p class="text-lg font-bold">{{ $foodItem->name }}</p>
                <p class="text-green-600 font-semibold">${{ number_format($foodItem->price, 2) }}</p>

                <div class="flex gap-2 mt-2">
                    <input type="number" min="1" wire:model.defer="quantities.{{ $foodItem->id }}" class="w-16 border p-2 rounded">
                    
                    <button wire:click="addToCart({{ $foodItem->id }})"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add to Cart
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

