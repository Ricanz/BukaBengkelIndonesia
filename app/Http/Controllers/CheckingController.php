<?php

namespace App\Http\Controllers;

use App\Models\Checking;
use App\Models\StandartChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CheckingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sadmin.checking.index');
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
            'wo' => 'required',
            'nopol' => 'required',
            'type' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $checking = Checking::create([
            'user_id' => 1,
            'employee_id' => 1,
            'client_id' => 1,
            'wo' => $request->wo,
            'plat_number' => $request->nopol,
            'type_id' => $request->type,
            'status' => 'active'
        ]);
        if ($checking) {
            StandartChecking::create([
                'checking_id' => $checking->id, 
                'km' => $request->km, 
                'high' => $request->high, 
                'low' => $request->low, 
                'suhu' => $request->suhu, 
                'saran' => $request->saran, 
                'status' => 'active'
            ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checking = Checking::findOrFail($id);
        $checking->status = 'deleted';
        $checking->save();
        return redirect()->back();
    }

    public function data()
    {
        $data = Checking::with('employee', 'client', 'type')->where('status', 'active');
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }
}
