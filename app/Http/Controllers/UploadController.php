<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        return response()->json('/images/'.$imageName);
    }
}
