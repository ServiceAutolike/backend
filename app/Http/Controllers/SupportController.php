<?php

namespace App\Http\Controllers;

use App\Models\SupportModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function indexUser($id)
    {
        $select_service = config('common.select_support');
        $data = SupportModel::where('id_user',$id )->orderByDesc('created_at')->get();
        foreach ($data as $items){
            $service = config('common.select_support');
            $items->service = $service[$items->service];
            $items->created_at->diffForHumans(Carbon::now());
        }
        return view('page.app.support.list',compact('data', 'select_service'));
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
        $model->code_chat = random_int(1000000000, 9999999999);
        $model->save();
        return redirect(route('support.create'));
    }

    public function getSupportID(Request $request)
    {
        return response()->json($request->iduser);
    }
}
