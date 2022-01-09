<?php

namespace App\Http\Controllers;

use App\Recharge;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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

    public function checkRechargeVCB() {
        $date = date('d/m/Y', time());
        $data = [
            'begin' => '08/01/2022',
            'end' => '10/01/2022',
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
                            $recharge->memo = "Vietcombank Recharge";
                            $recharge->status = "New";
                            $recharge->transaction_code = $transaction_code;
                            $recharge->save();
                            $data = [
                                'status' => 'success',
                                'amount' => $formatAmount,
                                'type' => 'vcb'
                            ];
                        }
                        catch (\Exception $e) {
                            \Log::info($e);
                            DB::rollBack();
                            $data = [
                                'status' => 'error',
                            ];
                        }
                        DB::commit();
                        return \response()->json($data);
                    } else {
                        $data = [
                            'status' => 'error',
                            'message' => 'ID nạp đã có rồi'
                        ];
                    }
                }
                else {
                    $data = [
                        'status' => 'error',
                        'message' => 'Không tìm thấy ID'
                    ];
                }
            }
        }
        return \response()->json($data);
    }

}
