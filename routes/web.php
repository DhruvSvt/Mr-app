<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ChemistController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StrengthController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
    return view('admin.index');
})->name('index')->middleware('auth');

Route::middleware('auth')->prefix('admin')->group(function () {

    /* -------------------- City Resource -------------------- */
    Route::resource('city', CityController::class);

    /* -------------------- Area Resource -------------------- */
    Route::resource('area', AreaController::class);

    /* -------------------- Product Resource -------------------- */
    Route::resource('product', ProductController::class);

    /* -------------------- Strength Resource -------------------- */
    Route::resource('strength', StrengthController::class);

    /* -------------------- Speciality Resource -------------------- */
    Route::resource('speciality', SpecialityController::class);

    /* -------------------- Doctor Resource -------------------- */
    Route::resource('doctor', DoctorController::class);

    /* -------------------- Chemist Resource -------------------- */
    Route::resource('chemist', ChemistController::class);

    /* -------------------- Global Status Resource -------------------- */
    Route::post('status', [StatusController::class, 'statusUpdate'])->name('status');
});

/* -------------------- Migration Command -------------------- */
Route::get('migrate', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('migrate');
});


/* -------------------- Storage Link Command -------------------- */
Route::get('/storagelink', function () {
    $target = storage_path('app/public');
    $link = public_path('/storage');
    echo symlink($target, $link);
    echo "symbolic link created successfully";
});

Auth::routes();
