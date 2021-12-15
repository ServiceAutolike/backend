<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('page.auth.user.index', compact('data'));
    }

    public function recharge(Request $request)
    {
        $user = User::find($request->id_user);
        $point = $user->point;
        $user->point = $point + $request->point;
        $user->save();
        return redirect()->back();
    }


}
