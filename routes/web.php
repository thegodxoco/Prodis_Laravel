<?php

use Illuminate\Support\Facades\App;
use App\Http\Middleware\UserIsAdmin;
use Illuminate\Support\Facades\Auth;

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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfferImageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileImageController;

// use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\Session;

Route::get('/', [OfferController::class, 'index'])->name('root');;

Route::get('/offers/{category?}', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offer/{id}', [OfferController::class, 'show'])->name('offer.show');

Route::middleware('auth')->group(function () {
    Route::middleware('userIsAdmin')->group(function () {
        Route::post('/admin/newoffer', [OfferController::class, 'store'])->name('offers.store');
        Route::get('/admin/newoffer', [OfferController::class, 'create'])->name('offers.create');
        Route::get('/offer/edit/{id}', [OfferController::class, 'edit'])->name('offers.edit');
        Route::put('/offer/{id}', [OfferController::class, 'update'])->name('offers.update');
        Route::delete('/offer/edit/{id}', [OfferController::class, 'destroy'])->name('offers.delete');

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/addcategory', [CategoryController::class, 'addCategory'])->name('storeCategory');
        Route::delete('/deletecategory', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');  

        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/users', [AdminController::class, 'index'])->name('users.index');

        Route::get('/email', [AdminController::class, 'showEmailForm'])->name('emails.create');
        Route::post('/email', [AdminController::class, 'sendEmail'])->name('emails.send');

        Route::delete('/deleteofferimage', [OfferImageController::class, 'destroy'])->name('offers.images.destroy');
        Route::put('/updateofferimage/{offer_id}', [OfferImageController::class, 'update'])->name('offers.images.update');
        
        Route::get('/report/{offer_id}', [OfferController::class, 'generateOfferVolunteerReport'])->name('reports.offer_volunteers');
        
    });
    Route::post('/offer/{id}', [OfferController::class, 'subscribe'])->name('offers.subscribe');
    Route::delete('/offer/{id}', [OfferController::class, 'unsubscribe'])->name('offers.unsubscribe');
    Route::get('/profile', [UserController::class, 'show'])->name('users.show');
    //Route::put('/profile', [UserController::class, 'update'])->name('users.update');

    // CRUD Users:
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id?}', [UserController::class, 'update'])->name('users.update');

    // CRUD User profile image:
    Route::post('/user/image/{user_id}', [ProfileImageController::class, 'store'])->name('users.image.store');
    Route::put('/user/image/{user_id}', [ProfileImageController::class, 'update'])->name('users.image.update');
    Route::delete('/user/image{id}', [ProfileImageController::class, 'destroy'])->name('users.image.destroy');

});

Route::get('/language/{locale}', function($locale) {
    App::setLocale($locale);
    Session::put('locale', $locale);
    return redirect()->back();
    // if (isset($locale) && in_array($locale, config('app.available_locales'))){
    //     App::setLocale($locale);
    // }
});

Auth::routes();








