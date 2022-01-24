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
    public function indexUser(Request $request)
    {
        $code = Auth::user()->code;
        $id = Auth::user()->id;
        $select_service = config('common.select_support');
        $count_status1 = count(SupportModel::where('status', 0)->where('code_user',$code )->get());
        $count_status2 = count(SupportModel::where('status', 1)->where('code_user',$code )->get());
        $count_status3 = count(SupportModel::where('status', 2)->where('code_user',$code )->get());
        $data = SupportModel::where('code_user',$code )->orderByDesc('created_at')->paginate(5);
        foreach ($data as $items){
            $items->class_service = config('common.class_service')[$items->service];
            $items->class_icon_service = config('common.class_icon_service')[$items->service];
            $items->class_status = config('common.class_status')[$items->status];
            $items->service = config('common.select_support')[$items->service];
            $items->status = config('common.status_support')[$items->status];
            $items->count_chat = count(SupportChatModel::where("code_chat", $items->code_chat)->get());
        }
        return response()->json([
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem()
            ],
            'data' => $data,
            'status1' => $count_status1,
            'status2' => $count_status2,
            'status3' => $count_status3,
            'idUser' => $id,
            'codeUser' => $code,
        ]);
    }

    public function viewUser()
    {
        return view('page.app.support.list');
    }

    public function setStatus(Request $request)
    {
        $model = SupportModel::find($request->id);
        $model->status = $request->status;
        $model->save();
        return response()->json(true);
    }

    public function getData(Request $request)
    {
        $keyword = $request->keyword;
        if ($request->type > 0) {
            $historyServices = SupportModel::where('service', $request->type)
                ->where('code_chat', 'like', "%".$request->keyword."%")
                ->orderByDesc('created_at')->paginate(5);
        }else{
            $historyServices = SupportModel::where('code_chat', 'like', "%".$request->keyword."%")->orderByDesc('created_at')->paginate(5);
        }
        foreach ($historyServices as $items){
            $items->class_service = config('common.class_service')[$items->service];
            $items->class_icon_service = config('common.class_icon_service')[$items->service];
            $items->class_status = config('common.class_status')[$items->status];
            $items->service = config('common.select_support')[$items->service];
            $items->status = config('common.status_support')[$items->status];
            $items->count_chat = count(SupportChatModel::where("code_chat", $items->code_chat)->get());
            $items->user = DB::table('users')->where('id', $items->id_user)->first();
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
            'data' => $historyServices
        ];
        return response()->json($response);
    }

    public function indexAdmin()
    {
        return view('page.auth.support.list');
    }

    public function updateAdmin(Request $request){
        $model = SupportModel::find($request->id);
        $model->status = $request->status;
        $model->save();
        return response()->json(true);
    }

    public function storeUser(Request $request)
    {
        $model = new SupportModel();
        $model->fill($request->all());
        if ($request->image){
            $model->image = $request->image;
        }
        $model->code_chat = substr(md5(uniqid(mt_rand(), true)) , 0, 20);
        $model->save();
        return response()->json(true);
    }
}
