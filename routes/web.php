<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');  
    Route::resource('ingredient', IngredientController::class);
    Route::resource('recipe', RecipeController::class);
    Route::resource('user', UserController::class);
    Route::post('/getIngredient', [IngredientController::class, 'getDetails'])->name('getIngredient');
    Route::post('/getCateIngredientLIst', [IngredientController::class, 'getCateIngredientLIst'])->name('getCateIngredientLIst');
    Route::post('/getRecipeFilter', [RecipeController::class, 'getRecipeFilter'])->name('getRecipeFilter');
    Route::post('/getIngredientFilter', [IngredientController::class, 'getIngredientFilter'])->name('getIngredientFilter');

    Route::post('/recipe/check',[RecipeController::class,'check'])->name('recipe.check');
    Route::post('/ingredient/check',[IngredientController::class,'check'])->name('ingredient.check');
});


require __DIR__.'/auth.php';
