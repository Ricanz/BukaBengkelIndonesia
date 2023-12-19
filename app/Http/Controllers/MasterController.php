<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\MasterChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sadmin.master.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // 'file' => 'required',
            'label_judul' => 'required',
            'label_foto' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        
        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
        }

        $submit = MasterChecking::create([
            'icon' => $request->has('file') ? env('APP_URL').$img : null,
            'name' => $request->label_judul,
            'description' => $request->label_foto,
            'label_desc' => $request->label_description,
            'status' => 'active',
            'slug' => Utils::slugify($request->label_judul),
            'type' => $request->type,
        ]);

        if ($submit) {
            return json_encode(['status' => true, 'message' => 'Success']);
        } else {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MasterChecking::findOrFail($id);
        return view('sadmin.master.show', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = MasterChecking::find($request->id);
        if (!$data) {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
        $img = null;
        if ($request->has('file')) {
            $img = $request->has('file') ? Utils::uploadImage($request->file, 300) : null;
        }

        $data->icon = $request->has('file') ? $img : $data->icon;
        $data->name = $request->label_judul ? $request->label_judul : $data->label_judul;
        $data->slug = $request->label_judul ? Utils::slugify($request->label_judul) : $data->label_judul;
        $data->description = $request->label_foto ? $request->label_foto : $data->label_foto;
        $data->label_desc = $request->label_description ? $request->label_description : $data->label_description;
        $data->status = $request->status ? $request->status : $data->status;
        if ($data->save()) {
            return json_encode(['status' => true, 'message' => 'Success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $master = MasterChecking::findOrFail($id);
        $master->status = 'deleted';
    
        if ($master->save()) {
            return redirect()->back();
        }
        return json_encode(['status' => false, 'message' => 'Gagal Hapus!']);
    }

    public function data(Request $request)
    {
        $data = MasterChecking::where('status', '!=', 'deleted')->where('type', $request->filter);
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }
}
