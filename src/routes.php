<?php

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

Route::get('home', 'Checkitsedo\Esrpaymentslip\Controllers\HomeController@index')->name('home');

Route::get('admin/routes', 'Checkitsedo\Esrpaymentslip\Controllers\HomeController@admin')->middleware('admin');

Route::get('/pdf/{id}', 'Checkitsedo\Esrpaymentslip\Controllers\EsrpaymentslipController@download')->name('esrpaymentslips.download');

Route::resource('esrpaymentslips','Checkitsedo\Esrpaymentslip\Controllers\EsrpaymentslipController');
