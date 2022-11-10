<?php

// Route::redirect('/', '/en');




Route::group(['namespace' => 'Frontend'], function () {
// Route::group(['prefix' => '{locale}','where' => ['locale' => '[a-zA-Z]{2}'],'namespace' => 'Frontend', 'middleware' => 'setLocale'], function () {
    Route::get('/', 'HomeController@index')->name("home");

    Route::get('about-us', 'AboutusController@index')->name("aboutus");

    Route::get('gallery', 'GalleryController@index')->name("gallery");
    Route::get('/blogs', 'blogController@index')->name('blogs');
    Route::get('/blogs/{blog}-{slug}', 'blogController@show');

    Route::get('terms-and-condition', 'HomeController@warranty')->name("terms");
    Route::get('privacy-policy', 'HomeController@privacy')->name("privacy");
    
    Route::get('products/{category}-{slug}', 'ProductsController@category')->name('categories');
    // Route::get('/file/{name}', 'ProductsController@downloadfile')->name('downloadfile');
    Route::resource('our-products', 'ProductsController');
    Route::get('our-products', 'ProductsController@index')->name("shop");
    Route::get('our-products/{id}-{slug}', 'ProductsController@show')->name("shop.detail");
    
    Route::get('contact-us', 'ContactusController@index')->name("contactus");
    Route::post('contact-us/company/send', 'ContactusController@sendContactCompany');
    Route::post('contact-us/private/send', 'ContactusController@sendContactPrivate');

    Route::get('get-a-quote', 'QuoteController@index')->name("quote");
    Route::post('get-a-quote/send', 'QuoteController@sendQuote');

    Route::post('newsletter/subscribe', 'HomeController@newsletterSubscribe');
    
    Route::post('inquiry-sample', 'HomeController@inquirySample');

    Route::post('/search', 'HomeController@search')->name('search');

    Route::get('security-check', function () {
        return view('frontend.security-check');
    })->name("security-check");

    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('/cart', 'cartController@index')->name('shoppingcart');
        Route::post('/add-to-cart', 'cartController@store');
        Route::get('/submit_order','cartController@submitOrder')->name('orders.submit');
        Route::post('/upload-logo', 'cartController@uploadlogo');
        Route::delete('/delete-cart-item/{id}', 'cartController@destroy')->name('orders.delete-cart-item');
        Route::get('ordersuccess', function () {
            return view('frontend.ordersuccess');
        })->name('ordersuccess');

        Route::resource('my-profile','ProfileController');

    });
    // Route::get('brand-new', function () {
    //     return view('frontend.productpromo');
    // })->name('promo');;

    
});

Route::redirect('/home', '/admin');

// Auth::routes(['register' => false]);
Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
    Route::delete('products/image/{image}', 'ProductsController@deleteImage')->name('products.deleteProductImages');
    Route::resource('products', 'ProductsController');

    Route::delete('category/destroy', 'categoryController@massDestroy')->name('category.massDestroy');

    Route::resource('category', 'categoryController');

    Route::delete('blogs/destroy', 'blogController@massDestroy')->name('blogs.massDestroy');

    Route::resource('blogs', 'blogController');

    Route::delete('color/destroy', 'colorController@massDestroy')->name('color.massDestroy');

    Route::resource('color', 'colorController');

    Route::resource('type', 'typeController');

    Route::resource('variant', 'variantController');

    Route::resource('gallery', 'GalleryController');

    Route::resource('slider', 'SliderController');

    Route::resource('aboutus', 'AboutUsController');

    Route::resource('contactus', 'ContactUsController');

    // Route::resource('partners', 'PartnersController');

    Route::resource('footer', 'FooterController');

    Route::resource('global-settings', 'GlobalSettingController');

    Route::resource('product-page', 'ProductPageController');

    Route::resource('home-page', 'HomePageController');

    Route::resource('warranty-page', 'WarrantyController');
    
    Route::resource('privacy-page', 'PrivacyController');

    Route::resource('gallery-page', 'GalleryPageController');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
    // '\vendor\UniSharp\LaravelFilemanager\Lfm::routes()';
});

Route::get('clear_cache', function () {

    \Artisan::call('cache:clear');

    dd("Cache is cleared");

});