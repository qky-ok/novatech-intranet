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

Route::group(['middleware' => 'web'], function () {
    Route::get('/', ['as' => 'intranet', 'uses' => 'HomeController@index']);
    Route::get('/services/search/{search}', ['as' => 'services.search', 'uses' => 'ServiceController@search']);
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    /*Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('states', 'StateController');
    Route::resource('services', 'ServiceController');*/
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@home']);

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', ['as' => 'users.index', 'uses' => 'UserController@index']);
        Route::get('/show', ['as' => 'users.show', 'uses' => 'UserController@show']);
        Route::get('/create/{role_id?}', ['as' => 'users.create', 'uses' => 'UserController@create']);
        Route::post('/store', ['as' => 'users.store', 'uses' => 'UserController@store']);
        Route::get('/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
        Route::post('/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
        Route::post('/destroy', ['as' => 'users.destroy', 'uses' => 'UserController@destroy']);
    });

    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', ['as' => 'roles.index', 'uses' => 'RoleController@index']);
        Route::get('/show', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
        Route::get('/create', ['as' => 'roles.create', 'uses' => 'RoleController@create']);
        Route::post('/store', ['as' => 'roles.store', 'uses' => 'RoleController@store']);
        Route::get('/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit']);
        Route::post('/update', ['as' => 'roles.update', 'uses' => 'RoleController@update']);
        Route::post('/destroy', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy']);
    });

    Route::group(['prefix' => 'states'], function() {
        Route::get('/', ['as' => 'states.index', 'uses' => 'StateController@index']);
        Route::get('/show', ['as' => 'states.show', 'uses' => 'StateController@show']);
        Route::get('/create', ['as' => 'states.create', 'uses' => 'StateController@create']);
        Route::post('/store', ['as' => 'states.store', 'uses' => 'StateController@store']);
        Route::get('/edit', ['as' => 'states.edit', 'uses' => 'StateController@edit']);
        Route::post('/update', ['as' => 'states.update', 'uses' => 'StateController@update']);
        Route::post('/destroy', ['as' => 'states.destroy', 'uses' => 'StateController@destroy']);
    });

    Route::group(['prefix' => 'services'], function() {
        Route::get('/', ['as' => 'services.index', 'uses' => 'ServiceController@index']);
        Route::post('/list', ['as' => 'services.list', 'uses' => 'ServiceController@list']);
        Route::get('/show-pdf/{id}', ['as' => 'services.show_pdf', 'uses' => 'ServiceController@showPdf']);
        Route::get('/create', ['as' => 'services.create', 'uses' => 'ServiceController@create']);
        Route::post('/store', ['as' => 'services.store', 'uses' => 'ServiceController@store']);
        Route::get('/edit', ['as' => 'services.edit', 'uses' => 'ServiceController@edit']);
        Route::post('/update', ['as' => 'services.update', 'uses' => 'ServiceController@update']);
        Route::post('/history', ['as' => 'services.history', 'uses' => 'ServiceController@getHistory']);
        Route::post('/destroy', ['as' => 'services.destroy', 'uses' => 'ServiceController@destroy']);
        Route::get('/pdf/{id}', ['as' => 'services.pdf', 'uses' => 'ServiceController@getPdf']);
    });

    Route::group(['prefix' => 'service_alarms'], function() {
        Route::get('/', ['as' => 'service_alarm.index', 'uses' => 'ServiceAlarmController@index']);
        Route::get('/edit', ['as' => 'service_alarm.edit', 'uses' => 'ServiceAlarmController@edit']);
        Route::post('/update', ['as' => 'service_alarm.update', 'uses' => 'ServiceAlarmController@update']);
        Route::get('/check-services', ['as' => 'service_alarm.check_services', 'uses' => 'ServiceAlarmController@checkServices']);
    });

    Route::group(['prefix' => 'crud'], function() {
        Route::get('/', ['as' => 'crud.index', 'uses' => 'CrudController@index']);
    });

    Route::group(['prefix' => 'clients'], function() {
        Route::get('/', ['as' => 'clients.index', 'uses' => 'ClientController@index']);
        Route::get('/show', ['as' => 'clients.show', 'uses' => 'ClientController@show']);
        Route::get('/create', ['as' => 'clients.create', 'uses' => 'ClientController@create']);
        Route::post('/store', ['as' => 'clients.store', 'uses' => 'ClientController@store']);
        Route::get('/edit', ['as' => 'clients.edit', 'uses' => 'ClientController@edit']);
        Route::post('/update', ['as' => 'clients.update', 'uses' => 'ClientController@update']);
        Route::post('/destroy', ['as' => 'clients.destroy', 'uses' => 'ClientController@destroy']);
    });

    Route::group(['prefix' => 'parts'], function() {
        Route::get('/', ['as' => 'parts.index', 'uses' => 'PartController@index']);
        Route::get('/show/{id}', ['as' => 'parts.show', 'uses' => 'PartController@show']);
        Route::get('/create', ['as' => 'parts.create', 'uses' => 'PartController@create']);
        Route::post('/store', ['as' => 'parts.store', 'uses' => 'PartController@store']);
        Route::get('/edit', ['as' => 'parts.edit', 'uses' => 'PartController@edit']);
        Route::post('/update', ['as' => 'parts.update', 'uses' => 'PartController@update']);
        Route::post('/destroy', ['as' => 'parts.destroy', 'uses' => 'PartController@destroy']);
        Route::post('/file-upload', ['as' => 'parts.file_upload', 'uses' => 'PartController@uploadImage']);
        Route::post('/file-delete', ['as' => 'parts.file_delete', 'uses' => 'PartController@deleteImage']);
    });

    Route::group(['prefix' => 'part_models'], function() {
        Route::get('/', ['as' => 'part_models.index', 'uses' => 'PartModelController@index']);
        Route::get('/show', ['as' => 'part_models.show', 'uses' => 'PartModelController@show']);
        Route::get('/create', ['as' => 'part_models.create', 'uses' => 'PartModelController@create']);
        Route::post('/store', ['as' => 'part_models.store', 'uses' => 'PartModelController@store']);
        Route::get('/edit', ['as' => 'part_models.edit', 'uses' => 'PartModelController@edit']);
        Route::post('/update', ['as' => 'part_models.update', 'uses' => 'PartModelController@update']);
        Route::post('/destroy', ['as' => 'part_models.destroy', 'uses' => 'PartModelController@destroy']);
    });

    Route::group(['prefix' => 'brands'], function() {
        Route::get('/', ['as' => 'brands.index', 'uses' => 'BrandController@index']);
        Route::get('/show', ['as' => 'brands.show', 'uses' => 'BrandController@show']);
        Route::get('/create', ['as' => 'brands.create', 'uses' => 'BrandController@create']);
        Route::post('/store', ['as' => 'brands.store', 'uses' => 'BrandController@store']);
        Route::get('/edit', ['as' => 'brands.edit', 'uses' => 'BrandController@edit']);
        Route::post('/update', ['as' => 'brands.update', 'uses' => 'BrandController@update']);
        Route::post('/destroy', ['as' => 'brands.destroy', 'uses' => 'BrandController@destroy']);
    });

    Route::group(['prefix' => 'warranties'], function() {
        Route::get('/', ['as' => 'warranties.index', 'uses' => 'WarrantyController@index']);
        Route::get('/show', ['as' => 'warranties.show', 'uses' => 'WarrantyController@show']);
        Route::get('/create', ['as' => 'warranties.create', 'uses' => 'WarrantyController@create']);
        Route::post('/store', ['as' => 'warranties.store', 'uses' => 'WarrantyController@store']);
        Route::get('/edit', ['as' => 'warranties.edit', 'uses' => 'WarrantyController@edit']);
        Route::post('/update', ['as' => 'warranties.update', 'uses' => 'WarrantyController@update']);
        Route::post('/destroy', ['as' => 'warranties.destroy', 'uses' => 'WarrantyController@destroy']);
    });

    Route::group(['prefix' => 'application_items'], function() {
        Route::get('/', ['as' => 'application_items.index', 'uses' => 'ApplicationItemController@index']);
        Route::get('/show', ['as' => 'application_items.show', 'uses' => 'ApplicationItemController@show']);
        Route::get('/create', ['as' => 'application_items.create', 'uses' => 'ApplicationItemController@create']);
        Route::post('/store', ['as' => 'application_items.store', 'uses' => 'ApplicationItemController@store']);
        Route::get('/edit', ['as' => 'application_items.edit', 'uses' => 'ApplicationItemController@edit']);
        Route::post('/update', ['as' => 'application_items.update', 'uses' => 'ApplicationItemController@update']);
        Route::post('/destroy', ['as' => 'application_items.destroy', 'uses' => 'ApplicationItemController@destroy']);
    });

    Route::group(['prefix' => 'families'], function() {
        Route::get('/', ['as' => 'families.index', 'uses' => 'FamilyController@index']);
        Route::get('/show', ['as' => 'families.show', 'uses' => 'FamilyController@show']);
        Route::get('/create', ['as' => 'families.create', 'uses' => 'FamilyController@create']);
        Route::post('/store', ['as' => 'families.store', 'uses' => 'FamilyController@store']);
        Route::get('/edit', ['as' => 'families.edit', 'uses' => 'FamilyController@edit']);
        Route::post('/update', ['as' => 'families.update', 'uses' => 'FamilyController@update']);
        Route::post('/destroy', ['as' => 'families.destroy', 'uses' => 'FamilyController@destroy']);
    });

    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', ['as' => 'categories.index', 'uses' => 'CategoryController@index']);
        Route::get('/show', ['as' => 'categories.show', 'uses' => 'CategoryController@show']);
        Route::get('/create', ['as' => 'categories.create', 'uses' => 'CategoryController@create']);
        Route::post('/store', ['as' => 'categories.store', 'uses' => 'CategoryController@store']);
        Route::get('/edit', ['as' => 'categories.edit', 'uses' => 'CategoryController@edit']);
        Route::post('/update', ['as' => 'categories.update', 'uses' => 'CategoryController@update']);
        Route::post('/destroy', ['as' => 'categories.destroy', 'uses' => 'CategoryController@destroy']);
    });

    Route::group(['prefix' => 'selling_houses'], function() {
        Route::get('/', ['as' => 'selling_houses.index', 'uses' => 'SellingHouseController@index']);
        Route::get('/show', ['as' => 'selling_houses.show', 'uses' => 'SellingHouseController@show']);
        Route::get('/create', ['as' => 'selling_houses.create', 'uses' => 'SellingHouseController@create']);
        Route::post('/store', ['as' => 'selling_houses.store', 'uses' => 'SellingHouseController@store']);
        Route::get('/edit', ['as' => 'selling_houses.edit', 'uses' => 'SellingHouseController@edit']);
        Route::post('/update', ['as' => 'selling_houses.update', 'uses' => 'SellingHouseController@update']);
        Route::post('/destroy', ['as' => 'selling_houses.destroy', 'uses' => 'SellingHouseController@destroy']);
    });

    Route::group(['prefix' => 'warranty_types'], function() {
        Route::get('/', ['as' => 'warranty_types.index', 'uses' => 'WarrantyTypeController@index']);
        Route::get('/show', ['as' => 'warranty_types.show', 'uses' => 'WarrantyTypeController@show']);
        Route::get('/create', ['as' => 'warranty_types.create', 'uses' => 'WarrantyTypeController@create']);
        Route::post('/store', ['as' => 'warranty_types.store', 'uses' => 'WarrantyTypeController@store']);
        Route::get('/edit', ['as' => 'warranty_types.edit', 'uses' => 'WarrantyTypeController@edit']);
        Route::post('/update', ['as' => 'warranty_types.update', 'uses' => 'WarrantyTypeController@update']);
        Route::post('/destroy', ['as' => 'warranty_types.destroy', 'uses' => 'WarrantyTypeController@destroy']);
    });

    Route::group(['prefix' => 'insurance_companies'], function() {
        Route::get('/', ['as' => 'insurance_companies.index', 'uses' => 'InsuranceCompanyController@index']);
        Route::get('/show', ['as' => 'insurance_companies.show', 'uses' => 'InsuranceCompanyController@show']);
        Route::get('/create', ['as' => 'insurance_companies.create', 'uses' => 'InsuranceCompanyController@create']);
        Route::post('/store', ['as' => 'insurance_companies.store', 'uses' => 'InsuranceCompanyController@store']);
        Route::get('/edit', ['as' => 'insurance_companies.edit', 'uses' => 'InsuranceCompanyController@edit']);
        Route::post('/update', ['as' => 'insurance_companies.update', 'uses' => 'InsuranceCompanyController@update']);
        Route::post('/destroy', ['as' => 'insurance_companies.destroy', 'uses' => 'InsuranceCompanyController@destroy']);
    });

    Route::group(['prefix' => 'providers'], function() {
        Route::get('/', ['as' => 'providers.index', 'uses' => 'ProviderController@index']);
        Route::get('/show', ['as' => 'providers.show', 'uses' => 'ProviderController@show']);
        Route::get('/create', ['as' => 'providers.create', 'uses' => 'ProviderController@create']);
        Route::post('/store', ['as' => 'providers.store', 'uses' => 'ProviderController@store']);
        Route::get('/edit', ['as' => 'providers.edit', 'uses' => 'ProviderController@edit']);
        Route::post('/update', ['as' => 'providers.update', 'uses' => 'ProviderController@update']);
        Route::post('/destroy', ['as' => 'providers.destroy', 'uses' => 'ProviderController@destroy']);
    });

    Route::group(['prefix' => 'interventions'], function() {
        Route::get('/', ['as' => 'interventions.index', 'uses' => 'InterventionController@index']);
        Route::get('/show', ['as' => 'interventions.show', 'uses' => 'InterventionController@show']);
        Route::get('/create', ['as' => 'interventions.create', 'uses' => 'InterventionController@create']);
        Route::post('/store', ['as' => 'interventions.store', 'uses' => 'InterventionController@store']);
        Route::get('/edit', ['as' => 'interventions.edit', 'uses' => 'InterventionController@edit']);
        Route::post('/update', ['as' => 'interventions.update', 'uses' => 'InterventionController@update']);
        Route::post('/destroy', ['as' => 'interventions.destroy', 'uses' => 'InterventionController@destroy']);
    });

    Route::group(['prefix' => 'billings'], function() {
        Route::get('/', ['as' => 'billings.index', 'uses' => 'BillingController@index']);
        Route::get('/pre-list', ['as' => 'billings.pre_list', 'uses' => 'BillingController@preList']);
        Route::get('/show', ['as' => 'billings.show', 'uses' => 'BillingController@show']);
        Route::get('/create', ['as' => 'billings.create', 'uses' => 'BillingController@create']);
        Route::post('/store', ['as' => 'billings.store', 'uses' => 'BillingController@store']);
        Route::get('/edit', ['as' => 'billings.edit', 'uses' => 'BillingController@edit']);
        Route::post('/update', ['as' => 'billings.update', 'uses' => 'BillingController@update']);
        Route::post('/destroy', ['as' => 'billings.destroy', 'uses' => 'BillingController@destroy']);
    });
});
