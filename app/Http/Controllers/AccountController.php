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

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|alpha|max:20|min:6',
                'email' => [
                    "required",
                    "email",
                    "unique:users",
                    function($attribute, $value, $fail){
                        if (!strpos($value, "@gmail.com")){
                            $fail("$attribute Không đúng định dạng");
                        }
                    }
                ],
                'password' => "required|min:6",
                'phone' => "required|regex:/(0)[3,6,8,9,5]/|not_regex:/[a-z]/|min:10|max:10|unique:users",
            ],
            [
                'name.required' => "Không để trống trường này",
                'name.alpha' => "User name không được chứa kí tự đặc biệt",
                'name.max' => "User name không được vượt quá 20 kí tự",
                'name.min' => "User name phải ít nhất 6 kí tự",
                'email.required' => "Không để trống trường này",
                'email.unique' => "Email đã tồn tại",
                'email.email' => "Email không đúng định dạng",
                'password.required' => "Không để trống trường này",
                'phone.required' => "Không để trống trường này",
                'phone.regex' => "Số điện thoại Không hợp lệ",
                'phone.min' => "Số điện thoại Không hợp lệ",
                'phone.max' => "Số điện thoại Không hợp lệ",
                'phone.unique' => "Số điện thoại đã tồn tại",

            ]

        );
        $model = new User();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->password = Hash::make($request->password);
        $model->code = substr(md5(uniqid(mt_rand(), true)) , 0, 25);
        $model->image = "uploads/default-avatar.png";
        $model->save();
        return redirect()->route('account.login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('account.login'));
    }
}
