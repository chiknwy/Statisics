<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/create', function () {
    return view('user.create');
});

//user
Route::get('/user/index', [MahasiswaController::class, 'index'])->name('user.index');
Route::get('/user/create', [MahasiswaController::class, 'create'])->name('user.create');
Route::get('/user/update/{id}', [MahasiswaController::class, 'update'])->name('user.update');
Route::post('/user/create', [MahasiswaController::class, 'store'])->name('user.store');
Route::delete('/user/delete/{id}', [MahasiswaController::class, 'destroy'])->name('user.delete');
Route::post('/user/update/{id}', [MahasiswaController::class, 'updateMahasiswa'])->name('user.updateMahasiswa');
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

// scores 
Route::get('/scores/index', [ScoreController::class, 'index'])->name('scores.index');
Route::get('/scores/create', [ScoreController::class, 'create'])->name('scores.create');
Route::get('/scores/update/{id}', [ScoreController::class, 'update'])->name('scores.update');
Route::post('/scores/create', [ScoreController::class, 'store'])->name('scores.store');
Route::delete('/scores/delete/{id}', [ScoreController::class, 'destroy'])->name('scores.delete');
Route::post('/scores/update/{id}', [ScoreController::class, 'updateScores'])->name('scores.updateScores');
Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
Route::get('/liliefors', [ScoreController::class, 'liliefors'])->name('liliefors');
Route::get('export/', [ScoreController::class, 'export']); #disesuaikan
Route::get('import/', function () {
    return view('scores.import');
   });
Route::post('import/', [ScoreController::class, 'import'])->name('import');
Route::get('/tableujit', [ScoreController::class, 'ujiT']);
Route::get('/biserial', [ScoreController::class, 'biserial']);


Route::get('/scores/bergolong', [ScoreController::class, 'bergolong'])->name('scores.bergolong');
Route::get('/bergolong', [ScoreController::class, 'dataBergolong']);
Route::get('/frekuensi', [ScoreController::class, 'distribusiFrekuensi']);
Route::get('/chitable', [ScoreController::class, 'getChiSqure']);
Route::post('/chitable', [ScoreController::class, 'calculateChiSqure'])->name('chi');
Route::get('/deskripsi', [ScoreController::class, 'calculateStatistics']);



// Route::get('/scores/create', [ScoreController::class, 'create'])->name('scores.create');
// Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
// Route::get('/scores/{id}', [ScoreController::class, 'show'])->name('scores.show');
// Route::get('/scores/{id}/edit', [ScoreController::class, 'edit'])->name('scores.edit');
// Route::put('/scores/{id}', [ScoreController::class, 'update'])->name('scores.update');
// Route::delete('/scores/{id}', [ScoreController::class, 'destroy'])->name('scores.destroy');
