<?php

namespace App\Http\Controllers;

use App\RatePrice;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Auth;


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
        $getBalance = Auth::user()->point;
        $sv = $request->sv;
        $total_price = $request->number_seeding * $request->sitePrice;
        if($sv== "sv_like") {
            if($total_price <= $getBalance) {
                if($request->sitePrice < $getPriceLikePost) {
                    return redirect()->back()->with(['add_level'=>'danger','add_messages' => 'Giá nhập vào không thể nhỏ hơn giá gốc!']);
                }
                else if($request->number_seeding <20) {
                    return redirect()->back()->with(['add_level'=>'danger','add_messages' => 'Số lượng tăng tối thiểu là 20!']);
                }
                else if($request->number_seeding >200000) {
                    return redirect()->back()->with(['add_level'=>'danger','add_messages' => 'Số lượng tăng đa thiểu là 200,000!']);
                }
                else {
                    DB::beginTransaction();
                    try {

                    }
                    catch (\Exception $e) {
                        \Log::info($e);
                        DB::rollBack();
                        return redirect()->back()->with(['add_level'=>'danger','add_messages' => 'Có lỗi xảy ra!']);

                    }
                    DB::commit();
                    return redirect()->back()->with(['add_level'=>'success','add_messages' => 'Tạo đơn mới thành công!']);
                }
            }
            else {
                return redirect()->back()->with(['add_level'=>'danger','add_messages' => 'Tài khoản của bạn không đủ tiền!']);
            }
        }
        else if($sv == "sv_reaction") {

        }
        else {
            /// lỗi sever
        }

//        if($total_price <= $getBalance) {
//
//        }
//        else {
//
//        }
        $data = [
            'url_service' => $request->id,
            'speed' => 'high',
            'number' => (int)$request->number,
            'type' => 'facebook_bufflike',
            'warranty_type' => (int)$request->warranty
        ];
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Token' => Config::get('api.key.token'),
                'agency-secret-key' => Config::get('api.key.agency'),
            ]
        ]);

//        $response = $client->post(Config::get('api.urlRequest.create'),
//            ['body' => json_encode($data, true)]
//        );
//
//        $dataBody = json_decode($response->getBody(), true);
//        $dataConfirm = [
//            'transaction_code' => $dataBody["data"]["transaction_code"],
//        ];
//
//        $confirm = $client->post(Config::get('api.urlRequest.confirm'),
//            ['body' => json_encode($dataConfirm, true)]
//        );
//        $datadata = json_decode($confirm->getBody(), true);
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
