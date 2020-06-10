<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Guarantors
    Route::post('guarantors/media', 'GuarantorApiController@storeMedia')->name('guarantors.storeMedia');
    Route::apiResource('guarantors', 'GuarantorApiController');

    // Clients
    Route::post('clients/media', 'ClientApiController@storeMedia')->name('clients.storeMedia');
    Route::apiResource('clients', 'ClientApiController');

    // Funds
    Route::apiResource('funds', 'FundApiController');

    // Products
    Route::apiResource('products', 'ProductApiController');

    // Credits
    Route::apiResource('credits', 'CreditApiController');

    // Repayments
    Route::apiResource('repayments', 'RepaymentApiController');

    // Locations
    Route::apiResource('locations', 'LocationApiController');
});
