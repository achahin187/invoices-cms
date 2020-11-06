<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('auth.login');
});



///route for auth (login)
Auth::routes();
///route for home
Route::get('/home', 'HomeController@index')->name('home');

/// route for invoices
Route::resource('invoices', 'invoiceController');
/// route for sections
Route::resource('sections', 'SectionController');
///route for products
Route::resource('products', 'productController');

////route for inter for all pages 
Route::get('/{page}', 'AdminController@index');
