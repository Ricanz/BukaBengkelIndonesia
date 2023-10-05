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
            'file' => 'required',
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
        }

        $submit = MasterChecking::create([
            'icon' => $request->has('file') ? env('APP_URL').$img : null,
            'name' => $request->name,
            'description' => $request->name,
            'status' => 'active',
            'type' => 'standart',
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
        $data->name = $request->name ? $request->name : $data->name;
        $data->description = $request->name ? $request->name : $data->name;
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
        $data = MasterChecking::where('status', '!=', 'deleted')->where('type', 'standart');
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }
}
