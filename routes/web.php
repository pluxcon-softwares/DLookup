<?php

use Illuminate\Support\Facades\Route;

use Hexters\CoinPayment\CoinPayment;
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

//Route to receive webhook request
Route::webhooks('webhook-receiving-url');

Route::get('api/test', function(){
//Public Key: 90f5a097320759c4ce58f5ffdce22595843d754f41a982853434485c89b76a1f
//Private Key: 5b2C9D5c84f384f29D0a7D1fa2909048c65F958732426146d19995Ef655e61C5
    $transaction['order_id'] = uniqid(); //invoice number
    $transaction['amountTotal'] = (FLOAT) 37.2;
    $transaction['note'] = 'Check-Lite Payment';
    $transaction['buyer_name'] = 'Philip Otoo';
    $transaction['buyer_email'] = 'prolabdomains@gmail.com';
    $transaction['redirect_url'] = route('user.payment-complete');
    $transaction['cancel_url'] = route('user.payment-cancel');

    $transaction['items'][] = [
        'itemDescription' => 'Test wallet funding',
        'itemPrice' => (FLOAT) 37.2,
        'itemQty'   => (INT) 1,
        'itemSubtotalAmount' => (FLOAT) 37.2
    ];

    return CoinPayment::generatelink($transaction);
});

Route::group(['prefix'=>'admin', 'namespace' => 'Admin'], function () {
    Route::get('', 'AuthController@login');
    Route::get('login', 'AuthController@login')->name('admin.login');
    Route::post('login', 'AuthController@authenticate')->name('admin.authenticate');
    Route::get('logout', 'AuthController@logout')->name('admin.logout');

    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');

    Route::get('ssn/record/create', 'SSNController@ssnCreate')->name('admin.ssn.create');
    Route::post('ssn/record/store', 'SSNController@ssnStore')->name('admin.ssn.store');
    Route::get('ssn/records', 'SSNController@ssnRecords')->name('admin.ssn.records');
    Route::get('ssn/record/{ssn_id}', 'SSNController@ssnRecord')->name('admin.ssn.record');
    Route::get('ssn/record/edit/{ssn_id}', 'SSNController@ssnEdit')->name('admin.ssn.edit');
    Route::post('ssn/record/update/{ssn_id}', 'SSNController@ssnUpdate')->name('admin.ssn.update');
    Route::get('ssn/record/delete/{ssn_id}', 'SSNController@ssnDelete')->name('admin.ssn.delete');

    //DL Records, Create DL, Update DL, Delete DL routes
    Route::get('dl/record/create', 'DLController@dlCreate')->name('admin.dl.create');
    Route::post('dl/record/store', 'DLController@dlStore')->name('admin.dl.store');
    Route::get('dl/records', 'DLController@dlRecords')->name('admin.dl.records');
    Route::get('dl/record/{dl_id}', 'DLController@dlRecord')->name('admin.dl.record');
    Route::get('dl/record/edit/{dl_id}', 'DLController@dlEdit')->name('admin.dl.edit');
    Route::post('dl/record/update/{dl_id}', 'DLController@dlUpdate')->name('admin.dl.update');
    Route::get('dl/record/delete/{dl_id}', 'DLController@dlDelete')->name('admin.dl.delete');

    //Support / Ticket route
    Route::get('ticket/all', 'TicketController@getTickets')->name('admin.tickets');
    Route::post('ticket/delete', 'TicketController@deleteTicket')->name('admin.delete.ticket');
    Route::get('ticket/view/{ticket_id}', 'TicketController@viewTicket')->name('admin.view.ticket');
    Route::post('ticket/reply', 'TicketController@replyTicket')->name('admin.reply.ticket');

    // News Route
    Route::get('news/all', 'PostController@getAllPosts')->name('admin.news.posts');
    Route::get('news/create', 'PostController@createPost')->name('admin.news.create');
    Route::post('news/store', 'PostController@storePost')->name('admin.news.store');
    Route::get('news/edit/{post_id}', 'PostController@editPost')->name('admin.news.edit');
    Route::post('news/update/{post_id}', 'PostController@updatePost')->name('admin.news.update');
    Route::post('news/delete', 'PostController@deletePost')->name('admin.news.delete');

    //Adding User, Edit, Update and Deleted User Account Route
    Route::get('all-users', 'UserController@allUsers')->name('admin.all-users');
    Route::get('edit-user/{user_id}', 'UserController@editUser')->name('admin.edit-user');
    Route::post('update-user/{user_id}', 'UserController@updateUser')->name('admin.update-user');
    Route::get('delete-user/{user_id}', 'UserController@deleteUser')->name('admin.delete-user');

    //Adding Admin, Edit, Update and Deleted Admin Account Route
    Route::get('all-admins', 'AdminController@allAdmins')->name('admin.all-admins');
    Route::get('create-admin', 'AdminController@createAdmin')->name('admin.create-admin');
    Route::post('store-admin', 'AdminController@storeAdmin')->name('admin.store-admin');
    Route::get('edit-admin/{admin_id}', 'AdminController@editAdmin')->name('admin.edit-admin');
    Route::post('update-admin/{admin_id}', 'AdminController@updateAdmin')->name('admin.update-admin');
    Route::get('delete-admin/{admin_id}', 'AdminController@deleteAdmin')->name('admin.delete-admin');

    //Payment Route
    Route::get('all-payments', 'PaymentController@allPayments')->name('admin.all-payments');

    // SSN Import
    Route::get('import-ssn', 'ImportController@ssnImport')->name('admin.ssn-import');
    Route::post('import-ssn', 'ImportController@ssnParseImport')->name('admin.ssn-parse-import');

    // DL Import
    Route::get('import-dl', 'ImportController@dlImport')->name('admin.dl-import');
    Route::post('import-dl', 'ImportController@dlParseImport')->name('admin.dl-parse-import');
});


// Routing for Frontend
Route::group(['namespace' => 'User', 'middleware'=>['set_locale']], function(){
    //Login routing
    Route::get('/', 'AuthController@login')->name('login');
    Route::get('/login', 'AuthController@login')->name('user.login');
    Route::post('/login', 'AuthController@authenticate')->name('user.authenticate');
    Route::get('/logout', 'AuthController@logout')->name('user.logout');

    //Register Route
    Route::get('/register', 'AuthController@create')->name('user.create');
    Route::post('/register', 'AuthController@store')->name('user.store');

    Route::group(['prefix'=>'dashboard'], function () {
        //Use Home
        Route::get('/', 'HomeController@dashboard')->name('user.dashboard');

        //SSN Search
        Route::get('/ssn/search', 'SSNController@ssnSearchPage')
        ->name('user.ssn-search-page');
        Route::post('/ssn/search', 'SSNController@ssnSearch')->name('user.ssn-search');
        Route::post('/ssn/buy', 'SSNController@ssnBuy')->name('user.ssn-buy');

        // Support/Ticket Route
        Route::get('/tickets', 'TicketController@tickets')->name('user.tickets');
        Route::get('/ticket/reply/{ticket_id}', 'TicketController@ticketReply')->name('user.ticket.reply');
        Route::post('/ticket/create', 'TicketController@ticketCreate')->name('user.ticket.create');
        Route::post('/ticket/delete', 'TicketController@ticketDelete')->name('user.ticket.delete');

        //DL Lookup
        Route::get('/dl/search/page', 'DLController@DLSearchPage')->name('user.dl.searchpage');
        Route::post('/dl/search', 'DLController@DLSearch')->name('user.dl.search');

        //Purchase Route
        Route::get('purchase/ssn', 'SSNController@viewSSNPurchase')->name('user.view-ssn-purchase');
        Route::post('purchase/ssn', 'SSNController@deleteSSNPurchase')->name('user.delete-ssn-purchase');

        Route::get('purchase/dl', 'DLController@viewDLPurchase')->name('user.view-dl-purchase');
        Route::post('purchase/dl', 'DLController@deleteDLPurchase')->name('user.delete-dl-purchase');
    });
});

Route::group(['namespace' => 'Payment', 'middleware'=>['set_locale']], function(){
    Route::group(['prefix' => 'dashboard'], function(){
        //Add Fund to Wallet and Wallet Transactions route
        Route::get('/add-fund', 'CoinPaymentController@addFund')->name('user.add-Fund');
        Route::post('/process-fund', 'CoinPaymentController@processFund')->name('user.process-fund');
        Route::get('/payment-complete', 'CoinPaymentController@paymentComplete')->name('user.payment-complete');
        Route::get('/payment-cancel', 'CoinPaymentController@paymentCancel')->name('user.payment-cancel');
    });
});
