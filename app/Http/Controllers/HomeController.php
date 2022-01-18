<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Post;
use App\Recharge;
use App\Services;
use App\User;
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
    public function loadMe() {
        $month = date('m');
        $year = date('Y');
        $user = User::find(Auth::user()->id);
        $total_recharge = Recharge::where('id_user', Auth::user()->id)->sum('amount_end');
        $recharge_month = Recharge::whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('amount_end');
        $recharge_year = Recharge::whereYear('created_at', $year)->sum('amount_end');

        $data = [
            'data' => $user,
            'total_recharge' => $total_recharge,
            'total_recharge_month' => $recharge_month,
            'total_recharge_year' => $recharge_year
        ];

        return \response()->json($data);
    }
    public function loadNotification(Request $request)
    {
        $getNewTopup = Recharge::where('id_user', Auth::user()->id)->where('status', 'New')->orderBy('id', 'DESC')->get();
        return \response()->json($getNewTopup);
    }


    public function updateNotification(Request $request) {
        DB::beginTransaction();
        try {
            $recharge = Recharge::find($request->id);
            $recharge->status = "Updated";
            $recharge->save();
        }
        catch (\Exception $e) {
            \Log::info($e);
            DB::rollBack();
        }
        DB::commit();
        echo "OK";

    }
    function loadPostData(Request $request) {
        $data = Post::orderBy('id')->paginate(1);
        return \response()->json($data);
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
            }

            else {
                if (is_numeric($url)) {
                    $requestName = json_decode(file_get_contents('https://graph.facebook.com/' . $url . '?access_token=' . $tokenFB . ''), true);
                    if (isset($requestName['error'])) {
                        $result = [
                            'code' => 400,
                            'status' => 'error',
                        ];
                    }
                    else if (isset($requestName['name'])) {
                        $result = [
                            'code' => 200,
                            'status' => 'success',
                            'id' => $requestName['id'],
                            'name' => $requestName['name']
                        ];
                    }

                    else if (isset($requestName['from']['name'])) {
                        $result = [
                            'code' => 200,
                            'status' => 'success',
                            'id' => $requestName['from']['id'],
                            'name' => $requestName['from']['name']
                        ];
                    }
                    else {
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
