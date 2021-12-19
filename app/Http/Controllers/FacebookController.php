<?php

namespace App\Http\Controllers;

use App\RatePrice;
use App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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


    public function transaction_history() {
        return view('page.app.facebook.history');
    }


    public function postHistory($type, Request $request) {
            if ($request->ajax()) {
                $historyServices = Services::where('type_services', 'like_post')->Orwhere('type_services', 'reaction_post')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(2);
                $response = [
                    'pagination' => [
                        'total' => $historyServices->total(),
                        'per_page' => $historyServices->perPage(),
                        'current_page' => $historyServices->currentPage(),
                        'last_page' => $historyServices->lastPage(),
                        'from' => $historyServices->firstItem(),
                        'to' => $historyServices->lastItem()
                    ],
                    'data' => $historyServices
                ];

                return response(['success' => true,'type' => $type, 'fetchDataTransactions' => $response]);
            }

    }

    public function buffLikeUserStore(Request $request)
    {
        $getPriceLikePost = RatePrice::where('type_services', 'like_post')->value('price');
        $getPriceReaction = RatePrice::where('type_services', 'reaction_post')->value('price');
        $now = Carbon::now();
        $getBalance = Auth::user()->point;
        $sv = $request->sv;
        $total_price = $request->number_seeding * $request->sitePrice;
        $updateBalance = $getBalance - $total_price;
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
                        'number' => (int) $request->number_seeding,
                        'type' => 'facebook_bufflike',
                        'warranty_type' => (int) $request->warranty
                    ];
                    $header = [
                        'Content-Type' => 'application/json',
                        'Token' => Config::get('api.key.token'),
                        'agency-secret-key' => Config::get('api.key.agency')
                    ];
                    $dataCreate = Http::withHeaders($header)->post(Config::get('api.urlRequest.create'), $data);
                    if($dataCreate['code'] == 200) {
                        $services_code = $dataCreate['data']['service_codes'][0];
                        $transaction_code = $dataCreate["data"]["transaction_code"];
                        $dataConfirm = ['transaction_code' => $transaction_code];
                        $confirm = Http::withHeaders($header)->post(Config::get('api.urlRequest.confirm'), $dataConfirm);
                        if ($confirm['code'] == 200) {
                            DB::beginTransaction();
                            try {
                                $services = new Services();
                                $services->user_id = Auth::user()->id;
                                $services->url_services = $request->post_id;
                                /// $services->id_fb = "";
                                // $services->id_instagram = "";
                                // $services->id_tiktok = "";
                                // $services->id_youtube = "";
                                // $services->id_shopee = "";
                                // $services->id_lazada = "";
                                // $services->name_fb = "";
                                $services->speed = "high";
                                $services->type_services = "like_post";
                                $services->warranty = 7;
                                $services->price = $request->sitePrice;
                                $services->total_price = $total_price;
                                $services->total_warranty = 0;
                                $services->reactions = $request->reaction;
                                $services->checkpoint = 0;
                                $services->service_code = $services_code;
                                $services->transaction_code = $transaction_code;
                                $services->number = $request->number_seeding;
                                $services->number_success = 0;
                                $services->status = 1;
                                $services->reactions = json_encode($request->reaction, true);
                                $services->created_at = Carbon::now()->toDateTimeString();
                                $services->save();

                            } catch (\Exception $e) {
                                \Log::info($e);
                                DB::rollBack();
                                return response()->json(['code' => 400, 'status' => 'error', 'messages' => 'Có lỗi xảy ra!']);

                            }
                            DB::table('users')->where('id', Auth::user()->id)->update( array('point'=>$updateBalance) );
                            DB::commit();

                            return response()->json(['code' => 200, 'status' => 'success', 'messages' => 'Tạo đơn mới thành công!']);
                        } else {
                            return response()->json(['code' => 400, 'status' => 'error', 'messages' => 'Có lỗi xảy ra! Vui lòng thử lại.']);
                        }
                    }
                    else if($dataCreate['code'] == 400) {
                        return response()->json(['code' => 400, 'status' => 'error', 'messages' => $dataCreate['message']]);
                    }
                    else {
                        return response()->json(['code' => 400, 'status' => 'error', 'messages' => 'Có lỗi xảy ra với sever API, vui lòng liên hệ admin!']);
                    }
                }
            }
            else {
                return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Tài khoản của bạn không đủ tiền!']);
            }
        }
        else if($sv == "sv_reaction") {
            if($total_price <= $getBalance) {
                if($request->sitePrice < $getPriceReaction) {
                    return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Giá nhập vào không thể nhỏ hơn giá gốc!']);
                }
                else if($request->number_seeding <20) {
                    return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Số lượng tăng tối thiểu là 20!']);
                }
                else if($request->number_seeding >200000) {
                    return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Số lượng tăng đa thiểu là 200,000!']);
                }
                else {
                    //run
                    $data = [
                        'url_service' => $request->post_id,
                        'speed' => 'high',
                        'reaction_types' => $request->reaction,
                        'number' => (int) $request->number_seeding,
                        'type' => 'facebook_reaction',
                        'warranty_type' => (int) $request->warranty
                    ];
                    $header = [
                        'Content-Type' => 'application/json',
                        'Token' => Config::get('api.key.token'),
                        'agency-secret-key' => Config::get('api.key.agency')
                    ];
                    $dataCreate = Http::withHeaders($header)->post(Config::get('api.urlRequest.create'), $data);
                    if($dataCreate['code'] == 200) {
                        $services_code = $dataCreate['data']['service_codes'][0];
                        $transaction_code = $dataCreate["data"]["transaction_code"];
                        $dataConfirm = ['transaction_code' => $transaction_code];
                        $arr[] = $request->reaction;
                        $confirm = Http::withHeaders($header)->post(Config::get('api.urlRequest.confirm'), $dataConfirm);
                        if ($confirm['code'] == 200) {
                            DB::beginTransaction();
                            try {
                                $services = new Services();
                                $services->user_id = Auth::user()->id;
                                $services->url_services = $request->post_id;
                                /// $services->id_fb = "";
                                // $services->id_instagram = "";
                                // $services->id_tiktok = "";
                                // $services->id_youtube = "";
                                // $services->id_shopee = "";
                                // $services->id_lazada = "";
                                // $services->name_fb = "";
                                $services->speed = "high";
                                $services->type_services = "reaction_post";
                                $services->warranty = 7;
                                $services->price = $request->sitePrice;
                                $services->total_price = $total_price;
                                $services->total_warranty = 0;
                                $services->checkpoint = 0;
                                $services->service_code = $services_code;
                                $services->transaction_code = $transaction_code;
                                $services->number = $request->number_seeding;
                                $services->number_success = 0;
                                $services->status = 1;
                                $services->reactions = json_encode($request->reaction, true);
                                $services->created_at = $now;
                                $services->updated_at = $now;
                                $services->save();

                            } catch (\Exception $e) {
                                \Log::info($e);
                                DB::rollBack();
                                return response()->json(['code' => 400, 'status' => 'error', 'messages' => 'Có lỗi xảy ra!']);

                            }
                            DB::commit();
                            return response()->json(['code' => 200, 'status' => 'success', 'messages' => 'Tạo đơn mới thành công!']);
                        } else {
                            return response()->json(['code' => 400, 'status' => 'error', 'messages' => 'Có lỗi xảy ra! Vui lòng thử lại.']);
                        }
                    }
                    else if($dataCreate['code'] == 400) {
                        return response()->json(['code' => 400, 'status' => 'error', 'messages' => $dataCreate['message']]);
                    }
                    else {
                        return response()->json(['code' => 400, 'status' => 'error', 'messages' => 'Có lỗi xả ra với sever API, vui lòng liên hệ admin!']);
                    }

                }
            }
            else {
                return response()->json(['code' => 400, 'status' => 'error', 'messages' => 'Có lỗi xả ra với sever API, vui lòng liên hệ admin!']);
            }
        }
        else {
            /// lỗi sever
             return response()->json(['code'=>400, 'status' => 'error', 'messages'=>'Lỗi sever phải là sv_like hoặc sv_reaction!']);
        }

    }

    public function updateTransaction($type) {
        if($type == "like") {
//            $getAllTransaction = Services::where('type_services', 'like_post')->Orwhere('type_services', 'reaction_post')->where('user_id', Auth::user()->id)->where('status',1)->orderBy('id', 'DESC')->get();
//
//            $firts = response()->json($getAllTransaction[0]['id']);
//            $nextID = (int) $firts - 1;
//            return response()->json(['firt'=>$firts, 'nextID' =>  $nextID]);
        }

//        $response = [
//            'data' => $getAllTransaction
//        ];
//        return response(['success' => true, 'getAllTransaction' => $response]);
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
