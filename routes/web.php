<?php



Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController')->name('dashboard.index');
    Route::get('/home', 'DashboardController')->name('dashboard.index');
    Route::resource('users', 'UserController');
    Route::put('profile', 'UserController@profile')->name('users.profile');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('units', 'UnitController');
    Route::resource('zones', 'ZoneController');
    Route::resource('vehicles', 'VehicleController');
    Route::resource('orders', 'OrderController');
    Route::resource('companies', 'CompanyController');
    Route::resource('pricings', 'PricingController');
    Route::resource('payments', 'PaymentController');
    Route::resource('oils', 'OilController');

    Route::post('company/user', 'CompanyController@storeUser')->name('companies.user');


    Route::get('reports/order/{id}', 'ReportController@order')->name('reports.order');
    Route::get('json/orders', 'OrderController@orders');

    //notifications 
    Route::get('notifications', 'NotificationController@index');

});

Auth::routes(['register' => false]);
