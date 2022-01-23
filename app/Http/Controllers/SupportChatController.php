<?php

namespace App\Http\Controllers;

use App\Models\SupportChatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportChatController extends Controller
{
    public function formChat()
    {
        return view('page.app.support.chat');
    }

    public function dataChat($code)
    {
        $data = DB::table('support')->where('code_chat', $code)->first();
        if ($data->status == 0){
            return response()->json(['message' => 'Hỗ trợ đang ở trạng thái Chờ hỗ trợ nên không thể mở hội thoại', 'status' => false]);
        }else {
            if(Auth::user()->id == $data->id_user || Auth::user()->role == "admin"){
                $data->user = DB::table('users')->where('id', $data->id_user)->first();
                $data->class_service = config('common.class_service')[$data->service];
                $data->service = config('common.select_support')[$data->service];
                $dataChat = DB::table('support_chat')->where('code_chat', $code)->get();
                $idActive = Auth::user()->id;
                foreach ($dataChat as $items) {
                    $items->user = DB::table('users')->where('id', $items->id_user)->first();
                }
                return response()->json(['status' => true, 'data' => $data, 'dataChat' => $dataChat, 'id_active' => $idActive]);
            }else{
                return response()->json(['message' => 'Bạn không có quyền truy cập hỗ trợ này!', 'status' => false]);
            }
        }
    }

    public function chat(Request $request)
    {
        $model = new SupportChatModel();
        $model->id_user = $request->id_user;
        $model->code_chat = $request->code_chat;
        $model->message = $request->message;
        $model->save();
        return redirect()->back();
    }
}
