<?php

namespace App\Http\Controllers;

use App\RatePrice;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function indexAdmin()
    {
        $data = RatePrice::all();
        foreach ($data as $item){
            $item->class_type_services = config('common.class_service')[$item->type_services];
            $item->type_services = config('common.select_support')[$item->type_services];
        }
        return view('page.auth.service.index', compact('data'));
    }

    public function updateAdmin(Request $request)
    {
        foreach ($request->service as $key => $item){
            $model = RatePrice::find($key);
            $model->price = $item;
            $model->save();
        }
        return redirect()->back();
    }
}
