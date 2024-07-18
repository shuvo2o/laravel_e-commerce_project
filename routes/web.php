<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;



Route::get('/', function () {
    return Inertia::render('Home/HomePage', [
        
    ]);
});




Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
//Category
Route::get('admin/categories', [CategoryController::class,'Index'])->name('admin.categories');
Route::get('admin/category/create', [CategoryController::class, 'CategoryCreate'])->name('category.create');
Route::post('admin/category/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
Route::get('admin/category/edit/{category}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
Route::put('admin/category/update/{category}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
Route::delete('admin/category/delete/{category}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');


});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
});





require __DIR__.'/auth.php';
