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
    Route::post('/loginData', 'AccountController@login');
    Route::get('/register', 'AccountController@formRegister')->name('account.register');
    Route::post('/registerData', 'AccountController@register');
    Route::post('/registerEmail', 'AccountController@registerEmail');
    Route::post('/registerPhone', 'AccountController@registerPhone');
    Route::post('/registerName', 'AccountController@registerUserName');

});
Route::group(['middleware' => 'login'], function () {
    Route::post('/upload', 'UploadController@upload');
    Route::get('/home', 'HomeController@dash')->name('home.dash');
    Route::post('/loadNotification', 'HomeController@loadNotification')->name('home.test');
    Route::post('/updateNofitication', 'HomeController@updateNotification')->name('home.updated');
    Route::post('/me', 'HomeController@loadMe')->name('home.me');
    Route::post('/loadPost', 'HomeController@loadPostData')->name('home.load_data');

    Route::group(['prefix' => 'recharge'], function (){
        Route::get('/bank', 'RechargeController@rechargeBank')->name('recharge.bank');
        Route::get('/momo', 'RechargeController@rechargeMomo')->name('recharge.momo');
        Route::get('/card', 'RechargeController@rechargeCard')->name('recharge.card');
        Route::get('/history', 'RechargeController@history')->name('recharge.history');
        Route::post('/history', 'RechargeController@getHistory')->name('recharge.phistory');
        Route::post('/transaction', 'RechargeController@getHistorywithtype')->name('recharge.transaction');
        Route::post('/scan', 'RechargeController@checkRechargeVCB')->name('recharge.scan');
        Route::get('/getmomo', 'RechargeController@getTransactionMomo')->name('recharge.getmomo');
        Route::post('/scan/momo', 'RechargeController@checkTransactionMomo')->name('recharge.scanmomo');
        Route::post('/scan/updated', 'RechargeController@updateStatusMomo')->name('recharge.updated');


    });

    Route::post('/updateTransaction/{type}', 'FacebookController@updateTransaction')->name('faceUser.updateTransaction');
    Route::group(['prefix' => 'facebook'], function (){
        Route::get('/buff-follow', 'FacebookController@buffFollowUser')->name('faceUser.flow');
        Route::post('/buff-follow', 'FacebookController@postBuffFollowUser')->name('faceUser.postFlow');
        Route::get('/buff-like', 'FacebookController@buffLikeUser')->name('faceUser.like');
        Route::get('/history/{type}', 'FacebookController@transaction_history')->name('faceUser.history');
        Route::post('/history/{type}', 'FacebookController@postHistory')->name('faceUser.history');
        Route::post('/buff-like', 'FacebookController@buffLikeUserStore')->name('faceUser.postLike');
        Route::get('/buff-comment', 'FacebookController@buffCommentUser')->name('faceUser.cmt');
        Route::post('/buff-comment', 'FacebookController@postbuffComment')->name('faceUser.postComment');
        Route::post('/createListComment', 'FacebookController@createListComment')->name('faceUser.createListComment');
        Route::get('/listcomment', 'FacebookController@getListComment')->name('faceUser.getListcomment');
        Route::post('/{id}', 'FacebookController@getTotalComment')->name('faceUser.getTotalComment');
        Route::post('/createListComment', 'FacebookController@createListComment')->name('faceUser.createListComment');
        Route::get('/test', 'FacebookController@test')->name('faceUser.test');
        Route::get('/history/{type}', 'FacebookController@transaction_history')->name('faceUser.history');
        Route::post('/history/{type}', 'FacebookController@postHistory')->name('faceUser.phistory');
        Route::get('/buff-share', 'FacebookController@buffShareUser')->name('faceUser.share');
        Route::get('/buff-livestream', 'FacebookController@buffLivestream')->name('faceUser.livestream');
        Route::get('/buff-member-group', 'FacebookController@addMemberGroup')->name('faceUser.addmembergroup');


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
        Route::get('/user', 'SupportController@viewUser')->name('user.support.list');
        Route::post('/dataUser', 'SupportController@indexUser');
        Route::post('/create', 'SupportController@storeUser');
        Route::post('/update', 'SupportController@setStatus');
        Route::get('/chat/{code}', 'SupportChatController@formChat');
        Route::get('/data/{code}', 'SupportChatController@dataChat');
        Route::post('/sendMess', 'SupportChatController@chat');
    });
});
Route::group(['middleware' => 'login'], function () {
    Route::group(['middleware' => 'role'], function () {
        Route::group(['prefix' => 'admin'], function (){
            Route::group(['prefix' => 'post'], function (){
                Route::get('/', 'PostController@index')->name('post.index');
                Route::get('/data', 'PostController@getAll')->name('post.data');
                Route::post('/create', 'PostController@store');
                Route::get('/update/{id}', 'PostController@formUpdate')->name('post.update.form');
                Route::post('/update', 'PostController@update')->name('post.update');
                Route::get('delete/{id}', 'PostController@delete');
            });
            Route::group(['prefix' => 'support'], function (){
                Route::get('/', 'SupportController@indexAdmin')->name('support.index');
                Route::post('/data', 'SupportController@getData');
                Route::post('/update', 'SupportController@updateAdmin')->name('support.update');
            });
            Route::group(['prefix' => 'service'], function (){
                Route::get('/', 'ServiceController@index')->name('service.admin.index');
                Route::post('/data', 'ServiceController@indexAdmin');
                Route::post('/update', 'ServiceController@updateAdmin')->name('service.admin.update');
            });
            Route::group(['prefix' => 'user'], function (){
                Route::get('/', 'UserController@index');
                Route::post('/data', 'UserController@data');
                Route::get('/change/{id}', 'UserController@change');
                Route::get('/dataChange/{id}', 'UserController@dataChange');
                Route::get('/recharge/{id}', 'UserController@recharge');
                Route::post('/dataRecharge', 'UserController@dataRecharge');
                Route::post('/addPrice', 'UserController@addPrice');
                Route::post('/update', 'UserController@updateData');
                Route::post('/loginUser', 'UserController@loginUser');

            });
        });
    });
});
Route::get('/logout', 'AccountController@logout')->name('account.logout');
