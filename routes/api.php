<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('get_manifest', 'API\ManifestController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('get_manifest', 'API\ManifestController@index');
Route::post('get_bill_of_lading', 'API\BillOfLaddingController@index');

// product
Route::post('get_product', 'API\ProductController@index');
Route::get('get_product/detail/{id}', 'API\ProductController@detail');
Route::post('get_product/detail/{id}/process', 'API\ProductController@process');


Route::get('get_from_to', 'API\LocatinController@index');



