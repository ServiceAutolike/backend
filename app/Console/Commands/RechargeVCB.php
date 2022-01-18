<?php

namespace App\Console\Commands;

use App\RatePrice;
use App\Recharge;
use App\Services;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RechargeVCB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:vcb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
        $arr = array();
        $co = 0;
        for($i = 0; $i < count($getHistory['transactions']); $i++) {
            $str = strtolower($getHistory['transactions'][$i]['Description']);
            $searchword = 'nap';
            if(preg_match("/\b$searchword\b/i", $str)) {
                $timthay += 1;
                $matches[$i] = $str;
                $pattern = '/(nap) (.+)/';
                preg_match($pattern, $str, $matchess);
                if(strpos($matchess[2], 'ct') > 0) {
                    $abc = strtok($matchess[2], '.');
                    $username = $abc;
                }
                else {
                    $username =  $matchess[2];
                }
                $transaction_code = $getHistory['transactions'][$i]['PCTime'];
                $amount = $getHistory['transactions'][$i]['Amount'];
                $formatAmount = intval(preg_replace("/[^-0-9\.]/","",$amount));
                $getIDUser = User::where('name', $username)->value('id');
                if($getIDUser) {
                    $check = Recharge::where('transaction_code', $transaction_code)->where('id_user',$getIDUser)->get();

                    if($check->count() < 1) {
                        $getBalance = User::where('id',$getIDUser)->value('point');
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
                        }
                        catch (\Exception $e) {
                            \Log::info($e);
                            DB::rollBack();
                            dd($e);
                        }
                        DB::commit();
                    }
                    else {
                        echo "Có data rồi không thêm nữa\n";
                    }
                }
                else {
                    echo "Không Tìm thấy ID\n";
                }
            }

        }


//        foreach($matches as $item) {
//            $demo = explode('nap ', $item)[1];
//            $abc = strtok($demo, '.');
//            print_r($abc);
//        }






//        }

    }
}
