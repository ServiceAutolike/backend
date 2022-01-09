<?php

namespace App\Http\Controllers;

use App\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
