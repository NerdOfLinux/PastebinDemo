<?php

use App\Http\Controllers\PasteController;
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
    return view('home');
});

Route::get('paste/{paste:slug}', [PasteController::class, 'show'])->name('paste.show');
Route::get('paste/{paste:slug}/edit', [PasteController::class, 'edit'])->name('paste.edit');
