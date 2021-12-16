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
use App\Http\Controllers\TodosController;
use App\Http\Controllers\ThemesController;

// Route::get('/', [TodosController::class, 'liste']);
Route::get('/', function () {
    return view('welcome', ["title" => "Welcome"]);
});
Route::get('compteur',[TodosController::class,'compteurListe'])->name('compteur');
Route::get('liste', [TodosController::class, 'liste'])->name('liste');
Route::get('liste/{theme}', [TodosController::class, 'listeParTheme'])->name('listeParTheme');
Route::post('liste/add', [TodosController::class, 'store'])->name('store');
Route::post('liste/{id}/remove', [TodosController::class, 'delete'])->name('delete');
Route::post('liste/{id}/edit', [TodosController::class, 'setTermine'])->name('termine');
Route::post('liste/{id}/update', [TodosController::class, 'update'])->name('update');
Route::post('liste/{id}/important', [TodosController::class, 'important'])->name('important');
Route::post('liste/themes/add', [ThemesController::class, 'addTheme'])->name('addTheme');
Route::post('liste/themes/delete', [ThemesController::class, 'deleteTheme'])->name('deleteTheme');
