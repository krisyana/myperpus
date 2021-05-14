<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('library.index');

Route::prefix('library')->group(function () {
    // Route::get('/index', [HomeController::class, 'index'])->name('library.index');
    Route::get('/show/{book}', [HomeController::class, 'show'])->name('library.show');
    Route::get('/categories/{category}', [HomeController::class, 'category'])->name('library.category');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard',[RentController::class,'dashboard'])>name('dashboard');


Route::resources([
    'books' => BookController::class,
    'categories' => CategoryController::class,
    'users' => UserController::class,
    'rents' => RentController::class
]);

require __DIR__ . '/auth.php';
