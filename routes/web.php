<?php

use App\Http\Controllers\DetailKategoriController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return redirect()->route('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\FrontendController::class, 'welcome'])->name('welcome');
Route::get('/about', [App\Http\Controllers\FrontendController::class, 'about'])->name('about');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/report/{kabupatenBanding}/{tanggal_mulai}/{tanggal_selesai}', [App\Http\Controllers\HomeController::class, 'reportBanding'])->name('report.banding')->middleware('auth');
Route::get('/report/all', [App\Http\Controllers\HomeController::class, 'reportAll'])->name('report.all')->middleware('auth');
Route::get('/report/{kategori_id}/komoditi', [App\Http\Controllers\HomeController::class, 'reportKomoditi'])->name('report.komoditi')->middleware('auth');

// route/kabupaten
Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index')->middleware('auth');
Route::get('/kabupaten/create', [KabupatenController::class, 'create'])->name('kabupaten.create')->middleware('auth');
Route::post('/kabupaten/store', [KabupatenController::class, 'store'])->name('kabupaten.store')->middleware('auth');
Route::get('/kabupaten/{id}/edit', [KabupatenController::class, 'edit'])->name('kabupaten.edit')->middleware('auth');
Route::put('/kabupaten/{id}/update', [KabupatenController::class, 'update'])->name('kabupaten.update')->middleware('auth');
Route::delete('/kabupaten/{id}/delete', [KabupatenController::class, 'destroy'])->name('kabupaten.destroy')->middleware('auth');

// route kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index')->middleware('auth');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create')->middleware('auth');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store')->middleware('auth');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit')->middleware('auth');
Route::put('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update')->middleware('auth');
Route::delete('/kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware('auth');

// route input komoditi
Route::get('/komoditi/{kategori_id}/index', [DetailKategoriController::class, 'index'])->name('detail.index')->middleware('auth');
Route::get('/komoditi/{kategori_id}/create', [DetailKategoriController::class, 'create'])->name('detail.create')->middleware('auth');
Route::post('/komoditi/{kategori_id}/store', [DetailKategoriController::class, 'store'])->name('detail.store')->middleware('auth');
Route::get('/komoditi/{id}/edit', [DetailKategoriController::class, 'edit'])->name('detail.edit')->middleware('auth');
Route::put('/komoditi/{id}/update', [DetailKategoriController::class, 'update'])->name('detail.update')->middleware('auth');
Route::delete('/komoditi/{id}/delete', [DetailKategoriController::class, 'destroy'])->name('detail.destroy')->middleware('auth');


Route::get('images/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/images/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(500);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return response($file)->header('Content-Type', $type);
})->name('show-image');
