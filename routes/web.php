<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Home\HomeController;

Route::get('/',[HomeController::class, 'Index'])->name('user.home');




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


// subcategory all route

Route::get('admin/subcategories', [SubCategoryController::class,'Index'])->name('admin.subcategories');
Route::get('admin/subcategory/create', [SubCategoryController::class, 'SubCategoryCreate'])->name('subcategory.create');
Route::post('admin/subcategory/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
Route::get('admin/subcategory/edit/{subcategory}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
Route::put('admin/subcategory/update/{subcategory}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
Route::delete('admin/subcategory/delete/{subcategory}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');


// Products All Routes
Route::get('admin/products', [ProductsController::class,'Index'])->name('admin.products');
 Route::get('admin/products/create', [ProductsController::class, 'ProductCreate'])->name('product.create');
 Route::post('admin/products/store', [ProductsController::class, 'ProductStore'])->name('product.store');
 Route::get('admin/products/edit/{product}', [ProductsController::class, 'ProductEdit'])->name('product.edit');
 Route::put('admin/products/update/{product}', [ProductsController::class, 'ProductUpdate'])->name('product.update');
Route::delete('admin/products/delete/{product}', [ProductsController::class, 'ProductDelete'])->name('product.delete');


// Slider All Routes

Route::get('admin/slider',[SliderController::class,'Index'])->name('admin.slider');
Route::get('admin/slider/create',[SliderController::class,'SliderCreate'])->name('slider.create');
Route::post('admin/slider/store',[SliderController::class,'SliderStore'])->name('slider.store');
Route::get('admin/slider/edit/{slider}',[SliderController::class,'SliderEdit'])->name('slider.edit');
Route::put('admin/slider/update/{slider}',[SliderController::class,'SliderUpdate'])->name('slider.update');
Route::delete('admin/slider/delete/{slider}',[SliderController::class,'SliderDelete'])->name('slider.delete');


});

Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
});





require __DIR__.'/auth.php';
