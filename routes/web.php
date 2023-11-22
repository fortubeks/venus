<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
	Route::resource('users', 'App\Http\Controllers\UserController');
	Route::resource('expenses', 'App\Http\Controllers\ExpenseController');
	Route::resource('suppliers', 'App\Http\Controllers\SupplierController');
	Route::resource('expense-categories', 'App\Http\Controllers\ExpenseCategoryController');
	Route::resource('expense-payments', 'App\Http\Controllers\ExpensePaymentController');
	Route::resource('purchases', 'App\Http\Controllers\PurchaseController');
	Route::resource('store-items', 'App\Http\Controllers\StoreItemController');
	Route::resource('room-reservations', 'App\Http\Controllers\RoomReservationController');
	Route::resource('venue-reservations', 'App\Http\Controllers\VenueReservationController');
	Route::resource('rooms', 'App\Http\Controllers\RoomController');
	Route::resource('room-categories', 'App\Http\Controllers\RoomCategoryController');

	Route::post('filter-expenses', 'App\Http\Controllers\ExpenseController@filterExpenses');

	Route::post('/updatePassword', 'App\Http\Controllers\UserController@updatePassword');
	
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
	Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

	Route::get('settings/{tab}', 'App\Http\Controllers\SettingsController@goToPage');
	
	Route::put('settings/hotel-information', 'App\Http\Controllers\SettingsController@updateHotelInfo');
});
