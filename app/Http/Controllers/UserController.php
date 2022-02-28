<?php

namespace App\Http\Controllers;

use App\Recharge;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('page.auth.user.index');
    }

    public function data(Request $request)
    {
        $title = "Danh sách tài khoản";
        $historyServices = User::orderByDesc('id')->where($request->select, 'like', "%".$request->keyword."%")->where('role', 'user')->paginate(5);
        foreach ($historyServices as $items){
            $items->class_level = config('common.class_level')[$items->level];
            $items->level = config('common.level')[$items->level];
        }
        $response = [
            'pagination' => [
                'total' => $historyServices->total(),
                'per_page' => $historyServices->perPage(),
                'current_page' => $historyServices->currentPage(),
                'last_page' => $historyServices->lastPage(),
                'from' => $historyServices->firstItem(),
                'to' => $historyServices->lastItem()
            ],
            'data' => $historyServices,
            'title' => $title
        ];
        return response()->json($response);
    }

    public function change()
    {
        return view('page.auth.user.change');
    }

    public function dataChange($id)
    {
        $title = "Cập nhật tài khoản";
        $data = User::find($id);
        return response()->json(['data' => $data, 'title' => $title]);
    }

    public function updateData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [ 'required', Rule::unique('users')->ignore($request->id),],
        ]);
        if ($validator->fails()) {
            return response()->json(false);
        } else {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->image = $request->image;
            $user->point = $request->point;
            $user->level = $request->level;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $check = $user->save();
            return response()->json($check);
        }
    }

    public function addPrice(Request $request)
    {
        $user = User::find($request->id);
        $point = $user->point;
        $user->point = $point + $request->price;
        $user->save();
        return response()->json(true);
    }

    public function loginUser(Request $request){
        auth()->logout();
        Auth::loginUsingId($request->id);
        return response()->json(true);
    }

    public function recharge()
    {
        return view('page.auth.user.recharge');
    }

    public function dataRecharge(Request $request)
    {
        $fee = 0;
        if ($request->type == 'card'){
            $fee = 30;
        }
        $fee_money = ($request->amount/100)*$fee;
        $promotion = ($request->amount/100)*$request->discount;
        $amount_end = $request->amount - $fee_money + $promotion;
        $code = strtoupper(substr(md5(uniqid(mt_rand(), true)) , 0, 6));
        $type_mess = config('common.payment')[$request->type];
        $memo = "Nạp $amount_end đồng thành công từ cổng $type_mess";
        $model = new Recharge();
        $model->id_user = $request->id_user;
        $model->type = $request->type;
        $model->transaction_code = $code;
        $model->amount = $request->amount;
        $model->fee = $fee;
        $model->amount_end = $amount_end;
        $model->discount = $request->discount;
        $model->memo = $memo;
        $model->type_recharge = 'handword';
        $model->save();
        $user = User::find($request->id_user);
        $point = $user->point;
        $user->point = $point + $amount_end;
        $user->save();

        return response()->json(['status'=>$model->save(), 'message'=>$memo]);
    }
}
