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
        // Route::get('/show/{property?}', 'PropertyController@show')->name('show');
        // Route::get('/edit/{property?}', 'PropertyController@edit')->name('edit');
        // Route::patch('/update/{property}', 'PropertyController@update')->name('update');
        // Route::get('/remove/{property}', 'PropertyController@remove')->name('remove');
        // Route::get('/delete', 'PropertyController@delete')->name('delete');
        // Route::get('/fetch', 'PropertyController@fetch')->name('fetch');
        // Route::get('/fetch_deactivate', 'PropertyController@fetch_deactivate')->name('fetch_deactivate');
        // Route::get('/count', 'PropertyController@count')->name('count');
        // Route::get('/count_deactivate', 'PropertyController@count_deactivate')->name('count_deactivate');
        // Route::get('/activate/{property?}', 'PropertyController@activate')->name('activate');
        // Route::get('/deactivate/{property?}', 'PropertyController@deactivate')->name('deactivate');
    });

    Route::prefix('areas')->name('areas.')->group(function () {
        Route::get('/', [AreaController::class,'index'])->name('index');
        Route::get('/create', [AreaController::class,'create'])->name('create');
        Route::get('/archived', [AreaController::class,'archived'])->name('archived');
        Route::post('/store', [AreaController::class,'store'])->name('store');
        // Route::get('/show/{property?}', 'PropertyController@show')->name('show');
        // Route::get('/edit/{property?}', 'PropertyController@edit')->name('edit');
        // Route::patch('/update/{property}', 'PropertyController@update')->name('update');
        // Route::get('/remove/{property}', 'PropertyController@remove')->name('remove');
        // Route::get('/delete', 'PropertyController@delete')->name('delete');
        // Route::get('/fetch', 'PropertyController@fetch')->name('fetch');
        // Route::get('/fetch_deactivate', 'PropertyController@fetch_deactivate')->name('fetch_deactivate');
        // Route::get('/count', 'PropertyController@count')->name('count');
        // Route::get('/count_deactivate', 'PropertyController@count_deactivate')->name('count_deactivate');
        // Route::get('/activate/{property?}', 'PropertyController@activate')->name('activate');
        // Route::get('/deactivate/{property?}', 'PropertyController@deactivate')->name('deactivate');
    });

    Route::prefix('complexes')->name('complexes.')->group(function () {
        Route::get('/', [ComplexController::class,'index'])->name('index');
        Route::get('/create', [ComplexController::class,'create'])->name('create');
        Route::post('/store', [ComplexController::class,'store'])->name('store');
        Route::get('/edit/{complex}', [ComplexController::class,'edit'])->name('edit');
        Route::patch('/update/{complex}', [ComplexController::class,'update'])->name('update');
        Route::get('/archive', [ComplexController::class,'archive'])->name('archive');
    });

    Route::prefix('colleagues')->name('colleagues.')->group(function () {
        Route::get('/', 'ColleagueController@index')->name('index');
        Route::get('/archived', 'PropertyController@index')->name('archived');
        Route::get('/create', 'ColleagueController@create')->name('create');
        Route::post('/store', 'ColleagueController@store')->name('store');
        Route::get('/show/{colleague?}', 'ColleagueController@show')->name('show');
        Route::get('/edit/{colleague?}', 'ColleagueController@edit')->name('edit');
        Route::patch('/update/{colleague}', 'ColleagueController@update')->name('update');
        Route::get('/fetch', 'ColleagueController@fetch')->name('fetch');
        Route::get('/fetch_deactivate', 'ColleagueController@fetch_deactivate')->name('fetch_deactivate');
        Route::get('/count', 'ColleagueController@count')->name('count');
        Route::get('/count_deactivate', 'ColleagueController@count_deactivate')->name('count_deactivate');
        Route::get('/archive/{colleague?}', 'ColleagueController@activate')->name('activate');
        Route::get('/unarchive/{colleague?}', 'ColleagueController@deactivate')->name('deactivate');
    });

});
