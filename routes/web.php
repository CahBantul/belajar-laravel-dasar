<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
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
Route::get('/controller/hello/request', [HelloController::class, "request"]);
Route::get('/controller/hello/{name}', [HelloController::class, "hello"]);

Route::get('/input/get', [InputController::class, "hello"]);
Route::post('/input/post', [InputController::class, "hello"]);
Route::post('/input/post/first', [InputController::class, "helloFirstname"]);
Route::post('/input/hello/input', [InputController::class, "helloInput"]);
Route::post('/input/hello/array', [InputController::class, "helloArray"]);
Route::post('/input/type', [InputController::class, "inputType"]);
Route::post('/input/only', [InputController::class, "filterOnly"]);
Route::post('/input/except', [InputController::class, "filterExcept"]);
Route::post('/input/merge', [InputController::class, "filterMerge"]);

Route::post('/file/upload', [FileController::class, "upload"]);
Route::get('/response/hello', [ResponseController::class, "response"]);
Route::get('/response/header', [ResponseController::class, "header"]);
Route::get('/response/type/view', [ResponseController::class, "responseView"]);
Route::get('/response/type/json', [ResponseController::class, "responseJson"]);
Route::get('/response/type/file', [ResponseController::class, "responseFile"]);
Route::get('/response/type/download', [ResponseController::class, "responseDownload"]);

Route::get('/cookie/set', [CookieController::class, "createCookie"]);
Route::get('/cookie/get', [CookieController::class, "getCookie"]);
Route::get('/cookie/clear', [CookieController::class, "clearCookie"]);

Route::get('/middleware/api', fn () => "Ok")->middleware(["contoh:NZM,401"]);
Route::get('/middleware/group', fn () => "GROUP")->middleware(["nzm"]);