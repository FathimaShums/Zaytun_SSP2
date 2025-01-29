<div>
    <h1>Manage Food Items</h1>

    <!-- Form for adding/editing food items -->
    <form wire:submit.prevent="save">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" wire:model="name" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" wire:model="description"></textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" wire:model="price" step="0.01" required>
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" wire:model="quantity" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" wire:model="image">
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" width="100">
            @endif
        </div>
        <div>
            <label>Categories:</label>
            @foreach ($categories as $category)
                <label>
                    <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}">
                    {{ $category->name }}
                </label>
            @endforeach
        </div>
        <button type="submit">{{ $editMode ? 'Update' : 'Save' }}</button>
        <button type="button" wire:click="resetForm">Cancel</button>
    </form>

    <!-- List of food items -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foodItems as $foodItem)
                <tr>
                    <td>{{ $foodItem->name }}</td>
                    <td>{{ $foodItem->description }}</td>
                    <td>{{ $foodItem->price }}</td>
                    <td>{{ $foodItem->quantity }}</td>
                    <td>
                        @if ($foodItem->image)
                            <img src="{{ asset('storage/' . $foodItem->image) }}" width="50">
                        @endif
                    </td>
                    <td>
                        @foreach ($foodItem->categories as $category)
                            {{ $category->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        <button wire:click="edit({{ $foodItem->id }})">Edit</button>
                        <button wire:click="delete({{ $foodItem->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>