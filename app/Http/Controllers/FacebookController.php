<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

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
        $data = [
            'url_service' => $request->id,
            'speed' => 'high',
            'number' => (int) $request->number,
            'type' => 'facebook_bufflike',
            'warranty_type' => (int) $request->warranty
        ];

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Token' => '2I6NGN4UXSKRN4IHZV772O',
                'agency-secret-key' => '056bb791-5674-11ec-a4d4-56000335e4d7'
            ]
        ]);


            $response = $client->post('https://agency.autolike.cc/public-api/v1/agency/services/create-V2',
                ['body' => json_encode($data, true)]
            );

//            $dataBody =  json_decode($response->getBody(), true);
//            $dataConfirm = [
//                'transaction_code' => $dataBody["data"]["transaction_code"],
//            ];
//
//            $confirm = $client->post('https://agency.autolike.cc/public-api/v1/agency/services/confirm',
//                ['body' => json_encode($dataConfirm, true)]
//            );

            dd(json_decode($response->getBody()));


        return view('page.app.facebook.user.buff-like');
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
