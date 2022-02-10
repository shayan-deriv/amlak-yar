<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\PropertyController;
use App\Http\Controllers\Panel\ColleagueController;
use App\Http\Controllers\Panel\AreaController;
use App\Http\Controllers\Panel\ComplexController;

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
})->name('home');

Route::get('settings', function () {
    return view('panel.admin.settings');
})->name('settings.show');

Route::post('settings', 'Panel\SettingsController@transaction')->name('settings.store');


Route::get('login', function () {
    return redirect()->route('home');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout',  [AuthController::class, 'logout'])->name('logout');

Route::namespace('Panel')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::prefix('properties')->name('properties.')->group(function () {
        Route::get('/', [PropertyController::class,'index'])->name('index');
        Route::get('/create', [PropertyController::class,'create'])->name('create');
        Route::get('/archived', [PropertyController::class,'archived'])->name('archived');
        Route::post('/store', [PropertyController::class,'store'])->name('store');
        Route::get('/edit/{property}', [PropertyController::class,'edit'])->name('edit');
        Route::patch('/update/{property}', [PropertyController::class,'update'])->name('update');
        Route::get('/archive', [PropertyController::class,'archive'])->name('archive');
        Route::get('/publish', [PropertyController::class,'publish'])->name('publish');
        Route::get('/archived', [PropertyController::class,'archived'])->name('archived');
    });

    Route::prefix('areas')->name('areas.')->group(function () {
        Route::get('/', [AreaController::class,'index'])->name('index');
        Route::get('/create', [AreaController::class,'create'])->name('create');
        Route::get('/archived', [AreaController::class,'archived'])->name('archived');
        Route::post('/store', [AreaController::class,'store'])->name('store');
        Route::get('/edit/{area}', [AreaController::class,'edit'])->name('edit');
        Route::patch('/update/{area}', [AreaController::class,'update'])->name('update');
        Route::get('/archive', [AreaController::class,'archive'])->name('archive');
        Route::get('/publish', [AreaController::class,'publish'])->name('publish');
        Route::get('/archived', [AreaController::class,'archived'])->name('archived');

    });

    Route::prefix('complexes')->name('complexes.')->group(function () {
        Route::get('/', [ComplexController::class,'index'])->name('index');
        Route::get('/create', [ComplexController::class,'create'])->name('create');
        Route::post('/store', [ComplexController::class,'store'])->name('store');
        Route::get('/edit/{complex}', [ComplexController::class,'edit'])->name('edit');
        Route::patch('/update/{complex}', [ComplexController::class,'update'])->name('update');
        Route::get('/archive', [ComplexController::class,'archive'])->name('archive');
        Route::get('/publish', [ComplexController::class,'publish'])->name('publish');
        Route::get('/archived', [ComplexController::class,'archived'])->name('archived');
    });

    
    Route::prefix('colleagues')->name('colleagues.')->group(function () {
        Route::get('/', [ColleagueController::class,'index'])->name('index');
        Route::get('/create', [ColleagueController::class,'create'])->name('create');
        Route::post('/store', [ColleagueController::class,'store'])->name('store');
        Route::get('/edit/{complex}', [ColleagueController::class,'edit'])->name('edit');
        Route::patch('/update/{complex}', [ColleagueController::class,'update'])->name('update');
        Route::get('/archive', [ColleagueController::class,'archive'])->name('archive');
        Route::get('/publish', [ColleagueController::class,'publish'])->name('publish');
        Route::get('/archived', [ColleagueController::class,'archived'])->name('archived');
    });


});
