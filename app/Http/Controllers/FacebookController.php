<?php

namespace App\Http\Controllers;

use App\ApiServices;
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


    public function addMemberGroup() {
        return view('page.app.facebook.buff-member-group');
    }

    public function buffLivestream() {
        return view('page.app.facebook.buff-livestream');
    }

    public function postbuffComment(Request $request) {
        $getPriceFollow = RatePrice::where('type_services', 'facebook_comment')->value('price');
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
                $apiServices = new ApiServices();
                $data = [
                    'url_service' => $request->post_id,
                    'comment_id' => $request->id_comment,
                    'speed' => $request->speed,
                    'number' => (int) $request->number_seeding,
                    'type' => 'facebook_buffcomment'
                ];
                $dataCreate = $apiServices->postServices(Config::get('api.urlRequest.create'), $data);
                if($dataCreate['code'] == 200) {
                    $services_code = $dataCreate['data']['service_codes'][0];
                    $transaction_code = $dataCreate["data"]["transaction_code"];
                    $dataConfirm = ['transaction_code' => $transaction_code];
                    $confirm = $apiServices->postServices(Config::get('api.urlRequest.confirm'), $dataConfirm);
                    if ($confirm['code'] == 200) {
                        DB::beginTransaction();
                        try {
                            $services = new Services();
                            $services->user_id = Auth::user()->id;
                            $services->url_services = $request->user_id;
                            $services->speed = $request->speed;
                            $services->type_services = "facebook_comment";
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
    public function get_web_page( $url )
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        $options = array(
            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        );
        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }
    public function test() {
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
        $fields_string = [
            'fburl' => 'https://www.facebook.com/tran.huyen.33449138'
        ];
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, 'https://lookup-id.com/#');

        curl_setopt($ch, CURLOPT_HEADER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADERS,array('Content-Type:application/x-www-form-urlencoded','Cookie: NID=67=pdjIQN5CUKVn0bRgAlqitBk7WHVivLsbLcr7QOWMn35Pq03N1WMy6kxYBPORtaQUPQrfMK4Yo0vVz8tH97ejX3q7P2lNuPjTOhwqaI2bXCgPGSDKkdFoiYIqXubR0cTJ48hIAaKQqiQi_lpoe6edhMglvOO9ynw; PREF=ID=52aa671013493765:U=0cfb5c96530d04e3:FF=0:LD=en:TM=1370266105:LM=1370341612:GM=1:S=Kcc6KUnZwWfy3cOl; OTZ=1800625_34_34__34_; S=talkgadget=38GaRzFbruDPtFjrghEtRw; SID=DQAAALoAAADHyIbtG3J_u2hwNi4N6UQWgXlwOAQL58VRB_0xQYbDiL2HA5zvefboor5YVmHc8Zt5lcA0LCd2Riv4WsW53ZbNCv8Qu_THhIvtRgdEZfgk26LrKmObye1wU62jESQoNdbapFAfEH_IGHSIA0ZKsZrHiWLGVpujKyUvHHGsZc_XZm4Z4tb2bbYWWYAv02mw2njnf4jiKP2QTxnlnKFK77UvWn4FFcahe-XTk8Jlqblu66AlkTGMZpU0BDlYMValdnU; HSID=A6VT_ZJ0ZSm8NTdFf; SSID=A9_PWUXbZLazoEskE; APISID=RSS_BK5QSEmzBxlS/ApSt2fMy1g36vrYvk; SAPISID=ZIMOP9lJ_E8SLdkL/A32W20hPpwgd5Kg1J'));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        //CHANGE THIS
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
        curl_setopt($ch,CURLOPT_POST, count($fields_string));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string['fburl']);
        $result = curl_exec($ch);
        $last = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        dd(array($result,$last));
        curl_close($ch);
    }
    public function getListComment() {
        $listcomment = ListComment::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return response()->json($listcomment);
    }

    public function getTotalComment(Request $request) {
        $comment = ListComment::where('id_user', Auth::user()->id)->where('id_comment', $request->id_comment)->first();
        $data = [
            'total' => $comment['total'],
            'comment' => $comment['content'],
        ];
        return response()->json($data);
    }
    public function createListComment(Request $request) {
        $data = [
            'name' => $request->name,
            'contents' => $request->comment,
        ];
        $total = count($request->comment);
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
                $listcomment->total = $total;
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
        return view('.buff-follow');
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
        return view('page.app.facebook.buff-like');
    }


    public function transaction_history() {
        return view('page.app.facebook.history');
    }


    public function postHistory($type, Request $request) {
        if ($request->ajax()) {
            switch ($request->type) {
                case "like":
                    if($request->id_post != "") {
                        $like_post = 'like_post';
                        $reaction_post = 'reaction_post';
                        $id_search = $request->id_post;
                        $id_user = Auth::user()->id;
                        $historyServicesSearch = Services::where(function ($query) use ($like_post, $reaction_post) {
                            $query->where('type_services', '=', $like_post)
                                ->orWhere('type_services', '=', $reaction_post);
                        })->where(function ($query) use ($id_user) {
                            $query->where('user_id', '=', $id_user);
                        })->where(function ($query) use ($id_search) {
                            $query->where('url_services', 'LIKE', '%' . $id_search . '%');
                        })->get();
                        return response(['type' => $type, 'data' => $historyServicesSearch]);
                    }
                    else {
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
                        return response(['type' => $type, 'fetchDataTransactions' => $response]);
                    }
                    break;
                case "sub":
                    if($request->id_post != "") {
                        $facebook_follow = 'facebook_follow';
                        $id_search = $request->id_post;
                        $id_user = Auth::user()->id;
                        $historyServicesSearch = Services::where(function ($query) use ($facebook_follow) {
                            $query->where('type_services', '=', $facebook_follow);
                        })->where(function ($query) use ($id_user) {
                            $query->where('user_id', '=', $id_user);
                        })->where(function ($query) use ($id_search) {
                            $query->where('url_services', 'LIKE', '%' . $id_search . '%');
                        })->get();
                        return response(['type' => $type, 'data' => $historyServicesSearch]);
                    }
                    else {
                        $historyServices = Services::where('type_services', 'facebook_follow')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(2);
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
                    break;
                default:
                    $response = [
                        'data' => null
                    ];
                    break;
            }
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

    public function updateTransaction(Request $request) {
        $now = Carbon::now();
        switch ($request->type) {
            case "like":
                $data = [];
                $like_post = 'like_post';
                $reaction_post = 'reaction_post';
                $auth_id = Auth::user()->id;
                $status = 'Active';
                ///$getAllTransactions = Services::where('type_services', 'like_post')->Orwhere('type_services', 'reaction_post')->where('user_id', Auth::user()->id)->where('status', 'Active')->orderBy('id', 'DESC')->get();
                $getAllTransactions = Services::where(function ($query) use ($like_post, $reaction_post) {
                    $query->where('type_services', '=', $like_post)
                        ->orWhere('type_services', '=', $reaction_post);
                })->where(function ($query) use ($auth_id) {
                    $query->where('user_id', '=', $auth_id);
                })->where(function ($query) use ($status) {
                    $query->where('status', '=', $status);
                })->orderBy('id', 'DESC')->get();
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
            $getAllTransaction->status = $connectApi->data->data[0]->status;
            if($request->status == 'updated') {
                $getAllTransaction->updated_at = $now;
                $data['time_update'] = $now;
            }
            else {
                $getAllTransaction->updated_at = $getAllTransaction->updated_at;
                $data['time_update'] = $getAllTransaction->updated_at;
            }
            $getAllTransaction->number_success = $connectApi->data->data[0]->number_success;
            $getAllTransaction->save();
        }
        return response()->json($data);

    }

    public function buffCommentUser()
    {
        return view('page.app.facebook.buff-comment');
    }

    public function buffShareUser()
    {
        return view('page.app.facebook.buff-share');
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







