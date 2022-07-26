<?php

Auth::routes();


//bill of leading
Route::get('/dashboard/manifest/bill-of-lading/listing-product/{id}','Master\VasselController@create');
Route::post('/bill-of-lading','Master\VasselController@store');
Route::put('/bill-of-lading/{id}','Master\VasselController@update');
Route::delete('/bill-of-lading/{id}','Master\VasselController@destroy');

Route::group(array('prefix' =>LaravelLocalization::setLocale() .'/dashboard', 'namespace' => 'Dashboard', 'middleware' => ['adminauth']), function () {
	
	// Dashboard 
	Route::get('/', 'HomeController@index')->name('dashboard.index');

	// MASTER DATA
	/* User */
	Route::get('users_pengguna/{id}', 'UserController@show')->name('users_pengguna.show');
    Route::resource('users_pengguna', 'UserController');
	Route::post('users_pengguna/get-data', 'UserController@getData')->name('users_pengguna.getData');
	Route::post('users_pengguna/{user}/activated', 'UserController@activated')->name('users_pengguna.activated');
	Route::post('users_pengguna/save','UserController@save');
	Route::get('/users_pengguna/get_data/id', 'UserController@get_data_byid');
	Route::post('users_pengguna/update','UserController@update');
	// Route::post('users/delete','UserController@delete');


	// users_members
	Route::get('users_members/{id}', 'Members\UserMembersController@show')->name('users_members.show');
	Route::resource('users_members', 'Members\UserMembersController');
	Route::post('users_members/get-data', 'Members\UserMembersController@getData')->name('users_members.getData');
	Route::post('users_members/{user}/activated', 'Members\UserMembersController@activated')->name('users_members.activated');
	Route::post('users_members/save','Members\UserMembersController@save');
	Route::get('/users_members/get_data/id', 'Members\UserMembersController@get_data_byid');
	Route::post('users_members/update','Members\UserMembersController@update');

	


	// Bank Data
	Route::resource('bank', 'BankController');
	Route::post('bank/get-data', 'BankController@getData')->name('bank.getData');
	Route::post('bank/save','BankController@save');
    Route::get('/bank/get_data/id', 'BankController@get_data_byid');
	Route::post('bank/update','BankController@update');
	Route::post('bank/delete','BankController@delete');





	//profile
	Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile/change_password', 'ProfileController@updatePassword')->name('profile.change_password');
    Route::post('/profile/change_profile', 'ProfileController@change_profile')->name('profile.change_profile');
    Route::post('/profile/change_image', 'ProfileController@change_image')->name('profile.change_image');






	//setting general
	Route::get('/setting_general', 'SettingGeneralController@index')->name('setting_general.index');
	Route::post('setting_general/get-data', 'SettingGeneralController@getData')->name('setting_general.getData');
	Route::post('setting_general/get-data-system', 'SettingGeneralController@getDataSystem')->name('setting_general.getDataSystem');
	Route::get('setting_general/edit_data_system/{id}', 'SettingGeneralController@edit_data_system')->name('setting_general.edit_data_system');
	Route::post('setting_general/act_update', 'SettingGeneralController@act_update')->name('setting_general.act_update');
    Route::get('/setting_general/get_data/id', 'SettingGeneralController@get_data_byid');
	Route::post('setting_general/update','SettingGeneralController@update');
    


	//role
	Route::get('roles/{role}/permission', 'RolesController@permission')->name('roles.permission');
	Route::put('roles/{role}/permission', 'RolesController@updatePermission')->name('roles.permission');
	Route::post('roles/get-data', 'RolesController@getData')->name('roles.getData');
	Route::resource('roles', 'RolesController');


	/* Permission */
	Route::resource('permissions', 'PermissionsController');
	Route::post('permissions/get-data', 'PermissionsController@getData')->name('permissions.getData');
	Route::post('permissions/save','PermissionsController@save');
    Route::get('/permissions/get_data/id', 'PermissionsController@get_data_byid');
	Route::post('permissions/update','PermissionsController@update');
	Route::post('permissions/delete','PermissionsController@delete');


	// manifest
	Route::put('/manifest/{id}','Transaction\ManifestController@update');
	Route::get('/manifest/create','Transaction\VasselController@create')->name('manifest.create');
	Route::get('/manifest/bill-of-lading/{id}/create','Transaction\BillOfLadingController@create');
	Route::post('/manifest/bill-of-lading','Transaction\BillOfLadingController@store');
	Route::get('/manifest/bill-of-lading/{id}/edit','Transaction\BillOfLadingController@edit');
	Route::put('/manifest/bill-of-lading/{id}','Transaction\BillOfLadingController@update');


	// ship agend
	Route::get('/ship-agent','Master\ShipAgentController@index')->name('ship_agent.index');
	Route::get('/ship-agent/create','Master\ShipAgentController@create');
	Route::post('/ship-agent','Master\ShipAgentController@store');
	Route::get('/ship-agent/{id}/edit','Master\ShipAgentController@edit');
	Route::put('/ship-agent/{id}','Master\ShipAgentController@update');
	Route::delete('/ship-agent/{id}','Master\ShipAgentController@destroy');


	// vasseal
	Route::get('/vassel','Master\VasselController@index')->name('vassel.index');
	Route::get('/vassel/create','Master\VasselController@create');
	Route::post('/vassel','Master\VasselController@store');
	Route::get('/vassel/{id}/edit','Master\VasselController@edit');
	Route::put('/vassel/{id}','Master\VasselController@update');
	Route::delete('/vassel/{id}','Master\VasselController@destroy');
	

	// stevedoring
	Route::get('/stevedoring','Master\StevedoringController@index')->name('stevedoring.index');
	Route::get('/stevedoring/create','Master\StevedoringController@create');
	Route::post('/stevedoring','Master\StevedoringController@store');
	Route::get('/stevedoring/{id}/edit','Master\StevedoringController@edit');
	Route::put('/stevedoring/{id}','Master\StevedoringController@update');
	Route::delete('/stevedoring/{id}','Master\StevedoringController@destroy');

	

	

	// CMS Website
	//slider
	Route::resource('slider', 'CMS\\SliderController');
	Route::get('/slider/create', 'CMS\\SliderController@create');
    Route::post('/slider/create', 'CMS\\SliderController@store');
    Route::get('/slider/{id?}/edit', 'CMS\\SliderController@edit');
    Route::post('/slider/{id?}/edit', 'CMS\\SliderController@update');
    Route::get('/slider/{id?}/show', 'CMS\\SliderController@show');

   // news article
	Route::resource('news', 'CMS\\NewsController');
	Route::get('/news/create', 'CMS\\NewsController@create');
    Route::post('/news/create', 'CMS\\NewsController@store');
    Route::get('/news/{id?}/edit', 'CMS\\NewsController@edit');
    Route::post('/news/{id?}/edit', 'CMS\\NewsController@update');
    Route::get('/news/{id?}/show', 'CMS\\NewsController@show');

   // pages menu
	Route::resource('pages', 'CMS\\PagesController');
	Route::get('/pages/create', 'CMS\\PagesController@create');
    Route::post('/pages/create', 'CMS\\PagesController@store');
    Route::get('/pages/create/{id?}', 'CMS\\PagesController@create');
    Route::post('/pages/create/{id?}', 'CMS\\PagesController@store');
	Route::get('/pages/children/{parent_id?}/{depth?}', 'CMS\\PagesController@children');
	Route::get('/pages/{id?}/edit', 'CMS\\PagesController@edit');
    Route::post('/pages/{id?}/edit', 'CMS\\PagesController@update');
    Route::get('/pages/{id?}/show', 'CMS\\PagesController@show');
    Route::get('/pages/reorder/{id?}', 'CMS\\PagesController@reorder');


   //category
	Route::resource('category', 'CMS\\CategoryController');
	Route::post('category/get-data', 'CMS\\CategoryController@getData')->name('category.getData');
	Route::post('category/save','CMS\\CategoryController@save');
    Route::get('/category/get_data/id', 'CMS\\CategoryController@get_data_byid');
	Route::post('category/update','CMS\\CategoryController@update');
	Route::post('category/delete','CMS\\CategoryController@delete');

	//tags
	Route::resource('tags', 'CMS\\TagsController');
	Route::post('tags/get-data', 'CMS\\TagsController@getData')->name('tags.getData');
	Route::post('tags/save','CMS\\TagsController@save');
    Route::get('/tags/get_data/id', 'CMS\\TagsController@get_data_byid');
	Route::post('tags/update','CMS\\TagsController@update');
	Route::post('tags/delete','CMS\\TagsController@delete');



	// client menu
	Route::resource('client', 'CMS\\ClientController');
	Route::post('client/get-data', 'CMS\\ClientController@getData')->name('client.getData');
	Route::post('client/save','CMS\\ClientController@save');
    Route::get('/client/get_data/id', 'CMS\\ClientController@get_data_byid');
	Route::post('client/update','CMS\\ClientController@update');
	Route::post('client/delete','CMS\\ClientController@delete');


	// testimonial
	Route::resource('testimonial', 'CMS\\TestimonialController');
	Route::post('testimonial/get-data', 'CMS\\TestimonialController@getData')->name('testimonial.getData');
	Route::post('testimonial/save','CMS\\TestimonialController@save');
    Route::get('/testimonial/get_data/id', 'CMS\\TestimonialController@get_data_byid');
	Route::post('testimonial/update','CMS\\TestimonialController@update');
	Route::post('testimonial/delete','CMS\\TestimonialController@delete');


	
	
    // inbox
	Route::resource('inbox', 'CMS\\InboxController');
	Route::post('inbox/get-data', 'CMS\\InboxController@getData')->name('inbox.getData');
	Route::post('inbox/save','CMS\\InboxController@save');
    Route::get('/inbox/get_data/id', 'CMS\\InboxController@get_data_byid');

    
  


	// infobox
	Route::resource('infobox', 'Master\\InfoboxController');
	Route::post('infobox/get-data', 'Master\\InfoboxController@getData')->name('infobox.getData');
    Route::get('/infobox/get_data/id', 'Master\\InfoboxController@get_data_byid');
    Route::post('infobox/update','Master\\InfoboxController@update');

	
    // satuan
	Route::resource('satuan', 'Master\\SatuanController');
	Route::post('satuan/get-data', 'Master\\SatuanController@getData')->name('satuan.getData');
	Route::post('satuan/save','Master\\SatuanController@save');
    Route::get('/satuan/get_data/id', 'Master\\SatuanController@get_data_byid');
	Route::post('satuan/update','Master\\SatuanController@update');
	Route::post('satuan/delete','Master\\SatuanController@delete');

	// product_category
    Route::resource('product_category', 'Master\\ProductCategoryController');
	Route::post('product_category/get-data', 'Master\\ProductCategoryController@getData')->name('product_category.getData');
	Route::post('product_category/save','Master\\ProductCategoryController@save');
    Route::get('/product_category/get_data/id', 'Master\\ProductCategoryController@get_data_byid');
	Route::post('product_category/update','Master\\ProductCategoryController@update');
	Route::post('product_category/delete','Master\\ProductCategoryController@delete');


	// manifest
	Route::resource('manifest', 'Transaction\\ManifestController');
	Route::post('manifest/get-data', 'Transaction\\ManifestController@getData')->name('manifest.getData');
	
	Route::get('manifest/{id}', 'Transaction\\ManifestController@show')->name('manifest.view');



	// BL by Manifest
	Route::post('manifest/get-data/{id}', 'Transaction\\BillOfLadingController@getData')->name('BL.getDataByManifest');

	Route::get('bill_of_lading/{id}', 'Transaction\\BillOfLadingController@show')->name('bill_of_lading.view');
	
	
	Route::post('bill_of_lading/get-data-procces/{id}', 'Transaction\\BillOfLadingController@getDataProductProccess')->name('BL.getDataProductProccess');


	// save product
	Route::post('bill_of_lading/product/save','Transaction\\BillOfLadingController@save_product');

	Route::post('bill_of_lading/get-data-finish/{id}', 'Transaction\\BillOfLadingController@getDataProductFinish')->name('BL.getDataProductFinish');
	



	// location from to
	Route::resource('location', 'Master\\LocationController');
	Route::post('location/get-data', 'Master\\LocationController@getData')->name('location.getData');
	Route::post('location/save','Master\\LocationController@save');
    Route::get('/location/get_data/id', 'Master\\LocationController@get_data_byid');
	Route::post('location/update','Master\\LocationController@update');
	Route::post('location/delete','Master\\LocationController@delete');
	
	
});






Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    
    

   	
   	Route::get('/', function () {
	    return redirect(route('login'));
	});

    
    
    



});