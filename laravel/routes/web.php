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

Route::get('/', function () {
    return redirect('/home');
});
// SuperAdmin middleware
Route::group(['middleware' => ['role:superadmin','auth','verified']], function() {
    Route::resource('users', 'UserController');
    Route::patch('users/{user}/restore', 'UserController@restore');
    Route::delete('users/{user}/delete', 'UserController@delete');
    Route::patch('users/{user}/verify', 'VerifyController@verifyByUser');
    // Admin middleware
    Route::group(['middleware' => ['role:admin,superadmin']], function() {
        Route::resource('orders', 'OrderController');
        Route::patch('orders/{order}/restore', 'OrderController@restore');
        Route::delete('orders/{order}/delete', 'OrderController@delete');
        Route::patch('orders/{order}/cancel', 'OrderController@cancel');
        Route::patch('orders/{order}/complete', 'OrderController@complete');
        Route::resource('ticket_types', 'TicketTypeController');
        Route::patch('ticket_types/{ticket_type}/restore', 'TicketTypeController@restore');
        Route::delete('ticket_types/{ticket_type}/delete', 'TicketTypeController@delete');
        Route::resource('festivals', 'FestivalController');
        Route::patch('festivals/{festival}/restore', 'FestivalController@restore');
        Route::delete('festivals/{festival}/delete', 'FestivalController@delete');
        Route::resource('tickets', 'TicketController');
        Route::patch('tickets/{ticket}/restore', 'TicketController@restore');
        Route::delete('tickets/{ticket}/delete', 'TicketController@delete');
    });
});


Route::get('/tickets/ddtickettypes/{id}', function($id) {
    $tickettypes = \App\TicketType::where('festival_id', $id)->pluck('name', 'id')->all();
    return Response::json($tickettypes);
});







// Token
Route::get('/token', function() {
    return Auth::user()->createToken('test');
});

// Verifytoken

Route::get('/verify/{token}', 'VerifyController@verify');




Route::get('/about', function () {
    $user = 'Jordy';
   return view('about', compact('user'));
});

Route::get('/app', function () {
    return view('layouts/app');
});


Auth::routes();

Route::post('/login/custom', 'Auth\LoginController@authenticate')->name('customlogin');

Route::get('/home', 'HomeController@index')->name('home');
