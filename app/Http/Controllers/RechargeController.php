<?php

namespace App\Http\Controllers;

use App\Momo;
use App\Recharge;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Config;
class RechargeController extends Controller
{
    public function rechargeBank() {
        return view('page.app.recharge.bank');
    }

    public function rechargeMomo() {
        return view('page.app.recharge.momo');
    }

    public function rechargeCard() {
        return view('page.app.recharge.card');
    }

    public function history() {
        return view('page.app.recharge.history');
    }

    // get History with Type

    public function getHistorywithtype(Request $request) {
        $history = Recharge::where('id_user',Auth::user()->id)->where('type', $request->params['type'])->orderBy('id', 'DESC')->limit(5)->get();
        return $history;
    }

    /// Get All history recharge
    public function getHistory() {
        $history = Recharge::where('id_user',Auth::user()->id)->orderBy('id', 'DESC')->paginate(2);
        $response = [
            'pagination' => [
                'total' => $history->total(),
                'per_page' => $history->perPage(),
                'current_page' => $history->currentPage(),
                'last_page' => $history->lastPage(),
                'from' => $history->firstItem(),
                'to' => $history->lastItem()
            ],
            'data' => $history
        ];
        return response(['fetchDataHistory' => $response]);
    }


    /// Check Transaction Vietconbank
    public function checkRechargeVCB() {
        $date = date('d/m/Y', time());
        $data = [
            'begin' => '06/01/2022',
            'end' => '13/01/2022',
            'username' => '0974137996',
            'password' => 'Khanhduy3110@123',
            'accountNumber' => '0491000095630',
        ];
        $header = [
            'Content-Type' => 'application/json',
        ];

        $getHistory = Http::withHeaders($header)->post('http://vietcombank.duycms.com:9898/api/vcb/transactions', $data);
        $timthay = 0;
        $matches = array();
        $data = [];
        for($i = 0; $i < count($getHistory['transactions']); $i++) {
            $str = strtolower($getHistory['transactions'][$i]['Description']);
            $searchword = 'nap';
            if (preg_match("/\b$searchword\b/i", $str)) {
                $timthay += 1;
                $matches[$i] = $str;
                $pattern = '/(nap) (.+)/';
                preg_match($pattern, $str, $matchess);
                if (strpos($matchess[2], 'ct') > 0) {
                    $abc = strtok($matchess[2], '.');
                    $username = $abc;
                } else {
                    $username = $matchess[2];
                }
                $transaction_code = $getHistory['transactions'][$i]['PCTime'];
                $amount = $getHistory['transactions'][$i]['Amount'];
                $formatAmount = intval(preg_replace("/[^-0-9\.]/", "", $amount));
                $getIDUser = User::where('name', $username)->value('id');
                if ($getIDUser) {
                    $check = Recharge::where('transaction_code', $transaction_code)->where('id_user', $getIDUser)->get();
                    if ($check->count() < 1) {
                        $getBalance = User::where('id', $getIDUser)->value('point');
                        $add = $getBalance + $formatAmount;
                        DB::beginTransaction();
                        try {
                            $user = User::find($getIDUser);
                            $user->point = $add;
                            $user->save();
                            $recharge = new Recharge();
                            $recharge->id_user = $getIDUser;
                            $recharge->type = 'vcb';
                            $recharge->amount = $formatAmount;
                            $recharge->fee = 0;
                            $recharge->amount_end = $formatAmount;
                            $recharge->discount = 0;
                            $recharge->memo = "Bạn nạp thành công ".$formatAmount. " qua cổng thanh toán Vietcombank";
                            $recharge->status = "New";
                            $recharge->transaction_code = $transaction_code;
                            $recharge->save();
                        }
                        catch (\Exception $e) {
                            \Log::info($e);
                            DB::rollBack();
                            $err = [
                                'status' => 'error',
                            ];
                        }
                        DB::commit();
                    } else {
                        $err = [
                            'status' => 'error',
                            'message' => 'ID nạp đã có rồi'
                        ];
                    }
                }
                else {
                    $err = [
                        'status' => 'error',
                        'message' => 'Không tìm thấy ID'
                    ];
                }
            }
        }
        $total_recharge_new = Recharge::where('id_user',Auth::user()->id)->where('type', 'vcb')->where('status', 'New')->sum('amount_end');
        if($total_recharge_new > 0) {
            $data = [
                'status' => 'success',
                'type' => 'vcb',
                'total' => $total_recharge_new
            ];
            return \response()->json($data);
        }
        else {
            return \response()->json($err);
        }

    }


    /// MOMO  Get Transaction
    public function getTransactionMomo() {
        $Momo = new Momo();
        $lg = json_decode($Momo->userLogin('Ui53aWWcfh5wJ2GCXrjmohuf0YuoCbLN68sw43ZrU5RidanXK2JiAKeY+JqBWPoW'),true);
        $auth_token = $lg['AUTH_TOKEN'];
        $phone = Config::get('api.momo.phone');
        $token = Config::get('api.momo.auth_momo');
        $header = [
            'Host: m.mservice.io',
            'Accept: application/json',
            'Authorization: Bearer ' . $auth_token . '',
            'agent_id: 35062822',
            'app_version: 30262',
            'sessionkey: deff1ec6-fa5b-4cae-8c32-5bbc260e573f',
            'user_phone: '.$phone.'',
            'app_code: 3.0.26',
            'Accept-Language: vi-vn',
            'Content-Type: application/json',
            'device_os: IOS',
            'lang: vi',
            'User-Agent: MoMoPlatform-Release/30262 CFNetwork/1240.0.4 Darwin/20.5.0'
        ];
        $dataPost = '{"userId":"'.$phone.'","fromTime":' . ((time() - (60 * 60 * 72)) * 1000) . ',"toTime":' . ((time()) * 1000) . ',"limit":100,"cursor":""}';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => Config::get('api.momo.url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $dataPost,
            CURLOPT_HTTPHEADER => $header
        ));
        $momoTrans = json_decode(curl_exec($curl), true);
        $result = [];
        if (isset($momoTrans['message']['data']['notifications'])) {
            if (count($momoTrans['message']['data']['notifications'])) {
                foreach ($momoTrans['message']['data']['notifications'] as $momo) {
                    if ($momo['type'] == 90 || $momo['type'] == 77 || $momo['type'] == 43) {
                        $result['data'][] = $momo;
                    }
                }
            }
        }
        $data = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return json_decode($data, true);
    }


    //update Status Momo Recharge

    public function updateStatusMomo(Request $request) {
        $code = 200;
        $getAllRechargeNew = Recharge::where('id_user',Auth::user()->id)->where('type', $request->params['type'])->where('status', 'New')->get();
        foreach ($getAllRechargeNew as $item) {
            try {
                Recharge::where('id',$item->id)->update(array(
                    'status'=>'Updated',
                ));
                $code = 200;
            }
           catch (\Exception $e) {
               $code = 400;
            }
        }
        return response()->json(['code' => $code]);

    }


    /// check Transaction MOMO
    public function checkTransactionMomo() {
        $dataTransaction = $this->getTransactionMomo();
        if(count($dataTransaction['data'])) {
            for($i = 0; $i < count($dataTransaction['data']); $i++) {
                $data_json = json_decode($dataTransaction['data'][$i]['extra'], true);
                $str = strtolower($data_json['comment']);
                $searchword = 'nap';
                if (preg_match("/\b$searchword\b/i", $str)) {
                    $matches[$i] = $str;
                    $pattern = '/(nap) (.+)/';
                    preg_match($pattern, $str, $matchess);
                    $getIDUser= User::where('name', $matchess[2])->value('id');
                    if($getIDUser != null) {
                        $check = Recharge::where('transaction_code', $data_json['tranId'])->where('id_user', $getIDUser)->get();
                        if ($check->count() < 1) {
                            $getBalance = User::where('id', $getIDUser)->value('point');
                            $add = $getBalance + $data_json['amount'];
                            try {
                                DB::beginTransaction();
                                $user = User::find($getIDUser);
                                $user->point = $add;
                                $user->save();

                                $recharge = new Recharge();
                                $recharge->id_user = $getIDUser;
                                $recharge->type = 'momo';
                                $recharge->amount = $data_json['amount'];
                                $recharge->fee = 0;
                                $recharge->amount_end = $data_json['amount'];
                                $recharge->discount = 0;
                                $recharge->memo = "Bạn nạp thành công ".$data_json['amount']." qua cổng thanh toán Momo";
                                $recharge->status = "New";
                                $recharge->transaction_code = (string) $data_json['tranId'];
                                $recharge->save();

                            }
                            catch (\Exception $e) {
                                \Log::info($e);
                                DB::rollBack();

                            }
                            DB::commit();
                        }

                        else {
                            $error = [
                                'code' => 400,
                            ];
                        }

                    }
                    else {
                        $error = [
                            'code' => 400,
                        ];

                    }
                }
                else {
                    $error = [
                        'code' => 400,
                    ];
                }
            }
        }
        else {
            $error = [
                'code' => 400,
            ];

        }
        $total_recharge_new = Recharge::where('id_user',Auth::user()->id)->where('type', 'momo')->where('status', 'New')->sum('amount_end');
        if($total_recharge_new > 0) {
            $data = [
                'code' => 200,
                'type' => 'vcb',
                'total' => $total_recharge_new
            ];
            return \response()->json($data);
        }
        else {
            return \response()->json($error);
        }

    }



}
