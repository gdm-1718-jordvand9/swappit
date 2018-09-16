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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Routes that involve some sort of authentication.
|
*/



Route::post('signup', 'Api\AuthController@signUp');
Route::post('signin', 'Api\AuthController@signIn');

Route::group(['middleware' => ['auth:api', 'verified']], function () {
    Route::post('deactivate', 'Api\AccountController@destroy');
    Route::patch('tickets/toggle_published/{id}','Api\TicketController@toggle_published');
    Route::get('account', 'Api\AccountController@index');
    Route::delete('account/delete','Api\AccountController@delete');
    Route::get('account/tickets','Api\TicketController@account_index');
    Route::patch('account', 'Api\AccountController@update');
    Route::get('account', 'Api\AuthController@account');
    Route::get('orders', 'Api\OrderController@index');
    Route::get('logout', 'Api\AuthController@logout');
});

Route::get('account/{token}/restore', 'Api\AccountController@restore');
Route::post('account/restoreMail', 'Api\AccountController@restoreMail');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
|
| Routes that are connected to resource controllers.
|
*/

Route::resource('tickets', 'Api\TicketController');
Route::resource('orders', 'Api\OrderController');
Route::resource('festivals', 'Api\FestivalController');
Route::resource('ticket_types', 'Api\TicketTypeController');

Route::patch('tickets/bump/{id}', 'Api\TicketController@bump');
Route::post('ticket_types/want/{id}', 'Api\TicketTypeController@store_want');

//Route::resource('tickets', 'Api\TicketController');

/*
|--------------------------------------------------------------------------
| Viewmodel Routes
|--------------------------------------------------------------------------
|
| Routes that are connected to viewmodels.
|
*/
Route::get('vm_ticket_types/{id}', 'Api\VMController@vm_ticket_types');
Route::get('vm_ticket_types_info/{id}','Api\VMController@vm_ticket_types_info');
Route::get('vm_festivals', 'Api\VMController@vm_festivals');
/*Route::get('vm_ticket_types/{id}', function($id) {
    $tickettypes = \App\TicketType::where('festival_id', $id)->pluck('name', 'id')->all();
    return Response::json($tickettypes);
});*/

/*Route::get('vm_festivals', function() {
    $festivals = \App\Festival::pluck('name', 'id')->all();
    return Response::json($festivals);
});*/
/*
|--------------------------------------------------------------------------
| Shoppingcart Routes
|--------------------------------------------------------------------------
|
| Routes that are connected to shoppingcart.
|
*/
Route::post('tickets/availableandsold','Api\TicketController@indexAvailableAndSold');
Route::post('orders/pay/{id}', 'Api\OrderController@pay');
Route::post('orders/cancel/{id}', 'Api\OrderController@cancel');

