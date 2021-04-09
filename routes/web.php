<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FacebookRegistrationController;
use App\Http\Controllers\AppController;
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


Route::get('/aaa', function () {

    $i = 42;
    $i++;

    echo $i;
});


Auth::routes();

Route::get('{any}', [AppController::class, 'index'])
    ->where('any', '.*')
    ->middleware('auth')
    ->name('home');

/*Route::post('/facebookregistration', [FacebookRegistrationController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

///// probably not used:
//Route::get('/facebookregistration', function () {
//    return view('facebookregistration');
//});
