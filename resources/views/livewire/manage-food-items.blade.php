<div class="container">
    <h1 class="text-center mb-6 text-3xl font-semibold">Manage Food Items</h1>

    <!-- Form for adding/editing food items -->
    <form wire:submit.prevent="save" class="bg-white p-6 rounded-lg shadow-lg space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" wire:model="name" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="description" class="text-sm font-medium text-gray-700">Description:</label>
                <textarea id="description" wire:model="description" class="mt-1 p-2 w-full border rounded-md"></textarea>
            </div>
            <div>
                <label for="price" class="text-sm font-medium text-gray-700">Price:</label>
                <input type="number" id="price" wire:model="price" step="0.01" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="quantity" class="text-sm font-medium text-gray-700">Quantity:</label>
                <input type="number" id="quantity" wire:model="quantity" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="col-span-2">
                <label for="image" class="text-sm font-medium text-gray-700">Image:</label>
                <input type="file" id="image" wire:model="image" class="mt-1 p-2 w-full border rounded-md">
                @if ($image)
                    <div class="mt-2">
                        <img src="{{ $image->temporaryUrl() }}" width="100" class="rounded-lg">
                    </div>
                @endif
            </div>
            <div class="col-span-2">
                <label class="text-sm font-medium text-gray-700">Categories:</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-2">
                    @foreach ($categories as $category)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" class="form-checkbox h-4 w-4">
                            <span class="text-sm">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                {{ $editMode ? 'Update' : 'Save' }}
            </button>
            <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600">
                Cancel
            </button>
        </div>
    </form>

    <!-- List of food items -->
    <div class="mt-8">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Description</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Price</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Quantity</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Image</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Categories</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($foodItems as $foodItem)
                    <tr class="border-t border-gray-100">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $foodItem->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $foodItem->description }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $foodItem->price }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $foodItem->quantity }}</td>
                        <td class="px-4 py-2 text-center">
                            @if ($foodItem->image)
                                <img src="{{ asset('storage/' . $foodItem->image) }}" width="50" class="rounded-lg">
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            @foreach ($foodItem->categories as $category)
                                {{ $category->name }}<br>
                            @endforeach
                        </td>
                        <td class="px-4 py-2 text-center">
                            <button wire:click="edit({{ $foodItem->id }})" class="text-blue-500 hover:text-blue-700">Edit</button>
                            <button wire:click="delete({{ $foodItem->id }})" class="text-red-500 hover:text-red-700 ml-4">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
