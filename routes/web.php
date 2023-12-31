<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::prefix("/response/type")->group(function () {
    Route::get('/view', [ResponseController::class, "responseView"]);
    Route::get('/json', [ResponseController::class, "responseJson"]);
    Route::get('/file', [ResponseController::class, "responseFile"]);
    Route::get('/download', [ResponseController::class, "responseDownload"]);
});

Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set',  "createCookie");
    Route::get('/cookie/get',  "getCookie");
    Route::get('/cookie/clear',  "clearCookie");
});

Route::middleware(["contoh:NZM,401"])->prefix("/middleware")->group(function () {
    Route::get('/api', fn () => "Ok");
    Route::get('/group', fn () => "GROUP");
});

Route::get('/form', [FormController::class, "index"]);
Route::post('/form', [FormController::class, "store"]);

Route::get('/url/current', function () {
    return URL::full();
});

Route::get('/url/action', function () {
    return action([FormController::class, "index"]);
});

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/error/sample', function () {
    throw new Exception("Sample Error");
});

Route::get('/error/manual', function () {
    report(new Exception('sample Error'));
    return 'OK';
});

Route::get('/error/validation', function () {
    throw new ValidationException("validation Error");
});

Route::get('/abort/400', function () {
    abort(400, "ups Error");
});

Route::get('/abort/401', function () {
    abort(401);
});

Route::get('/abort/500', function () {
    abort(500);
});
