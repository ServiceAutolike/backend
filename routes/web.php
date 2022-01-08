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


Route::group(['prefix' => 'account'], function (){
    Route::get('/login', 'AccountController@formLogin')->name('account.login');
    Route::post('/login', 'AccountController@login');
    Route::get('/register', 'AccountController@formRegister')->name('account.register');
    Route::post('/register', 'AccountController@register');
});
Route::group(['middleware' => 'login'], function () {
    Route::get('/home', 'HomeController@dash')->name('home.dash');
    Route::post('/loadNotification', 'HomeController@loadNotification')->name('home.test');
    Route::post('/updateNofitication', 'HomeController@updateNotification')->name('home.updated');
    Route::post('/me', 'HomeController@loadMe')->name('home.test');

    Route::post('/loadPost', 'HomeController@loadPostData')->name('home.load_data');
    Route::group(['prefix' => 'recharge'], function (){
        Route::get('/bank', 'RechargeController@rechargeBank')->name('recharge.bank');
        Route::get('/momo', 'RechargeController@rechargeMomo')->name('recharge.momo');
        Route::get('/card', 'RechargeController@rechargeCard')->name('recharge.card');
        Route::get('/history', 'RechargeController@history')->name('recharge.history');
    });

    Route::post('/updateTransaction/{type}', 'FacebookController@updateTransaction')->name('faceUser.updateTransaction');

    Route::group(['prefix' => 'facebook'], function (){
        Route::get('/buff-follow', 'FacebookController@buffFollowUser')->name('faceUser.flow');
        Route::post('/buff-follow', 'FacebookController@postBuffFollowUser')->name('faceUser.postFlow');
        Route::get('/buff-like', 'FacebookController@buffLikeUser')->name('faceUser.like');
        Route::post('/buff-like', 'FacebookController@buffLikeUserStore')->name('faceUser.postLike');
        Route::get('/buff-comment', 'FacebookController@buffCommentUser')->name('faceUser.cmt');
        Route::post('/buff-comment', 'FacebookController@postbuffComment')->name('faceUser.postComment');

        Route::get('/history/{type}', 'FacebookController@transaction_history')->name('faceUser.history');
        Route::post('/history/{type}', 'FacebookController@postHistory')->name('faceUser.phistory');

        Route::get('/buff-share', 'FacebookController@buffShareUser')->name('faceUser.share');

    });
    Route::group(['prefix' => 'facebook-fan-group'], function (){
        Route::get('/buff-like-page', 'FacebookController@buffLikePage')->name('face.pagelike');
        Route::get('/buff-member-group', 'FacebookController@buffMemberGroup')->name('face.groupmemb');
    });
    Route::group(['prefix' => 'instagram'], function (){
        Route::get('/buff-follow', 'InstagramController@buffFollow')->name('ins.flow');
        Route::get('/buff-like', 'InstagramController@buffLike')->name('ins.like');
        Route::get('/buff-comment', 'InstagramController@buffComment')->name('ins.cmt');
    });
    Route::group(['prefix' => 'youtube'], function (){
        Route::get('/buff-sub', 'YoutubeController@buffSub')->name('youtube.flow');
        Route::get('/buff-like', 'YoutubeController@buffLike')->name('youtube.like');
        Route::get('/buff-comment', 'YoutubeController@buffComment')->name('youtube.cmt');
    });
    Route::group(['middleware' => 'role'], function () {
        Route::group(['prefix' => 'user'], function (){
            Route::get('/home', 'UserController@index')->name('user.index');
        });
        Route::get('/welcome', function (){
            return view('welcome');
        });
    });
    Route::group(['prefix' => 'support'], function (){
        Route::get('/user', 'SupportController@indexUser')->name('user.support.list');
        Route::post('/create', 'SupportController@storeUser')->name('support.create');
        Route::post('/set-status', 'SupportController@setStatus')->name('support.set');
    });
    Route::group(['prefix' => 'support_chat'], function (){
        Route::get('/{id}', 'SupportChatController@formChat')->name('support.chat.form');
        Route::post('/', 'SupportChatController@chat')->name('support.chat');
    });
});
Route::group(['middleware' => 'login'], function () {
    Route::group(['middleware' => 'role'], function () {
        Route::group(['prefix' => 'admin'], function (){
            Route::group(['prefix' => 'post'], function (){
                Route::get('/', 'PostController@index')->name('post.index');
                Route::post('/', 'PostController@store')->name('post.create');
                Route::get('/update/{id}', 'PostController@formUpdate')->name('post.update.form');
                Route::post('/update', 'PostController@update')->name('post.update');
                Route::get('delete/{id}', 'PostController@delete');
            });
            Route::group(['prefix' => 'support'], function (){
                Route::get('/', 'SupportController@indexAdmin')->name('support.index');
                Route::post('/update', 'SupportController@updateAdmin')->name('support.update');
            });
            Route::group(['prefix' => 'service'], function (){
                Route::get('/', 'ServiceController@indexAdmin')->name('service.admin.index');
                Route::post('/', 'ServiceController@updateAdmin')->name('service.admin.update');
            });
        });
    });
});
Route::get('/logout', 'AccountController@logout')->name('account.logout');
