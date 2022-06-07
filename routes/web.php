<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardTransactionController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])
    ->name('categories-detail');

Route::get('/details/{id}', [DetailController::class, 'index'])
    ->name('detail');

Route::post('/details/{id}', [DetailController::class, 'add'])
    ->name('detail-add');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart');

    Route::delete('/cart/{id}', [CartController::class, 'delete'])
        ->name('cart-delete');

    Route::get('/success', [CartController::class, 'success'])
        ->name('success');

    Route::get('/register/success', [RegisteredUserController::class, 'success'])
        ->name('success');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])
        ->name('dashboard-product');

    Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])
        ->name('dashboard-product-create');

    Route::post('/dashboard/products', [DashboardProductController::class, 'store'])
        ->name('dashboard-product-store');

    Route::get('/dashboard/products/{id}', [DashboardProductController::class, 'details'])
        ->name('dashboard-product-details');

    Route::post('/dashboard/products/{id}', [DashboardProductController::class, 'update'])
        ->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])
        ->name('dashboard-product-galley-upload');

    Route::get('/dashboard/products/gallery/{id}', [DashboardProductController::class, 'deleteGallery'])
        ->name('dashboard-product-galley-delete');

    Route::get('/dashboard/transaction', [DashboardTransactionController::class, 'index'])
        ->name('dashboard-transaction');

    Route::get('/dashboard/transaction/{id}', [DashboardTransactionController::class, 'details'])
        ->name('dashboard-transaction-details');

    Route::post('/dashboard/transaction/{id}', [DashboardTransactionController::class, 'update'])
        ->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])
        ->name('dashboard-settings-store');

    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])
        ->name('dashboard-settings-account');

    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class, 'update'])
        ->name('dashboard-settings-redirect');
});


// ->middleware(['auth','admin'])
Route::prefix('admin')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', AdminCategoryController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-gallery', ProductGalleryController::class);
    });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
