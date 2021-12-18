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
    Route::group(['middleware' => 'login'], function () {
        Route::get('/logout', 'AccountController@logout')->name('account.logout');
    });
    Route::get('/register', 'AccountController@formRegister')->name('account.register');
    Route::post('/register', 'AccountController@register');
});
Route::group(['middleware' => 'login'], function () {
    Route::get('/', 'HomeController@dash')->name('home.dash');
    Route::group(['prefix' => 'recharge'], function (){
        Route::get('/bank', 'RechargeController@rechargeBank')->name('recharge.bank');
        Route::get('/momo', 'RechargeController@rechargeMomo')->name('recharge.momo');
        Route::get('/card', 'RechargeController@rechargeCard')->name('recharge.card');
        Route::get('/history', 'RechargeController@history')->name('recharge.history');
    });

    Route::group(['prefix' => 'facebook'], function (){
        Route::get('/buff-follow', 'FacebookController@buffFollowUser')->name('faceUser.flow');
        Route::get('/buff-like', 'FacebookController@buffLikeUser')->name('faceUser.like');
        Route::get('/history/{type}', 'FacebookController@transaction_history')->name('faceUser.history');
        Route::post('/history/{type}', 'FacebookController@postHistory')->name('faceUser.phistory');
        Route::post('/buff-like', 'FacebookController@buffLikeUserStore')->name('faceUser.postLike');
        Route::get('/buff-comment', 'FacebookController@buffCommentUser')->name('faceUser.cmt');
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
            Route::get('/', 'UserController@index')->name('user.index');
        });
        Route::get('/welcome', function (){
            return view('welcome');
        });
    });
});
