<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [FrontendController::class, 'index']);
Route::get('/cate', [FrontendController::class, 'category']);
Route::get('category-products/{slug}', [FrontendController::class,'cateproduct']);
Route::get('category/{cate_slug}/{pro_slug}', [FrontendController::class, 'prodetails']);

Route::middle(['auth'])->group(function (){
    Route::post('/add-to cart', [CartController::class, 'prodcart']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function()
{

    Route::get('/dashboard', [CategoryController::class ,'index']);
    Route::get('/category', [CategoryController::class ,'add']);
    Route::post('insert', [CategoryController::class ,'insert']);
    Route::get('/category-list',[CategoryController::class,'list']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('update/{id}', [CategoryController::class ,'update']);
    Route::get('/delete/{id}', [CategoryCOntroller::class, 'delete']);

    Route::get('/products', [ProductController::class, 'products']);
    Route::get('/add-products', [ProductController::class, 'add']);
    Route::post('/insert', [ProductController::class, 'insert']);
    Route::get('/delete/{id}', [ProductController::class, 'delete']);
    Route::put('/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
});