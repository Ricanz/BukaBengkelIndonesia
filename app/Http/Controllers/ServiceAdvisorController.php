<?php

namespace App\Http\Controllers;

use App\Models\ServiceAdvisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServiceAdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sadmin.advisor.index');
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
            'name' => 'required',
            'cabang' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $submit = ServiceAdvisor::create([
            'client_id' => $request->cabang,
            'name' => $request->name,
            'status' => 'active'
        ]);

        if ($submit) {
            return json_encode(['status'=> true, 'message'=> 'Success']);
        } else {
            return json_encode(['status'=> false, 'message'=> 'Something went wrong.']);
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
        $advisor = ServiceAdvisor::with('client')->findOrFail($id);
        return view('sadmin.advisor.show', compact('advisor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'cabang' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $advisor = ServiceAdvisor::findOrFail($request->id);
        $advisor->name = $request->name ? $request->name : $advisor->name;
        $advisor->client_id = $request->cabang ? $request->cabang : $advisor->client_id;
        $advisor->status = $request->status ? $request->status : $advisor->status;
        if ($advisor->save()) {
            return json_encode(['status'=> true, 'message'=> 'Success']);
        }
        return json_encode(['status'=> false, 'message'=> 'Something went wrong.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advisor = ServiceAdvisor::findOrFail($id);
        $advisor->status = 'deleted';
        if ($advisor->save()) {
            return redirect()->back();
        }
    }

    public function data()
    {
        $user = Auth::user();
        if ($user->role === 'client') {
            $user_id = $user->id;
            $data = ServiceAdvisor::with('client')->whereHas('client', function ($query) use ($user_id) {
                $query->where('kabeng_id', $user_id)->orderBy('name', 'asc');
            })->where('status', 'active');
            
        } else if ($user->role === 'admin'){
            $data = ServiceAdvisor::with('client')->where('status', 'active')->orderBy('name', 'asc');
        }

        return DataTables::of($data->orderByDesc('created_at')->get())->addIndexColumn()->make(true);
    }
}
