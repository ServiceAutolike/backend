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
        $data = Post::orderBy('id')->paginate(3);
        return \response()->json($data);
    }
    public function findID()
    {
        return view('page.app.dash.findid');
    }

    /// check ID Post Facebook with ID
    public function checkIDPostFB($id) {
        $p_id = '$2';
        $u_id = '$3';
        $tokenFB = Config::get('api.fb.token');
        $Facebook = new Facebook();
        $cawFB = $Facebook->login($id);;
        $re = '/^.*(story_fbid=(\d+)&id=(\d+)).+/s';
        $re2 = '/^.*(fbid=(\d+)&id=(\d+)).+/s';
        if (isset($cawFB['location'][1])) {
            $str = $cawFB['location'][1];
            if (strpos($str, 'photo.php?fbid') != false) {
                $post_id = preg_replace($re2, $p_id, $str, 1);
                $user_id = preg_replace($re2, $u_id, $str, 1);
            }
            else {
                $post_id = preg_replace($re, $p_id, $str, 1);
                $user_id = preg_replace($re, $u_id, $str, 1);
            }
            $id_post_final = $user_id . "_" . $post_id;
            try {
                $requestName = json_decode(file_get_contents('https://graph.facebook.com/' . $id_post_final . '?access_token=' . $tokenFB . ''), true);
                $time = $Facebook->GetLocalDateStringFromUTCString($requestName['created_time']);
                if(isset($requestName['message'])) {
                    $picture = $requestName['picture'];
                }
                else {
                    $picture = $requestName['icon'];
                }
                if(isset($requestName['message'])) {
                    $content = $requestName['message'];
                }
                else if(isset($requestName['description'])) {
                    $content = $requestName['description'];
                }
                else {
                    $content = "Không tìm thấy nội dung bài viết hoặc nội dung bài viết trống";
                }
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'time' => $time,
                    'id_post' => $post_id,
                    'id_user' => $user_id,
                    'content' => $content,
                    'picture' => $picture,
                    'name' => $requestName['from']['name']
                ];
                return $data;

            }
            catch (\Exception $e) {
                return response(['code' => 400, 'status' => 'error','message' => 'Không tìm thấy thông tin bài viết của ID này!']);
            }

        }
        else {
            return response(['code' => 400, 'status' => 'error','message' => 'Không tìm thấy thông tin bài viết của ID này!']);
        }

    }

    public function get_valueFromStringUrl($url , $parameter_name)
    {
        $parts = parse_url($url);
        if(isset($parts['query']))
        {
            parse_str($parts['query'], $query);
            if(isset($query[$parameter_name]))
            {
                return $query[$parameter_name];
            }
            else
            {
                return null;
            }
        }
        else
        {
            return null;
        }
    }

    public function GetUserIDFromUsername($username) {
        // For some reason, changing the user agent does expose the user's UID
        $options  = array('http' => array('user_agent' => 'some_obscure_browser'));
        $context  = stream_context_create($options);
        $fbsite = file_get_contents('https://www.facebook.com/' . $username, false, $context);

        // ID is exposed in some piece of JS code, so we'll just extract it
        $srt = explode($fbsite, 'userID');
        dd($srt);
        $fbIDPattern = '/\"entity_id\":\"(\d+)\"/';
        if (!preg_match($fbIDPattern, $fbsite, $matches)) {
            throw new Exception('Unofficial API is broken or user not found');
        }
        return $matches[1];
    }

    public function showInformationFacebook($id) {
        $tokenFB = Config::get('api.fb.token');
        $requestName = json_decode(file_get_contents('https://graph.facebook.com/' . $id . '?access_token=' . $tokenFB . ''), true);
        if(isset($requestName['id'])) {
            $follow = json_decode(file_get_contents('https://graph.facebook.com/' . $requestName['id']. '/subscribers?access_token=' . $tokenFB . '&method=get'), true);
            if(isset($follow['summary']['total_count'])) {
                $number_follow = $follow['summary']['total_count'];
            }
            else {
                $number_follow = false;
            }
            $data = [
                'code' => 200,
                'id' => $requestName['id'],
                'name' => $requestName['name'],
                'avatar' => 'https://graph.facebook.com/'.$id.'/picture?access_token='.$tokenFB,
                'follow' => $number_follow
            ];
        }
        else {
            $data = [
                'code' => 400
            ];
        }
        return $data;
    }

    public function checkid(Request $request)
    {
        $url = (string) $request->url;
        $type = (string) $request->type;
        $tokenFB = Config::get('api.fb.token');
        $Facebook = new Facebook();
        if ($type == "post") {
            if (is_numeric($url)) {
                return $this->checkIDPostFB($url);
            }
            else {
                if (strpos($url, 'story_fbid') != false && strpos($url, 'id') != false) {
                    $id_post = $this->get_valueFromStringUrl($url , "story_fbid");
                    $id_user = $this->get_valueFromStringUrl($url , "id");
                    $id_post_final = $id_user . "_" . $id_post;

                    try {
                        $requestName = json_decode(file_get_contents('https://graph.facebook.com/' . $id_post_final . '?access_token=' . $tokenFB . ''), true);
                        if(isset($requestName['picture'])) {
                            $picture = $requestName['picture'];
                        }
                        else if(isset($requestName['icon'])) {
                            $picture = $requestName['icon'];
                        }
                        else {
                            $picture = "";
                        }
                        if(isset($requestName['story'])) {
                            $content = $requestName['story'];
                        }
                        else if(isset($requestName['message'])) {
                            $content = $requestName['message'];
                        }
                        else if(isset($requestName['description'])) {
                            $content = $requestName['description'];
                        }
                        else {
                            $content = "Không tìm thấy nội dung bài viết hoặc nội dung bài viết trống";
                        }
                        $data = [
                            'code' => 200,
                            'status' => 'success',
                            'time' => $requestName['created_time'],
                            'id_post' => $id_post,
                            'content' => $content,
                            'picture' => $picture,
                            'name' => $requestName['from']['name']
                        ];
                       return $data;
                    }
                    catch (\Exception $e) {
                        return response(['code' => 400, 'status' => 'error','message' => 'Không tìm thấy thông tin bài viết của ID này! (code=500)']);
                    }
                }
                elseif (strpos($url, 'posts') != false) {
                    if(strpos($url, '?') != false) {
                        $str = explode('?', $url);
                        $urlPost= $str[0];
                        $id_post = preg_replace('/[^0-9]/', '', $urlPost);
                    }
                    else {
                        $str = explode('/', $url);
                        $id_post = $str[5];
                    }
                    return $this->checkIDPostFB($id_post);
                }
                elseif (strpos($url, 'photo?fbid') != false) {
                    $id = $this->get_valueFromStringUrl($url , "fbid");
                    return $this->checkIDPostFB($id);
                }
                elseif (strpos($url, 'photo/?fbid') != false) {
                    $id = $this->get_valueFromStringUrl($url , "fbid");
                    return $this->checkIDPostFB($id);
                }
                elseif (strpos($url, 'photos/a.') != false) {
                    $idPhotos = explode("/", $url);
                    return $this->checkIDPostFB($idPhotos[6]);
                }
                else {
                    return $this->checkIDPostFB($url);
                }
            }
        }

        else {
            if (is_numeric($url)) {
                return $this->showInformationFacebook($url);
            }
            elseif (strpos($url, 'profile.php?id=') !== false) {
                $correctURLPattern = '/^https?:\/\/(?:www|m)\.facebook.com\/(?:profile\.php\?id=)?([a-zA-Z0-9\.]+)$/';
                if (!preg_match($correctURLPattern, $url, $matchesProfileID)) {
                    return response()->json(['code' => 400, 'status' => 'error','message' => 'Không tìm thấy thông tin của ID này']);
                } else {
                    $id = $matchesProfileID[1];
                    return $this->showInformationFacebook($id);
                }
            }
            else {
                $url = str_replace('m.facebook.com', 'www.facebook.com', $url);
                $url = str_replace('https://facebook.com', 'https://www.facebook.com', $url);
                if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
                    return response()->json(['code' => 400, 'status' => 'error','message' => 'Đường dẫn URL không đúng định dạng!']);
                }
                else {
                    $url = $url;
                }
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148");
                curl_setopt($ch, CURLOPT_REFERER, "http://www.facebook.com");
                $page = curl_exec($ch) or die(curl_error($ch));
                $fbIDPattern = '/\"entity_id\":\"(\d+)\"/';
                if (!preg_match($fbIDPattern, $page, $matchesbyUsername)) {
                    return response()->json(['code' => 400, 'status' => 'error','message' => 'Không tìm thấy ID']);
                }
                else {
                    $id = $matchesbyUsername[1];
                    return $this->showInformationFacebook($id);
                }
            }
        }
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
