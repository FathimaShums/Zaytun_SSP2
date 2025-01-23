<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodItemController;



Route::get('/', function () {
    return view('welcome');
});


Route::prefix('food-items')->group(function () {
    Route::get('/', [FoodItemController::class, 'index']); // List all food items
    Route::post('/', [FoodItemController::class, 'store']); // Create a food item
    Route::get('/{id}', [FoodItemController::class, 'show']); // Get a specific food item
    Route::put('/{id}', [FoodItemController::class, 'update']); // Update a food item
    Route::delete('/{id}', [FoodItemController::class, 'destroy']); // Delete a food item
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
