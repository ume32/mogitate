<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // 商品登録フォーム表示
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // 商品登録処理
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show'); // 商品詳細ページ
Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // 商品更新
Route::patch('/products/{product}/image', [ProductController::class, 'updateImage'])->name('products.updateImage'); // 商品画像の更新
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // 商品削除

