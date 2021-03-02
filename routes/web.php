<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/',[ProductController::class,'mainpage']);

// Route::get('/login', function () {
//     return view('theme.login');
// });
// Route::post('/login',[UserController::class,'login']);

// Route::get('/register', function () {
//     return view('theme.register');
// });
// Route::post('/register',[UserController::class,'register']);

Route::get('/search',[ProductController::class,'search']);

Route::get('/price_range',[ProductController::class,'priceRange']);

Route::get('/user/verify/{token}', [UserController::class,'Userverify']);


Route::get('/shop',[ProductController::class,'index']);

Route::get('product/{id}',[ProductController::class,'detail']);

Route::get('/category/{id}',[ProductController::class,'catview']);

// Route::get('/forgot-password',[UserController::class,'forgotPassword']);





Route::middleware(['logincheck'])->group(function () {
    // Route::get('logout',[UserController::class,'logout']);
    
    Route::get('/cart',[ProductController::class,'cartlist']);
    
    Route::post('add_to_cart',[ProductController::class,'addtocart']);
    
    Route::get('/ordernow',[ProductController::class,'ordernow']);

    Route::post('/orderplace',[ProductController::class,'orderPlace']);

    Route::get('/myorder',[ProductController::class,'myOrder']);

    Route::get('/removecart/{id}',[ProductController::class,'removeCart']);

    Route::get('event', [PayController::class,'index']);
    Route::post('pay', [PayController::class,'pay']);
    Route::get('pay-success', [PayController::class,'success']);
});

// Route::view('/invoice','theme.invoice');

Route::view('admin','admin.login');
Route::post('admin',[AdminController::class,'login']);

// Route::get('forgot-password',[AdminController::class,'forgotPassword'])->middleware(['guest'])->name('password.request');
// Route::post('/forgot-password',[AdminController::class,'forgotPasswordpost'])->middleware(['guest'])->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware(['guest'])->name('password.reset');

// Route::post('/reset-password', function(Request $request) {
//     $request->validate([
//         'token' => 'required',
//         'email' => 'required|email',
//         'password' => 'required|min:8|confirmed',   
//     ]);
    

//     $status = Password::reset(
//         $request->only('email', 'password', 'password_confirmation', 'token'),
//         function ($user, $password) use ($request) {
//             $user->forceFill([
//                 'password' => Hash::make($password)
//             ])->save();
               
//             $user->setRememberToken(Str::random(60));

//             event(new PasswordReset($user));
//         }
//     );

//     return $status == Password::PASSWORD_RESET
//                 ? redirect('login')->with('status', __($status))
//                 : back()->withErrors(['email' => __($status)]);
// })->middleware(['guest'])->name('password.update');

Route::middleware(['admincheck'])->group(function () {

    Route::view('home','admin.index');

    Route::get('admin_category',[AdminController::class,'showCategory'])->name('category');

    Route::get('/delete/{id}',[AdminController::class,'deleteCategory']);

    Route::post('add_category',[admincontroller::class,'addCategory']);


    Route::get('/admin_products',[AdminController::class,'showProduct'])->name('products');

    Route::get('/addproduct',[AdminController::class,'showaddProduct'])->name('addproduct');

    Route::post('/add_product',[AdminController::class,'addProduct']);

    Route::get('/remove/{id}',[AdminController::class,'deleteProduct']);

    Route::post('/update/{id}',[AdminController::class,'updateProduct']);


    Route::get('/orderlist',[AdminController::class,'orderList'])->name('order');

    Route::get('/poster',[AdminController::class,'poster'])->name('poster');

    Route::post('/addposter',[AdminController::class,'addPoster'])->name('addposter');

    Route::get('/removeposter/{id}',[AdminController::class,'removePoster']);

    Route::post('/orderstatus',[AdminController::class,'postStatus']);

    Route::get('/userlist',[AdminController::class,'userList'])->name('user');

    Route::get('/alogout',[AdminController::class,'logout']);

    Route::get('/receipt/{id}',[AdminController::class,'receipt']);


});

Route::fallback(function(){
    return view('404');
});

