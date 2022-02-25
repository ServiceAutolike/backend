<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function formLogin()
    {
        if (!Auth::check()) {
            return view('account.page.signin');
        }else{
            return redirect()->back();
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => "Đăng nhập thất bại"]);
        } else {
            if (!Auth::check()){
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    return response()->json(["status" => true]);
                }else {
                    return response()->json(["status" => false, "message" => "Tài khoản hoặc mật khẩu không chính xác. Vui lòng thử lại!"]);
                }
            }else{
                return redirect()->back();
            }
        }

    }

    public function formRegister()
    {
        if (!Auth::check()) {
            return view('account.page.signup');
        }else{
            return redirect()->back();
        }
    }
    public function registerUserName(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(false);
        } else{
            return response()->json(true);
        }
    }
    public function registerEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(false);
        } else{
            return response()->json(true);
        }
    }
    public function registerPhone(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(false);
        } else{
            return response()->json(true);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(false);
        } else {
            $model = new User();
            $model->name = $request->name;
            $model->email = $request->email;
            $model->phone = $request->phone;
            $model->password = Hash::make($request->password);
            $model->code = substr(md5(uniqid(mt_rand(), true)) , 0, 25);
            $model->image = "avatar/img_avatar.png";
            $model->save();
            return response()->json(true);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('account.login'));
    }
}
