<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('base');

Route::post('generate-link', 'LinkController@store')->name('generate.link.post');
Route::get('{code}', 'LinkController@shortenLink')->name('shorten.link');
//Route::get('qr-code-g', function () {
//    \QrCode::size(500)
//        ->format('png')
//        ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
//
//    return view('qrCode');
//
//});
