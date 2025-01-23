<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    // Store a new food item
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'categories' => 'nullable|array',
        'categories.*' => 'exists:categories,id',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('food_images', 'public');
    }

    $foodItem = FoodItem::create([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'price' => $validated['price'],
        'quantity' => $validated['quantity'],
        'image' => $imagePath,
    ]);

    if ($request->has('categories')) {
        $foodItem->categories()->attach($validated['categories']);
    }

    return response()->json([
        'success' => true,
        'message' => 'Food item added successfully.',
        'data' => $foodItem->load('categories'), // Include categories in the response
    ], 201); // 201 Created
}


    // Get all food items
    public function index()
    {
        $foodItems = FoodItem::all();
        // $foodItems = FoodItem::with('categories')->get();
        return response()->json($foodItems);
    }

    // Get a specific food item by ID
    public function show($id)
    {
        $foodItem = FoodItem::with('categories')->find($id);

        if (!$foodItem) {
            return response()->json(['message' => 'Food item not found'], 404);
        }

        return response()->json($foodItem);
    }

    // Update a food item
    public function update(Request $request, $id)
    {
        $foodItem = FoodItem::find($id);

        if (!$foodItem) {
            return response()->json(['message' => 'Food item not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('food_images', 'public');
            $validated['image'] = $imagePath;
        }

        $foodItem->update($validated);

        return response()->json($foodItem, 200);
    }

    // Delete a food item
    public function destroy($id)
    {
        $foodItem = FoodItem::find($id);

        if (!$foodItem) {
            return response()->json(['message' => 'Food item not found'], 404);
        }

        $foodItem->delete();

        return response()->json(['message' => 'Food item deleted successfully'], 200);
    }
}