<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDo\ListsController;
use App\Http\Controllers\ToDo\FinishListController;
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
Route::group(['middleware' => 'auth'],function() {
    Route::resource('/lists',ListsController::class)->except('update','destroy','show');
    Route::get('lists/{list}',[ListsController::class,'show'])->middleware('list')->name('lists.show');
    Route::post('lists/{list}',[ListsController::class, 'update'])->middleware('list')->name('lists.update');
    Route::post('lists/destroy/{list}',[ListsController::class, 'destroy'])->middleware('list')->name('lists.destroy');
    Route::post('lists/finish/{list}',[FinishListController::class,'index'])->middleware('list')->name('list.finish');
    Route::post('lists/change/{list}',[\App\Http\Controllers\ToDo\ImageController::class,'changePhoto'])->middleware('list')->name('edit.photo');
    Route::post('lists/delete/{list}',[\App\Http\Controllers\ToDo\ImageController::class,'destroy'])->middleware('list')->name('delete.photo');


});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',function () {
   return redirect()->route('login');
});


Auth::routes();


