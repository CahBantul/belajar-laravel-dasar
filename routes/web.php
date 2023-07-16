<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nozami', fn () => "Hello Nozami");

Route::redirect("/youtube", "/nozami");

Route::fallback(fn () => "404 by Nozami");

Route::view('/hello', "hello", ["name" => "nozami"]);

Route::view('/hello-world', 'hello.world', ["name" => "ajitama"]);

Route::get('/products/{id}', fn ($productId) => "product $productId")->name("product.detail");
Route::get('/products/{product}/items/{item}', fn ($productId, $itemId) => "Product $productId item $itemId")->name('product.item.detail');
Route::get('/users/{id?}', fn ($userId = "404") => "User $userId")->name("user.detail");
Route::get('/categories/{id}', fn ($categoryId) => "Category $categoryId")->where("id", "[0-9]+")->name("category.detail");

Route::get('/conflict/nozami', fn () => "Fardan Nozami");
Route::get('/conflict/{name}', fn (string $name) => "conflict $name");

Route::get('/produk/{id}', function ($id) {
    $link = route("product.detail", ["id => $id"]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', fn ($id) => redirect()->route("product.detail", ["id" => $id]));
