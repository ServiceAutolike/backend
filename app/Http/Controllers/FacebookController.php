<?php

namespace App\Http\Controllers;

use App\ListComment;
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
    public function getListComment() {
        $listcomment = ListComment::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return response()->json($listcomment);
    }
    public function createListComment(Request $request) {
        $data = [
            'name' => $request->name,
            'contents' => $request->comment,
        ];
        $header = [
            'Content-Type' => 'application/json',
            'Token' => Config::get('api.key.token'),
            'agency-secret-key' => Config::get('api.key.agency')
        ];
        $dataCreate = Http::withHeaders($header)->post(Config::get('api.urlRequest.comment'), $data);
        if($dataCreate['code'] == 200) {
            DB::beginTransaction();
            try {
                $listcomment = new ListComment();
                $listcomment->id_user = Auth::user()->id;
                $listcomment->id_comment = $dataCreate['data']['comment_id'];
                $listcomment->name = $request->name;
                $listcomment->content = json_encode($request->comment, true);
                $listcomment->created_at = Carbon::now()->toDateTimeString();
                $listcomment->updated_at = Carbon::now()->toDateTimeString();
                $listcomment->save();
                $data = [
                    'code' => 200,
                ];

            }
            catch (\Exception $e) {
                $data = [
                    'code' => 400,
                    'message' => 'Không thể thêm list comment!'
                ];
            }
            DB::commit();
        }
        else {
            $data = [
                'code' => 500,
                'message' => $dataCreate['message']
            ];
        }

        return response()->json($data);
    }
    public function buffFollowUser()
    {
        return view('page.app.facebook.user.buff-follow');
    }

    public function postBuffFollowUser(Request $request) {
        $getPriceFollow = RatePrice::where('type_services', 'facebook_follow')->value('price');
        $now = Carbon::now();
        $getBalance = Auth::user()->point;
        $total_price = $request->number_seeding * $request->sitePrice;
        $updateBalance = $getBalance - $total_price;
        if($total_price <= $getBalance) {
            if($request->sitePrice < $getPriceFollow) {
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
                    'fanpage_id' => $request->user_id,
                    'speed' => $request->speed,
                    'number' => (int) $request->number_seeding,
                    'type' => 'facebook_follow',
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
                            $services->url_services = $request->user_id;
                            /// $services->id_fb = "";
                            // $services->id_instagram = "";
                            // $services->id_tiktok = "";
                            // $services->id_youtube = "";
                            // $services->id_shopee = "";
                            // $services->id_lazada = "";
                            // $services->name_fb = "";
                            $services->speed = $request->speed;
                            $services->type_services = "facebook_follow";
                            $services->warranty = 7;
                            $services->price = $request->sitePrice;
                            $services->total_price = $total_price;
                            $services->total_warranty = 0;
                            $services->checkpoint = 0;
                            $services->service_code = $services_code;
                            $services->transaction_code = $transaction_code;
                            $services->number = $request->number_seeding;
                            $services->number_success = 0;
                            $services->status = "Active";
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

    public function buffLikeUser()
    {
        return view('page.app.facebook.user.buff-like');
    }


    public function transaction_history() {
        return view('page.app.facebook.history');
    }


    public function postHistory($type, Request $request) {
        if ($request->ajax()) {
            switch ($request->type) {
                case "like":
                    $historyServices = Services::where('type_services', 'like_post')->Orwhere('type_services', 'reaction_post')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(2);
                    break;
                case "sub":
                    $historyServices = Services::where('type_services', 'facebook_follow')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(2);
                    break;
                default:
                    $response = [
                        'data' => null
                    ];
                    break;
            }

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
            return response(['type' => $type, 'fetchDataTransactions' => $response]);
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
                                $services->status = "Active";
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
                                $services->status = "Active";
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
        $now = Carbon::now();
        switch ($type) {
            case "like":
                $data = [];
                $getAllTransactions = Services::where('type_services', 'like_post')->Orwhere('type_services', 'reaction_post')->where('user_id', Auth::user()->id)->where('status', 'Active')->orderBy('id', 'DESC')->get();
                break;
            case "sub":
                $data = [];
                $getAllTransactions = Services::where('type_services', 'facebook_follow')->where('user_id', Auth::user()->id)->where('status', 'Active')->orderBy('id', 'DESC')->get();
                break;
            default:
                break;
        }
        foreach ($getAllTransactions as $getAllTransaction) {
            $connectApi = responseApi($getAllTransaction->service_code);
            $data[$getAllTransaction->service_code] = $connectApi->data->data[0]->status;
            $data['time_update'] = $now;
            $getAllTransaction->status = $connectApi->data->data[0]->status;
            $getAllTransaction->updated_at = $now;
            $getAllTransaction->number_success = $connectApi->data->data[0]->number_success;
            $getAllTransaction->save();
        }
        return response()->json($data);

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







