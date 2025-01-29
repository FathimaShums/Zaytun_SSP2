<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\FoodItem;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ManageFoodItems extends Component
{
    use WithFileUploads;

    public $foodItems;
    public $categories;
    public $name, $description, $price, $quantity, $image, $selectedCategories = [];
    public $editMode = false;
    public $foodItemId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable|image|max:2048', // 2MB max
        'selectedCategories' => 'required|array',
    ];

    public function mount()
    {
        $this->loadFoodItems();
        $this->categories = Category::all();
    }

    public function loadFoodItems()
    {
        $this->foodItems = FoodItem::with('categories')->get();
    }

    public function render()
    {
        return view('livewire.manage-food-items');
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('food-images', 'public') : null;

        $foodItem = FoodItem::updateOrCreate(
            ['id' => $this->foodItemId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'image' => $imagePath,
            ]
        );

        $foodItem->categories()->sync($this->selectedCategories);

        $this->resetForm();
        $this->loadFoodItems();
    }

    public function edit($id)
    {
        $foodItem = FoodItem::findOrFail($id);
        $this->foodItemId = $id;
        $this->name = $foodItem->name;
        $this->description = $foodItem->description;
        $this->price = $foodItem->price;
        $this->quantity = $foodItem->quantity;
        $this->selectedCategories = $foodItem->categories->pluck('id')->toArray();
        $this->editMode = true;
    }

    public function delete($id)
    {
        $foodItem = FoodItem::findOrFail($id);
        if ($foodItem->image) {
            Storage::disk('public')->delete($foodItem->image);
        }
        $foodItem->delete();
        $this->loadFoodItems();
    }

    public function resetForm()
    {
        $this->reset(['name', 'description', 'price', 'quantity', 'image', 'selectedCategories', 'editMode', 'foodItemId']);
    }
}