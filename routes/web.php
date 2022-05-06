<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionstopController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\OrderController;



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
    return view('auth.login');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/tab1', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab1');
Route::get('/tab2', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab2');
Route::get('/tab1', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab1');
Route::get('/tab3', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab3');
Route::get('/tab4', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab4');
Route::get('/tab5', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab5');



Route::get('store', 'ProductionstopController@store')->name('store');
// Route::post('/motivos/edit', 'MotivoController@edit')->name('motivos.edit');
//Rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('settings', ConfiguracionController::class);
    Route::resource('lineas', LineController::class);
    Route::resource('timers', TimerController::class);
    Route::resource('motivos', ProductionstopController::class);
    Route::resource('products', ProductController::class);
    Route::resource('machines', MachineController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/turns/{id}', [OrderController::class, 'turns'])->name('turns');
    Route::get('/productsfiltered/{id}', [OrderController::class, 'products'])->name('productsfiltered');
    
});


