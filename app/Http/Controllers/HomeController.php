<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Config;
use App\Facebook;

class HomeController extends Controller
{
    public function dash()
    {
        $currentBalance = number_format(Auth::user()->point);
        return view('page.app.dash.index', compact('currentBalance'));

    }
    function load_data(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                $data = DB::table('posts')
                    ->where('id', '<', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(2)
                    ->get();
            } else {
                $data = DB::table('posts')
                    ->orderBy('id', 'DESC')
                    ->limit(2)
                    ->get();
            }
            $output = '';
            $last_id = '';

            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    $output .=
                        '
                    <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body pb-0">
                        <!--begin::Header-->
                        <div class="d-flex align-items-center mb-5">
                            <!--begin::User-->
                            <div class="d-flex align-items-center flex-grow-1">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-45px me-5">
                                    <img src="'. asset('storage/uploads/user/img_avatar.png') .' " alt="" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <a class="text-gray-900 text-hover-primary fs-6 fw-bolder">Quản Trị Viên</a>
                                    <span class="text-gray-400 fw-bold">'.convertTime($row->created_at).'</span>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Post-->
                        <div class="mb-5">
                            <!--begin::Text-->
                            <img src="'.asset('storage/'.$row->image).'" alt="" style="width:100%" class="rounded mb-4">
                            <p class="text-gray-800 fw-normal mb-5">
                                '. $row->content .'
                            </p>
                            <!--end::Text-->

                        </div>
                        <!--end::Post-->
                    </div>
                    <!--end::Body-->
                </div>
                    ';
                    $last_id = $row->id;
                }
                $output .=
                    '
                   <div id="load_more">
                    <button type="button" name="load_more_button" class="btn btn-primary w-100 text-center" data-id="' .
                    $last_id .
                    '" id="load_more_button">Xem thêm</button>
                   </div>
                   ';
            } else {
                $output .= '

                   ';
            }
            echo $output;
        }
    }
    public function findID()
    {
        return view('page.app.dash.findid');
    }

    public function checkid(Request $request)
    {
        $url = (string) $request->url;
        $type = (string) $request->type;
        $tokenFB = Config::get('api.fb.token');
        $p_id = '$2';
        $u_id = '$3';
        try {
            if ($type == "post") {
                $Facebook = new Facebook();
                if (is_numeric($url)) {
                    try {
                        $cawFB = $Facebook->login($url);
                        $re = '/^.*(story_fbid=(\d+)&id=(\d+)).+/s';
                        if (isset($cawFB['location'][1])) {
                            $str = $cawFB['location'][1];
                            $post_id = preg_replace($re, $p_id, $str, 1);
                            $user_id = preg_replace($re, $u_id, $str, 1);
                            $id_post_final = $user_id . "_" . $post_id;
                            $requestName = json_decode(file_get_contents('https://graph.facebook.com/' . $id_post_final . '/?access_token=' . $tokenFB . ''), true);
                            $time = $Facebook->GetLocalDateStringFromUTCString($requestName['created_time']);
                            $result = [
                                'code' => 200,
                                'status' => 'success',
                                'id' => $post_id,
                            ];
                        } else {
                            $result = [
                                'code' => 400,
                                'status' => 'error',
                                'message' => "Không tìm thấy thông tin bài viết của ID này tên Facebook!",
                            ];
                        }
                    } catch (Exception $exception) {
                        $result = [
                            'code' => 400,
                            'status' => 'error',
                            'message' => "Không tìm thấy thông tin bài viết của ID này tên Facebook!",
                        ];
                    }
                } else {
                    if (strpos($url, 'permalink.php?story_fbid=') !== false) {
                        $parts = parse_url($url);
                        parse_str($parts['query'], $query);
                        $idParmalink = $query['story_fbid'];
                        $result = [
                            'code' => 200,
                            'status' => 'success',
                            'id' => $idParmalink,
                        ];
                    } elseif (strpos($url, 'photos/a.') !== false) {
                        $idPhotos = explode("/", $url);
                        $result = [
                            'code' => 200,
                            'status' => 'success',
                            'id' => $idPhotos[6],
                        ];
                    } elseif (strpos($url, 'posts') !== false) {
                        $idPost = preg_replace('/[^0-9]/', '', $url);
                        $result = [
                            'code' => 200,
                            'status' => 'success',
                            'id' => $idPost,
                        ];
                    } else {
                        $result = [
                            'code' => 400,
                            'status' => 'error',
                            'id' => "null",
                            'message' => "URL hoặc ID này không tồn tại, vui lòng kiểm tra lại!",
                        ];
                    }
                }
            } else {
                if (is_numeric($url)) {
                    $requestName = json_decode(file_get_contents('https://graph.facebook.com/' . $url . '/?fields=name&access_token=' . $tokenFB . ''), true);
                    if (isset($requestName['name'])) {
                        $result = [
                            'code' => 200,
                            'status' => 'success',
                            'id' => $requestName['id'],
                            'name' => $requestName['name'],
                        ];
                    } else {
                        $result = [
                            'code' => 400,
                            'status' => 'error',
                        ];
                    }
                } elseif (strpos($url, 'profile.php?id=') !== false) {
                    $correctURLPattern = '/^https?:\/\/(?:www|m)\.facebook.com\/(?:profile\.php\?id=)?([a-zA-Z0-9\.]+)$/';
                    if (!preg_match($correctURLPattern, $url, $matchesProfileID)) {
                        $result = [
                            'code' => 400,
                            'status' => 'error',
                        ];
                    } else {
                        $id = $matchesProfileID[1];
                        $requestName = json_decode(file_get_contents('https://graph.facebook.com/' . $id . '/?fields=name&access_token=' . $tokenFB . ''), true);
                        if (isset($requestName['name'])) {
                            $result = [
                                'code' => 200,
                                'status' => 'error',
                                'id' => $requestName['id'],
                                'name' => $requestName['name'],
                            ];
                        } else {
                            $result = [
                                'code' => 400,
                                'status' => 'error',
                            ];
                        }
                    }
                } else {
                    $options = [
                        'http' => [
                            'method' => "GET",
                            'header' => "Accept-language: en\r\n" . "Cookie: ffr=1SFmWnQdXWYMA9TZa..BfQlvy.lp.AAA.0.0.BfQlv8.AWX5oTkt; dpr=2\r\n",
                            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
                        ],
                    ];
                    $context = stream_context_create($options);
                    $fbsite = file_get_contents($url, false, $context);
                    // Find entity class
                    $fbIDPattern = '/\"entity_id\":\"(\d+)\"/';
                    if (!preg_match($fbIDPattern, $fbsite, $matchesbyUsername)) {
                        $result = [
                            'code' => 400,
                            'status' => 'error',
                        ];
                    } else {
                        $id = $matchesbyUsername[1];
                        $requestName = json_decode(file_get_contents('https://graph.facebook.com/' . $id . '/?fields=name&access_token=' . $tokenFB . ''), true);
                        if (isset($requestName['name'])) {
                            $name = $requestName['name'];
                            $result = [
                                'code' => 200,
                                'status' => 'success',
                                'id' => $id,
                                'name' => $name,
                            ];
                        } else {
                            $result = [
                                'code' => 200,
                                'status' => 'success',
                                'id' => $id,
                                'name' => "null",
                            ];
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $result = [
                'status' => "error",
                'code' => 500,
            ];
        }
        return response()->json($result);
    }

    public function getlike(Request $request)
    {
        $data = [
            'fanpage_id' => $request->id_post,
            'speed' => 'high',
            'number' => (int) $request->number_like,
            'type' => 'facebook_follow',
            'warranty_type' => 7,
        ];

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Token' => '2I6NGN4UXSKRN4IHZV772O',
                'agency-secret-key' => '056bb791-5674-11ec-a4d4-56000335e4d7',
            ],
        ]);

        try {
            // your code here
            $response = $client->post('https://agency.autolike.cc/public-api/v1/agency/services/create-V2', ['body' => json_encode($data, true)]);

            $dataBody = json_decode($response->getBody(), true);
            $data2 = [
                'transaction_code' => $dataBody["data"]["transaction_code"],
            ];

            $confirm = $client->post('https://agency.autolike.cc/public-api/v1/agency/services/confirm', ['body' => json_encode($data2, true)]);

            dd(json_decode($confirm->getBody()));
        } catch (ClientException $e) {
            // catches all ClientExceptions
            dd($e);
        }
    }
}
