<?php

use Illuminate\Support\Facades\Route;

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
//Route::get('/test', 'FrontController@test');
Route::get('/auth/facebook', 'social\FacebookController@redirectToFacebook')->name('auth_fb');
Route::get('/social/facebook/callback', 'social\FacebookController@handleFacebookCallback');
Route::get('/redirect', 'social\AuthGoogleController@redirect')->name('login.google');
Route::get('/google/callback', 'social\AuthGoogleController@callback');
Route::get('/auth/twitter', 'social\TwitterController@redirect')->name('auth_twitter');
Route::get('/twitter/callback', 'social\TwitterController@TwitterCallback');
Route::get('/setlocale/{lang}', 'LanguageController@setPrefix')->name('setlocale');
Route::get('/change-currency/{id}', 'FrontController@changeCur')->name('change_cur');
Route::get('/test', 'FrontController@test');

Route::group(
    [
        'prefix' => App\Http\Middleware\Locale::getLocale()
        /*, 'middleware' => 'reconstr'*/
    ],
    function () {
        Auth::routes();

        Route::get('/', 'FrontController@index')->name('main.page');
        Route::get('/contacts', 'FrontController@contacts')->name('contacts.page');
        Route::get('/partner-add-car-media-requirements', 'FrontController@mediaRequirements')->name('media_requirements.page');
        Route::get('/cars', 'FrontController@cars')->name('cars.page');
        Route::get('/payment', 'FrontController@payment')->name('payment.page');
        Route::get('/news', 'FrontController@news')->name('news.page');
        Route::post('/news/write-comment', 'FrontController@writeComment')->name('article.write_comment');
        Route::get('/news/{alias}', 'FrontController@newRead')->name('new.read.page');
        Route::get('/reviews', 'FrontController@reviews')->name('reviews.page');
        Route::get('/rent_condition', 'FrontController@rentCondition')->name('rent_condition');
        Route::get('/faq', 'FrontController@faq')->name('faq');
        Route::post('/cars/filter-rent-with-driver', 'FrontController@carsFilter2')->name('cars.filter2');
        Route::get('/rent-of-cars-with-driver', 'FrontController@carsWithDriver')->name('cars_rent_with_driver.page');
        Route::get('/brands', 'FrontController@brands')->name('brands.page');
        Route::get('/car/sort_by_class/{class}', 'FrontController@sortCarsByClass')->name('sort_cars_by_class');
        Route::get('/car/sort_by_brand/{alias}', 'FrontController@sortCarsByBrand')->name('sort_cars_by_brand');
        Route::get('/booking/thank_form/{id}/{driver?}', 'FrontController@thankFrom')->name('booking_thank_form');
        Route::get('/booking/simple_rent/{id}', 'FrontController@bookingCarSimpleRent')->name('booking_cars_simple_rent');
        Route::post('/booking/send', 'FrontController@sendMailSimpleRent')->name('simple_rent.send_mail');
        Route::post('/booking/send2', 'FrontController@sendMailWithDriverRent')->name('with_driver_rent.send_mail');
        Route::post('/booking/with_driver/get_price', 'FrontController@getPrice')->name('with_driver_rent.getPrice');
        Route::get('/booking/with_driver/{id}', 'FrontController@bookingCarWithDriver')->name('booking_cars_with_driver');
        Route::get('/car/{alias}', 'FrontController@car')->name('one_car.page');
        Route::get('/car-with-driver/{id}', 'FrontController@carWithDriver')->name('one_car_with_driver.page');
        Route::post('/request_for_partnership', 'MailController@partnership_request')->name('partnership_request');
        Route::get('/home', 'HomeController@index')->name('home');

        Route::group(['middleware'=>'roles', 'roles'=> ['partner'], 'prefix' => 'partner'], function()
        {
            Route::get('/profile', 'partner\PartnerController@index')->name('partner.index');
            Route::get('/top-up-balance', 'partner\BalanceController@index')->name('partner.balance.index');
            Route::post('/profile/update', 'partner\PartnerController@updateProfile')->name('partner.profile.update');
            Route::get('/partner_car/create/{id?}', 'partner\CarController@create')->name('partner_car.create');
            Route::get('/partner_car/create/update/{id}', 'partner\CarController@createUpdate')->name('partner_car.create.update');
            Route::get('/partner_car/create/stage2/{id}', 'partner\CarController@createStage2')->name('partner_car.create.stage2');
            Route::post('/partner_car/store/stage2', 'partner\CarController@storeStage2')->name('partner_car.store.stage2');
            Route::get('/partner_car/create/stage3/{id}', 'partner\CarController@createStage3')->name('partner_car.create.stage3');
            Route::get('/partner_car/image/delete/{id}/{edit?}', 'partner\CarController@imageDelete')->name('partner_car.image.delete');
            Route::get('/partner_car/image/move_upper/{order_id}/{id?}', 'partner\CarController@imageMoveUpper')->name('partner_car.image.move_upper');
            Route::get('/partner_car/image/move_lower/{order_id}/{id?}', 'partner\CarController@imageMoveLower')->name('partner_car.image.move_lower');
            Route::get('/partner_car/image/move_to_top/{order_id}/{id?}', 'partner\CarController@imageMoveToTop')->name('partner_car.image.move_to_top');
            Route::get('/partner_car/image/rotate/{id}/{edit?}', 'partner\CarController@imageRotate')->name('partner_car.image.rotate');
            Route::get('/partner_car/publish/{id}', 'partner\CarController@publish')->name('partner_car.publish');
            Route::get('/partner_car/stage2/edit/{id}', 'partner\CarController@editStage2')->name('partner_car.edit.stage2');
            Route::post('/partner_car/upload-photo/{id}', 'partner\CarController@uploadPhoto')->name('partner_car.upload-photo');
            Route::post('/partner_car/stage2/update/{id}', 'partner\CarController@updateStage2')->name('partner_car.update.stage2');
            Route::get('/partner_car/stage3/edit/{id}', 'partner\CarController@editStage3')->name('partner_car.edit.stage3');
            Route::get('/partner_car/show2/{id}', 'partner\CarController@show2')->name('partner_car.show2');
            Route::get('/partner_car/{alias}', 'partner\CarController@show')->name('partner_car.show');
            Route::post('/partner_ticket/add-answer', 'partner\TicketController@addAnswer')->name('partner_ticket.add_answer');
            Route::get('/my_orders', 'partner\PartnerController@myOrders')->name('partner.my_orders');
            Route::get('/my_orders/get-next-10', 'partner\PartnerController@getNextTen')->name('partner.my_orders.getMore');
            Route::post('/my_orders/change-status', 'partner\PartnerController@changeStatus')->name('partner.my_orders.change_status');
            Route::get('/my_orders/booking/{id}/{with_driver?}', 'partner\PartnerController@bookingResult')->name('partner.my_orders.booking');
            Route::get('/my_orders/get-next-10', 'partner\PartnerController@getNextTen')->name('partner.my_orders.getMore');
			Route::get('/ads', 'partner\AdvertistingController@index')->name('partner.ads.index');
            Route::resource('partner_car', 'partner\CarController')->except('show', 'create');
            Route::resource('partner_ticket', 'partner\TicketController')->except('show');
        });
        Route::group(['middleware'=>'roles', 'roles'=> ['client'], 'prefix' => 'client'], function()
        {
            Route::get('/', 'client\ClientController@index')->name('client.index');
            Route::get('/payment-methods', 'client\PaymentMethodController@index')->name('client_payment_method.index');
            Route::post('/client_ticket/add-answer', 'client\TicketController@addAnswer')->name('client_ticket.add_answer');
            Route::get('/profile', 'client\ClientController@index')->name('client.profile');
            Route::get('/my_orders', 'client\ClientController@myOrders')->name('client.my_orders');
            Route::get('/my_orders/booking/{id}/{with_driver?}', 'client\ClientController@bookingResult')->name('client.my_orders.booking');
            Route::get('/my_orders/get-next-10', 'client\ClientController@getNextTen')->name('client.my_orders.getMore');
            Route::post('/profile/update', 'client\ClientController@profileUpdate')->name('client.profile.update');
            Route::resource('client_ticket', 'client\TicketController')->except('show');
        });
    });

Route::group(['middleware'=>'roles', 'roles'=> ['admin'], 'prefix' => 'admin'], function()
{
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('/order/with-driver/edit/{id}', 'Admin\OrderController@editWithDriver')->name('admin.order.with_driver.edit');
    Route::put('/order/with-driver/update/{id}', 'Admin\OrderController@updateWithDriver')->name('admin.order.with_driver.update');
    Route::get('/car/image/move_upper/{order_id}/{id}', 'Admin\CarController@imageMoveUpper')->name('admin.car.image.move_upper');
    Route::get('/car/image/move_lower/{order_id}/{id}', 'Admin\CarController@imageMoveLower')->name('admin.car.image.move_lower');
    Route::get('/car/image/move_to_top/{order_id}/{id}', 'Admin\CarController@imageMoveToTop')->name('admin.car.image.move_to_top');
    Route::get('/partner_car/image/rotate/{id}', 'Admin\CarController@imageRotate')->name('admin.car.image.rotate');
    Route::resource('users', 'Admin\UsersController')->except('show');
    Route::resource('review', 'Admin\ReviewController')->except('show');
    Route::resource('ticket', 'Admin\TicketController')->except('show');
    Route::resource('ticket_dialog', 'Admin\DialogController')->except('show');
    Route::resource('ticket_status', 'Admin\TicketStatusController')->except('show');
    Route::resource('order', 'Admin\OrderController')->except('show');
    Route::resource('currency', 'Admin\CurrencyController')->except('show');
    Route::resource('car', 'Admin\CarController');
    Route::resource('banner', 'Admin\BannerController');
    Route::resource('language', 'Admin\LanguageController');
    Route::resource('translation', 'Admin\TranslationController');
    Route::resource('car_image', 'Admin\CarImageController')->except('show');
    Route::resource('car_brand', 'Admin\CarBrandController');
    Route::resource('page', 'Admin\PageController');
    Route::resource('setting', 'Admin\SettingController');
    Route::resource('payment_method', 'Admin\PaymentMethodIconController')->except('show');
    Route::resource('faq', 'Admin\FAQController');
    Route::resource('article', 'Admin\ArticleController');
    Route::resource('article_comment', 'Admin\ArticleCommentController');
});

Route::post('/send_email', 'FrontController@sendEmail')->name('send_email');
Route::post('/send_review', 'FrontController@sendReview')->name('send_review');
Route::post('/change-avatar', 'FrontController@changeAvatar')->name('change_avatar');

Route::group(
    [
        'prefix' => App\Http\Middleware\Locale::getLocale()
        /*, 'middleware' => 'reconstr'*/
    ],
    function () {
        Route::get('/{alias}', 'FrontController@dynamicalPage')->name('dynamical.page');
    }
);
