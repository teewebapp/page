<?php

namespace Tee\Page;
use Route, Config;

Route::group(['prefix' => Config::get('i18n.locale_preffix')], function() {
    Route::any('/pages/{slug}', [
        'as' => 'page.show',
        'uses' => __NAMESPACE__.'\Controllers\PageController@show'
    ]);
});

Route::group(['prefix' => 'admin'], function() {
    Route::post('page/order', [
        'as' => 'admin.page.order',
        'uses' => __NAMESPACE__.'\Controllers\AdminController@order'
    ]);
    Route::resource('page', __NAMESPACE__.'\Controllers\AdminController',
        ['except' => array('show')]
    );
});