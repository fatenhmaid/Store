<?php
use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::group([
  'middleware'=>['auth'],
 // 'as'=>'dashboard.'  التسمية
  'prefix'=>'dashboard',
  //'namespace'=>'App\Http\Controllers'
],function(){
    Route::resource('/categories', CategoriesController::class);   
  Route::resource('/products', CategoriesController::class);
});


/*Route::middleware('auth')->prefix('dashboard')->group(function(){
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', CategoriesController::class);
})*/



?>