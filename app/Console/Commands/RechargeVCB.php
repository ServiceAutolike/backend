<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
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
            'begin' => $date,
            'end' => $date,
            'username' => '0974137996',
            'password' => 'Khanhduy3110@123',
            'accountNumber' => '0491000095630',
        ];
        $header = [
            'Content-Type' => 'application/json',
        ];
        $getHistory = Http::withHeaders($header)->post('http://vietcombank.duycms.com:9898/api/vcb/transactions', $data);
        $timthay = 0;
        for($i = 0; $i < count($getHistory['transactions']); $i++) {
            $str = $getHistory['transactions'][$i]['Description'];
            $pos = strpos($str, 'nap');
            $pos2 = strpos($str, 'Nap');
            if($pos > 0 || $pos2 > 0) {
                $timthay += 1;
                $desc =  $getHistory['transactions'][1]['Description'];
                echo $desc;
            }


        }

    }
}
