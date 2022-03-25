<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MotivoController;

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


Route::get('/hola', function () {
    return 'Hola mundo';
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/tab1', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab1');
Route::get('/tab2', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab2');
Route::get('/tab1', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab1');
Route::get('/tab3', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab3');
Route::get('/tab4', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab4');
Route::get('/tab5', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('tab5');


// Route::get('store', 'MotivoController@store')->name('store');
// Route::post('/motivos/edit', 'MotivoController@edit')->name('motivos.edit');
//Rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('settings', ConfiguracionController::class);
    Route::resource('lineas', LineaController::class);
    Route::resource('timers', TimerController::class);
    Route::resource('motivos', MotivoController::class);
    Route::resource('productos', ProductoController::class);
});


