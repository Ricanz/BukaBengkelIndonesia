<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function list()
    {
        $data = Article::where('status', 'active')->orderByDesc('id')->get();
        return view('sadmin.articles.index', compact('data'));
    }

    public function detail($slug)
    {
        $data = Article::where('slug', $slug)->first();
        return view('sadmin.articles.show', compact('data'));
    }

    public function index()
    {
        return view('sadmin.articles.data');
    }

    public function data(Request $request)
    {
        $data = Article::where('status', '!=', 'deleted');
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }

    public function create()
    {
        return view('sadmin.articles.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        
        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 720);
        } else {
            $img = null;
        }

        $submit = Article::create([
            'image' => $request->has('file') ? env('APP_URL').$img : null,
            'title' => $request->title,
            'slug' => Utils::slugify($request->title).''.Utils::generateRandom(),
            'description' => $request->description,
            'short_description' => strip_tags(substr($request->description, 0, 255)),
            'status' => 'active',
        ]);

        if ($submit) {
            return json_encode(['status' => true, 'message' => 'Success']);
        } else {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
    }

    public function edit($id)
    {
        $data = Article::where('id', $id)->first();
        return view('sadmin.articles.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = Article::find($request->id);
        if (!$data) {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
        $img = null;
        if ($request->has('file')) {
            $img = $request->has('file') ? Utils::uploadImage($request->file, 720) : null;
        }

        $data->image = $request->has('file') ? $img : $data->image;
        $data->title = $request->title ? $request->title : $data->title;
        $data->slug = $request->title ? Utils::slugify($request->title).''.Utils::generateRandom() : $data->slug;
        $data->description = $request->description !== null ? $request->description : $data->description;
        $data->short_description = $request->description  !== null ? strip_tags(substr($request->description, 0, 255)) : $data->short_description;
        $data->status = $request->status ? $request->status : $data->status;
        if ($data->save()) {
            return json_encode(['status' => true, 'message' => 'Success']);
        }
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 'deleted';
    
        if ($article->save()) {
            return redirect()->back();
        }
        return json_encode(['status' => false, 'message' => 'Gagal Hapus!']);
    }
}
