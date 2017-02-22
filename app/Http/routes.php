<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

if (getenv('APP_ENV') === 'local') {
    \DB::connection('mongodb')->enableQueryLog();
}

Route::get(
    '/',
    ['as' => '/', 'uses' => 'HomeController@index']
);

Route::get(
    '/contracts',
    [
        'as'   => 'contracts',
        'uses' => 'ContractController@index'
    ]
);

Route::get(
    '/contracts/contractor',
    [
        'as'   => 'contracts.contractorIndex',
        'uses' => 'ContractController@contractorIndex'
    ]
);

Route::get(
    '/contracts/contractor/{name}',
    [
        'as'   => 'contracts.contractor',
        'uses' => 'ContractController@show'
    ]
);

Route::get(
    '/contractor/{name}/{type}/list',
    [
        'as'   => 'contracts.linkage',
        'uses' => 'ContractController@linkage'
    ]
);

Route::get(
    '/contracts/{id}',
    [
        'as'   => 'contracts.view',
        'uses' => 'ContractController@view'
    ]
);

Route::get(
    '/ocds/{id}/json',
    [
        'as'   => 'contracts.jsonView',
        'uses' => 'ContractController@jsonView'
    ]
);

Route::get(
    '/procuring-agency/{name}',
    [
        'as'   => 'procuring-agency.show',
        'uses' => 'ProcuringAgencyController@show'
    ]
);

Route::get(
    '/procuring-agency',
    [
        'as'   => 'procuring-agency.index',
        'uses' => 'ProcuringAgencyController@index'
    ]
);

Route::get(
    '/api/procuring-agency',
    [
        'as'   => 'procuring-agency.api',
        'uses' => 'ProcuringAgencyController@getProcuringAgency'
    ]
);

Route::get(
    '/goods',
    [
        'as'   => 'goods.index',
        'uses' => 'GoodsController@index'
    ]
);

Route::get(
    '/filter',
    [
        'as'   => 'filter',
        'uses' => 'HomeController@filter'
    ]
);

Route::get(
    '/api/data',
    [
        'as'   => 'api.data',
        'uses' => 'HomeController@getData'
    ]
);

Route::get(
    '/api/contactorData',
    [
        'as'   => 'api.contactorData',
        'uses' => 'HomeController@getContractorData'
    ]
);

Route::get(
    '/search',
    [
        'as'   => 'search',
        'uses' => 'HomeController@search'
    ]
);

Route::get(
    '/tenders',
    [
        'as'   => 'tenders.index',
        'uses' => 'TenderController@index'
    ]
);

Route::get(
    '/api/tenders',
    [
        'as'   => 'tenders.api',
        'uses' => 'TenderController@getTenders'
    ]
);

Route::get(
    '/tenders/{tender}',
    [
        'as'   => 'tenders.show',
        'uses' => 'TenderController@show'
    ]
);

Route::get(
    '/api/goods',
    [
        'as'   => 'goods.api',
        'uses' => 'GoodsController@getAllGoods'
    ]
);

Route::post(
    '/subscriptions/add',
    [
        'as'   => 'subscriptions.add',
        'uses' => 'SubscriptionsController@add'
    ]
);
Route::get('/about', function () {
    return view('about');
});

Route::get('/error', function () {
    return view('error_404');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post(
    '/contact',
    [
        'as'   => 'home.contact',
        'uses' => 'HomeController@sendMessage'
    ]
);

Route::post(
    '/contracts',
    [
        'as'   => 'contracts.feedback',
        'uses' => 'ContractController@sendMessage'
    ]
);
Route::get('/export', ['as' => 'home.export', 'uses' => 'HomeController@export']);
Route::get('contractor-detail/export/{name}', ['as' => 'contractorDetail.export', 'uses' => 'ContractController@contractorDetailExport']);
Route::get('agency-detail/export/{name}', ['as' => 'agencyDetail.export', 'uses' => 'ProcuringAgencyController@agencyDetailExport']);
Route::get('goods-detail/export/{name}', ['as' => 'goodsDetail.export', 'uses' => 'GoodsController@goodsDetailExport']);

Route::get('goods/export', ['as' => 'goods.export', 'uses' => 'GoodsController@exportGoods']);
Route::get('agency/export', ['as' => 'agency.export', 'uses' => 'ProcuringAgencyController@exportAgencies']);
Route::get('contractor/export', ['as' => 'contractor.export', 'uses' => 'ContractController@exportContractors']);
Route::get('tender/export', ['as' => 'tender.export', 'uses' => 'TenderController@exportTenders']);
Route::get('tender-goods/export/{id}', ['as' => 'tenderGoods.export', 'uses' => 'TenderController@exportTenderGoods']);
Route::get('tender-contracts/export/{id}', ['as' => 'tenderContracts.export', 'uses' => 'TenderController@exportTenderContracts']);

Route::get(
    '/goods/{name}',
    [
        'as'   => 'goods',
        'uses' => 'GoodsController@show'
    ]
);

Route::get(
    '/newsletter/content',
    [
        'as'   => 'newsletter.content',
        'uses' => 'NewsletterController@getContentView'
    ]
);

Route::post(
    '/api/newsletter/subscribe',
    [
        'as'   => 'newsletter.subscribeUser',
        'uses' => 'NewsletterController@subscribeUser'
    ]
);

Route::get('/csv/download', function () {
    return response()->download(base_path('public') . '/csv/contracts_csv.csv');
});
Route::get('/csv/download/tenders', function () {
    return response()->download(base_path('public') . '/csv/tenders_csv.csv');
});

Route::get('/csv/download/goods', function () {
    return response()->download(base_path('public') . '/csv/goods_csv.csv');
});

Route::get('/csv/download/agencies', function () {
    return response()->download(base_path('public') . '/csv/agencies_csv.csv');
});

Route::get('/csv/download/contractors', function () {
    return response()->download(base_path('public') . '/csv/contractors_csv.csv');
});

Route::group(['prefix' => 'comments'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/like/vote', 'LikeController@vote');
        Route::get('/comment/add', 'CommentController@add');
    });
});

Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function () {
    Route::get('social/redirect/{provider}', 'SocialAuthController@redirect')->where(['provider' => '\b(?:facebook|google)\b']);;
    Route::get('social/callback/{provider}', 'SocialAuthController@callback')->where(['provider' => '\b(?:facebook|google)\b']);;
});

Route::get('logout', 'Auth\AuthController@logout');

Route::get('/home', 'HomeController@index');

Route::get('login',
           [
               'as' => 'login',
               'uses' => 'Auth\AuthController@showLoginForm'
           ]);

Route::post('login',
            [
                'as' => 'login',
                'uses' => 'Auth\AuthController@login'
            ]);

Route::get('logout',
           [
               'as' => 'logout',
               'uses' => 'Auth\AuthController@logout'
           ]);

Route::get('admin',
           [
               'as' => 'admin',
               'uses' => 'Admin\FeedbackController@index'
           ]);
