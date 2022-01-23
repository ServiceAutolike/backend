<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('page.auth.posts.list');
    }

    public function getAll()
    {
        $historyServices = PostModel::orderBy('id', 'DESC')->paginate(2);

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

    public function formUpdate($id)
    {
        $data = PostModel::find($id);
        return view('page.auth.posts.update',compact('data'));
    }

    public function update(Request $request)
    {
        $data = PostModel::find($request->id);
        $data->content = $request->contents;
        if ($request->hasFile('image')){
            $newFileName = uniqid(). '-' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/uploads/post', $newFileName);
            $data->image = str_replace('public/', '', $path);
        }else{
            $data->image = "";
        }
        $data->save();
        return redirect(route('post.index'));
    }

    public function formCreate()
    {
        return view('page.auth.posts.create');
    }
    public function store(Request $request)
    {
        $model = new PostModel();
        $model->fill($request->all());
        if ($request->hasFile('image')){
            $newFileName = uniqid(). '-' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/uploads/post', $newFileName);
            $model->image = str_replace('public/', '', $path);
        }else{
            $model->image = "";
        }
        $model->save();
        return redirect(route('post.index'));
    }

    public function delete($id)
    {
        PostModel::destroy($id);
        return response()->json(true);
    }
}
