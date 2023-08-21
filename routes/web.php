<?php

use App\Exports\NilaisExport;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::resource('/user', UserController::class);
Route::resource('/matkul', MatkulController::class);
Route::resource('/nilai', NilaiController::class);
Route::resource('/kriteria', KriteriaController::class);
Route::resource('/hak-akses', HakAksesController::class);
Route::resource('/kelas', KelasController::class);
Route::resource('/assignment', AssignmentController::class);
Route::resource('/submission', SubmissionController::class);
Route::resource('/exam', ExamController::class);
Route::get('export-csv', function () {
    return Excel::download(new NilaisExport, 'nilai.csv');
});
Route::get('/nilai/search/', [NilaiController::class, 'search']);
Route::post('join', [KelasController::class, 'join'])->name('kelas.join');
Route::post('/loginApi', [UserController::class, 'login'])->name('user.login');
Route::get('/fill-krs/{token}', [MahasiswaController::class, 'fill'])->name('krs.fill');
Route::post('/fill-krs/{token}', [MahasiswaController::class, 'post'])->name('krs.post');
Route::get('/class/{id}', [DosenController::class, 'show_class'])->name('class.detail');
