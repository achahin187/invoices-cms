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
Auth::routes(['register' => false]);
///route for home
Route::get('/home', 'HomeController@index')->name('home');

/// route for invoices
Route::resource('invoices', 'invoiceController');
/// route for sections
Route::resource('sections', 'SectionController');
///route for products
Route::resource('products', 'productController');
///route for invoices detials
Route::resource('InvoicesDetails', 'InvoicesDetailsController');
///route invoices attatchments
Route::resource('InvoicesDetails/InvoicesAttachments', 'InvoicesAttachmentsController');
///route for show attatchents
Route::get('View_file/{invoice_number}/{file_name}','InvoicesDetailsController@open_file');
/////route for download att
Route::get('download/{invoice_number}/{file_name}','InvoicesDetailsController@get_file');
///route for delete invoices and att
Route::post('delete_file','InvoicesDetailsController@destroy')->name('delete_file');
///////route for edit for invoice
Route::get('/edit_invoice/{id}','invoiceController@edit');
///route for change payment status
Route::get('/Status_show/{id}', 'invoiceController@show')->name('Status_show');
Route::post('/Status_Update/{id}', 'invoiceController@Status_Update')->name('Status_Update');
/////routes for invoices types
Route::get('Invoice_Paid','invoiceController@Invoice_Paid');

Route::get('Invoice_UnPaid','invoiceController@Invoice_UnPaid');
///route for get products
Route::get('/section/{id}','invoiceController@getProducts');

Route::get('Invoice_Partial','invoiceController@Invoice_Partial');
///////////route for archive invoices
Route::resource('Archive', 'InvoiceArchiveController');
//////route for print invoices
Route::get('Print_invoice/{id}','invoiceController@Print_invoice');
/////////export invoices to excel
Route::get('export_invoices', 'invoiceController@export')->name('export');



//////////create route for permissions and roles
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});











////route for inter for all pages 
Route::get('/{page}', 'AdminController@index');
