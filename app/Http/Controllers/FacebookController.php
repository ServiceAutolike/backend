<?php

namespace App\Http\Controllers;

use App\RatePrice;
use App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FacebookController extends Controller
{
    public function buffFollowUser()
    {
        return view('page.app.facebook.user.buff-follow');
    }

    public function buffLikeUser()
    {
        return view('page.app.facebook.user.buff-like');
    }

    public function buffLikeUserStore(Request $request)
    {
        $getPriceLikePost = RatePrice::where('type_services', 'like_post')->value('price');
        $getPriceReaction = RatePrice::where('type_services', 'reaction_post')->value('price');
        $now = Carbon::now();
        $getBalance = Auth::user()->point;
        $sv = $request->sv;
        $total_price = $request->number_seeding * $request->sitePrice;
        if($sv== "sv_like") {
            if($total_price <= $getBalance) {
                if($request->sitePrice < $getPriceLikePost) {
                    return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Giá nhập vào không thể nhỏ hơn giá gốc!']);
                }
                else if($request->number_seeding <20) {
                    return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Số lượng tăng tối thiểu là 20!']);
                }
                else if($request->number_seeding >200000) {
                    return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Số lượng tăng đa thiểu là 200,000!']);
                }
                else {
                    $data = [
                        'url_service' => $request->post_id,
                        'speed' => 'high',
                        'number' => 20,
                        'type' => 'facebook_bufflike',
                        'warranty_type' => 7
                    ];
                    $client = new Client([
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Token' => Config::get('api.key.token'),
                            'agency-secret-key' => Config::get('api.key.agency'),
                        ]
                    ]);
                    $response = $client->post(Config::get('api.urlRequest.create'),['body' => json_encode($data, true)]);
                    $dataBody = json_decode($response->getBody(), true);
                    $dataConfirm = [
                        'transaction_code' => $dataBody["data"]["transaction_code"],
                    ];
                    $confirm = $client->post(Config::get('api.urlRequest.confirm'),
                        ['body' => json_encode($dataConfirm, true)]
                    );
                    $responseConfirm = json_decode($confirm->getBody(), true);

                    DB::beginTransaction();
                    try {
                        $services = new Services();
                        $services->user_id = Auth::user()->id;
                        $services->url_services = $request->post_id;
                        $services->id_fb = "";
                        $services->id_instagram = "";
                        $services->id_tiktok = "";
                        $services->id_youtube = "";
                        $services->id_shopee = "";
                        $services->id_lazada = "";
                        $services->name_fb = "";
                        $services->speed = "high";
                        $services->type_services = "like_post";
                        $services->warranty = 7;
                        $services->total_price = $total_price;
                        $services->total_warranty = 0;
                        $services->checkpoint = 0;
                        $services->service_code = "";
                        $services->transaction_code = "";
                        $services->number = $request->number_seeding;
                        $services->number_success = 0;
                        $services->status = 1;
                        $services->created_at = $now;
                        $services->updated_at = $now;
                        $services->save();

                    }
                    catch (\Exception $e) {
                        \Log::info($e);
                        DB::rollBack();
                        return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Có lỗi xảy ra!']);

                    }
                    DB::commit();
                    return response()->json(['code'=>200, 'status' => 'success', 'messages'=>'Tạo đơn mới thành công!']);
                }
            }
            else {
                return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Tài khoản của bạn không đủ tiền!']);
            }
        }
        else if($sv == "sv_reaction") {

        }
        else {
            /// lỗi sever
        }

    }

    public function buffCommentUser()
    {
        return view('page.app.facebook.user.buff-comment');
    }

    public function buffShareUser()
    {
        return view('page.app.facebook.user.buff-share');
    }

    public function buffLikePage()
    {
        return view('page.app.facebook.fanpage.buff-like');
    }

    public function buffMemberGroup()
    {
        return view('page.app.facebook.group.buff-member');
    }

}
