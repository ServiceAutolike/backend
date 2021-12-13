<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
