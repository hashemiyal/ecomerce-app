<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Http\Controllers\FrontEnd\WishListController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get("/", [FrontEndController::class, 'index']);
Route::get("/collections", [FrontEndController::class, 'categories']);
Route::get("/collections/{category_slug}", [FrontEndController::class, 'products']);
Route::get("/collections/{category_slug}/{product_slug}", [FrontEndController::class, 'productView']);
Route::middleware(['auth'])->group(function () {
    Route::get('wishlists', [WishListController::class, 'index']);
});




Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    // route group for category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('admin/category', 'index');
        Route::get('admin/category/create', 'create');
        Route::get('admin/category', 'index');
        Route::post('admin/category', 'store');
        Route::get('admin/category/{category}/edite', 'edite');
        Route::put('admin/category/{category}', 'update');
    });
    //rout group for brand
    Route::controller(BrandController::class)->group(function () {
        Route::get('admin/brand', 'index');
    });
    // route group for Product
    Route::controller(ProductController::class)->group(function () {
        Route::get('admin/product/create', 'create');
        Route::get('admin/product', 'index');
        Route::get('admin/product/{product}/edite', 'edite');
        Route::post('admin/product', 'store');
        Route::put('admin/product/{product}', 'update');
        Route::get('admin/product/{product}/delete', 'destroy');
        Route::post('/admin/productcolor/{productcolor_id}', 'updateproductcolor');
        Route::get('/admin/productcolor/{productcolor_id}', 'deleteproductcolor');
    });
    // route group for color
    Route::controller(ColorController::class)->group(function () {
        Route::get('admin/color/', 'index');
        Route::get('admin/color/create', 'create');
        Route::post('admin/color/', 'store');
        Route::get('admin/color/{color}/edite', 'edite');
        Route::put('admin/color/{color}', 'update');
        Route::get('admin/color/{color}/delete', 'delete');

    });
    // route group for sliders
    Route::controller(SliderController::class)->group(function () {
        Route::get('admin/slider', 'index');
        Route::get('admin/slider/create', 'create');
        Route::post('admin/slider', 'store');
        Route::get('admin/slider/{slider}/edite', 'edite');
        Route::post('admin/slider/{slider}', 'update');
        Route::get('admin/slider/{slider}/delete', 'delete');

    });
});