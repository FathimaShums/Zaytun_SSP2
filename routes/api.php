<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FoodItemController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('food-items')->group(function () {
    Route::get('/', [FoodItemController::class, 'index']); // List all food items
    Route::post('/', [FoodItemController::class, 'store']); // Create a food item
    Route::get('/{id}', [FoodItemController::class, 'show']); // Get a specific food item
    Route::put('/{id}', [FoodItemController::class, 'update']); // Update a food item
    Route::delete('/{id}', [FoodItemController::class, 'destroy']); // Delete a food item
});