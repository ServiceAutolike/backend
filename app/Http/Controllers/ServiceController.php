<?php

namespace App\Http\Controllers;

use App\RatePrice;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('page.auth..service.index');
    }
    public function indexAdmin(Request $request)
    {
        if ($request->type > 0) {
            $historyServices = RatePrice::where('type_services', $request->type)->where('services', 'like', "%".$request->keyword."%")->orderBy('id', 'DESC')->paginate(5);
        }else{
            $historyServices = RatePrice::where('services', 'like', "%".$request->keyword."%")->orderBy('id', 'DESC')->paginate(5);
        }
        foreach ($historyServices as $item){
            $item->class_type_services = config('common.class_service')[$item->type_services];
            $item->type_services = config('common.select_support')[$item->type_services];
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

    public function updateAdmin(Request $request)
    {
            $model = RatePrice::find($request->id);
            $model->price = $request->price;
            $model->save();
            return response()->json(true);
    }
}
