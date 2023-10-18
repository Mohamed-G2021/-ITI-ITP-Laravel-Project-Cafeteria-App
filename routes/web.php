<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use  App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CheckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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
    return view("welcome");
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/process-data', [OrderProductController::class, 'confirm_order'])->name('process-data');
Route::resource('admin-users', AdminController::class)->middleware('can:admin-access');
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('orders', OrderController::class);
Route::resource('order-products', OrderProductController::class);
Route::get('/selects',  [OrderController::class, 'filter'])->name('select.filter');
Route::get('/select',  [AdminOrderController::class, 'filter'])->name('adminfilter.filter');
Route::resource('/admins-orders', AdminOrderController::class);
Route::resource('checks', CheckController::class);


Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();
//  dd($googleUser);
    $user = User::where('email', $googleUser->email)->first();

    if (!$user) {
     
   
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' =>$googleUser->name,
            'email' => $googleUser->email,
            'password'=> null,
             'google_token' =>$googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
      }

    Auth::login($user);

    return redirect('/order-products');
});

