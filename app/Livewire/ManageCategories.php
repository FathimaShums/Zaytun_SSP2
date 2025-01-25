<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class ManageCategories extends Component
{
    public $categoryId, $name;

    protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name',
    ];

    public function saveCategory()
    {
        $this->validate();

        Category::create(['name' => $this->name]);

        session()->flash('message', 'Category added successfully.');

        $this->name = '';  // Reset form
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            $category->delete();
            session()->flash('message', 'Category deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.manage-categories', [
            'categories' => Category::all(),
        ]);
    }
}
