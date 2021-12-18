<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data = PostModel::all();
        return view('page.auth.posts.list', compact('data'));
    }

    public function formUpdate()
    {
        return view('page.auth.posts.update');
    }

    public function update($id)
    {

    }

    public function store(Request $request)
    {
        $model = new PostModel();
        $model->fill($request->all());
        if ($request->hasFile('image')){
            $newFileName = uniqid(). '-' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/uploads/post', $newFileName);
            $model->image = str_replace('public/', '', $path);
        }
        $model->save();
        return redirect(route('post.index'));
    }

    public function delete($id)
    {
        PostModel::destroy($id);
        return redirect(route('post.list'));
    }
}
