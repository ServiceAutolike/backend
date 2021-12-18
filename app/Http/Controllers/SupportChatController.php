<?php

namespace App\Http\Controllers;

use App\Models\SupportChatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportChatController extends Controller
{
    public function formChat($id)
    {
        $data = DB::table('support')->where('code_chat', $id)->first();
        $dataChat = DB::table('support_chat')->where('code_chat', $id)->get();
        foreach ($dataChat as $items){
            $items->user = DB::table('users')->where('id', $items->id_user)->first();
        }
        return view('page.app.support.chat',compact('data','dataChat'));
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