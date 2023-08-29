<?php
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group([
  //'middleware'=>['auth','auth.type:super_admin,admin'],
 // 'as'=>'dashboard.'  التسمية
  'prefix'=>'dashboard',
  //'namespace'=>'App\Http\Controllers'
],function(){
    Route::get('profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('profile',[ProfileController::class,'update'])->name('profile.update');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories/trash', [CategoriesController::class,'trash'])
    ->name('categories.trash');   
    Route::put('categories/{category}/restore',[CategoriesController::class,'restore'])
    ->name('categories.restore'); 
    Route::delete('categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])
    ->name('categories.force-delete'); 
    Route::resource('/categories', CategoriesController::class);   
    Route::resource('/products', ProductsController::class);

});


/*Route::middleware('auth')->prefix('dashboard')->group(function(){
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', CategoriesController::class);
})*/



?>