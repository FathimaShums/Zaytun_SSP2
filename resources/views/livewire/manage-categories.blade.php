<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Manage Categories</h2>

    <!-- Category Form -->
    <form wire:submit.prevent="saveCategory" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
            <input 
                type="text" 
                id="name" 
                wire:model="name" 
                required
                class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Enter category name"
            >
            @error('name') 
                <span class="text-sm text-red-500">{{ $message }}</span> 
            @enderror
        </div>

        <button 
            type="submit" 
            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
            Add Category
        </button>
    </form>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 p-3 text-center text-white bg-green-500 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <!-- List of Categories -->
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories List</h3>
        
        @if($categories->isEmpty())
            <p class="text-gray-500">No categories available.</p>
        @else
            <ul class="space-y-2">
                @foreach($categories as $category)
                    <li class="flex justify-between items-center bg-gray-50 p-4 rounded-md shadow-sm">
                        <span class="text-gray-800 font-medium">{{ $category->name }}</span>
                        <button 
                            wire:click="deleteCategory({{ $category->id }})" 
                            class="ml-4 text-red-600 hover:text-red-700 focus:outline-none"
                        >
                            Delete
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
