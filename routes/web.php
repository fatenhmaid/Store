<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckOutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*Auth::routes([
   'verfiy'=>true,
]);*/
Route::group([
  'prefix' => LaravelLocalization::setLocale(),
], function(){
  Route::get('/',[HomeController::class,'index'])
->name('home');
Route::get('/products/{product:slug}', [ProductsController::class, 'show'])
->name('prod.show');
Route::get('/products', [ProductsController::class, 'index'])
->name('products.index');
Route::resource('cart',CartController::class);
Route::get('checkout',[CheckOutController::class,'create'])
->name('checkout');
Route::post('checkout',[CheckOutController::class,'store']);
Route::get('auth/user/2fa', [TwoFactorAuthentcationController::class, 'index'])
        ->name('front.2fa');
Route::post('/paypal/webhock',function(){
  echo 'Webhock called';
});
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   

});

//require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';