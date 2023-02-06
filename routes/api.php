<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('books', BookController::class, ['except' => ['edit', 'create']]);
Route::get('books/find-by-author/{id}', [BookController::class, 'findByAuthor']);
Route::resource('authors', AuthorController::class, ['except' => ['edit', 'create']]);
Route::get('authors/find/{name}', [AuthorController::class, 'findByName']);
Route::post('authors/bind/{authorId}/{bookId}', [AuthorController::class, 'bindToBook']);
