<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Guarantors
    Route::delete('guarantors/destroy', 'GuarantorController@massDestroy')->name('guarantors.massDestroy');
    Route::post('guarantors/media', 'GuarantorController@storeMedia')->name('guarantors.storeMedia');
    Route::post('guarantors/ckmedia', 'GuarantorController@storeCKEditorImages')->name('guarantors.storeCKEditorImages');
    Route::resource('guarantors', 'GuarantorController');

    // Missed Payments
    Route::resource('missed-payments', 'MissedPaymentsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Active Loans
    Route::resource('active-loans', 'ActiveLoansController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Inactive Loans
    Route::resource('inactive-loans', 'InactiveLoansController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Dorman Loans
    Route::resource('dorman-loans', 'DormanLoansController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Targets
    Route::resource('targets', 'TargetController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Clients
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::post('clients/media', 'ClientController@storeMedia')->name('clients.storeMedia');
    Route::post('clients/ckmedia', 'ClientController@storeCKEditorImages')->name('clients.storeCKEditorImages');
    Route::resource('clients', 'ClientController');

    // Funds
    Route::delete('funds/destroy', 'FundController@massDestroy')->name('funds.massDestroy');
    Route::resource('funds', 'FundController');

    // Products
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::resource('products', 'ProductController');

    // Credits
    Route::delete('credits/destroy', 'CreditController@massDestroy')->name('credits.massDestroy');
    Route::resource('credits', 'CreditController');

    // Repayments
    Route::delete('repayments/destroy', 'RepaymentController@massDestroy')->name('repayments.massDestroy');
    Route::resource('repayments', 'RepaymentController');

    // Locations
    Route::delete('locations/destroy', 'LocationController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
