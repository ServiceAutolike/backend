<?php

namespace App\Http\Controllers;

use App\Models\SupportChatModel;
use App\Models\SupportModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    public function indexUser($id)
    {
        $select_service = config('common.select_support');
        $count_status1 = count(SupportModel::where('status', 0)->where('code_user',$id )->get());
        $count_status2 = count(SupportModel::where('status', 1)->where('code_user',$id )->get());
        $count_status3 = count(SupportModel::where('status', 2)->where('code_user',$id )->get());
        $data = SupportModel::where('code_user',$id )->orderByDesc('created_at')->get();
        foreach ($data as $items){
            $items->class_service = config('common.class_service')[$items->service];
            $items->class_icon_service = config('common.class_icon_service')[$items->service];
            $items->class_status = config('common.class_status')[$items->status];
            $items->service = config('common.select_support')[$items->service];
            $items->status = config('common.status_support')[$items->status];
            $items->count_chat = count(SupportChatModel::where("code_chat", $items->code_chat)->get());

        }
        return view('page.app.support.list',compact('data', 'select_service','count_status1', 'count_status2', 'count_status3'));
    }

    public function indexAdmin()
    {
        $data = SupportModel::orderByDesc('created_at')->get();
        foreach ($data as $items){
            $items->class_service = config('common.class_service')[$items->service];
            $items->class_icon_service = config('common.class_icon_service')[$items->service];
            $items->class_status = config('common.class_status')[$items->status];
            $items->service = config('common.select_support')[$items->service];
            $items->status = config('common.status_support')[$items->status];
            $items->count_chat = count(SupportChatModel::where("code_chat", $items->code_chat)->get());
            $items->user = DB::table('users')->where('id', $items->id_user)->first();
        }
        return view('page.auth.support.list',compact('data'));
    }

    public function formCreate()
    {
        $select_service = config('common.select_support');
        return view('page.app.support.create', compact('select_service'));
    }

    public function storeUser(Request $request)
    {
        $model = new SupportModel();
        $model->fill($request->all());
        if ($request->hasFile('image')){
            $newFileName = uniqid(). '-' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/uploads/support', $newFileName);
            $model->image = str_replace('public/', '', $path);
        }
        $model->code_chat = substr(md5(uniqid(mt_rand(), true)) , 0, 20);
        $model->save();
        return redirect(route('support.create'));
    }

    public function getSupportID(Request $request)
    {
        return response()->json($request->iduser);
    }
}
