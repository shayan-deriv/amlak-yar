<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\PropertyController;
use App\Http\Controllers\Panel\ColleagueController;
use App\Http\Controllers\Panel\AreaController;
use App\Http\Controllers\Panel\ComplexController;
use App\Http\Controllers\Panel\BackupController;
use App\Http\Controllers\Panel\ContactController;

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
        Route::get('/delete', [PropertyController::class,'delete'])->name('delete');
        Route::get('/publish', [PropertyController::class,'publish'])->name('publish');
        Route::get('/archived', [PropertyController::class,'archived'])->name('archived');
        Route::get('/delete-attachment/{attachment}', [PropertyController::class,'deleteAttachment'])->name('delete-attachment');
        Route::get('/duplicate/{property}', [PropertyController::class,'duplicate'])->name('duplicate');
    });

    Route::prefix('areas')->name('areas.')->group(function () {
        Route::get('/', [AreaController::class,'index'])->name('index');
        Route::get('/create', [AreaController::class,'create'])->name('create');
        Route::get('/archived', [AreaController::class,'archived'])->name('archived');
        Route::post('/store', [AreaController::class,'store'])->name('store');
        Route::get('/edit/{area}', [AreaController::class,'edit'])->name('edit');
        Route::patch('/update/{area}', [AreaController::class,'update'])->name('update');
    });

    Route::prefix('complexes')->name('complexes.')->group(function () {
        Route::get('/', [ComplexController::class,'index'])->name('index');
        Route::get('/create', [ComplexController::class,'create'])->name('create');
        Route::post('/store', [ComplexController::class,'store'])->name('store');
        Route::get('/edit/{complex}', [ComplexController::class,'edit'])->name('edit');
        Route::patch('/update/{complex}', [ComplexController::class,'update'])->name('update');
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

    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class,'index'])->name('index');
        Route::get('/create', [ContactController::class,'create'])->name('create');
        Route::post('/store', [ContactController::class,'store'])->name('store');
        Route::get('/edit/{contact}', [ContactController::class,'edit'])->name('edit');
        Route::patch('/update/{contact}', [ContactController::class,'update'])->name('update');
        Route::get('/delete', [ContactController::class,'delete'])->name('delete');
    });

    Route::prefix('archived')->name('archived.')->group(function () {
        Route::get('/properties', [PropertyController::class,'archived'])->name('properties');
        Route::get('/colleagues', [ColleagueController::class,'archived'])->name('colleagues');
    });

    Route::get('/to-be-evacuated', [PropertyController::class,'toBeEvacuated'])->name('to_be_evacuated');

    Route::get('/backup', [BackupController::class,'backup'])->name('backup');


});
