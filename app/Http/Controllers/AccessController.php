<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sadmin.access.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('sadmin.access.show', compact('employee'));
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
            'client_id' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }

        $employee = Employee::findOrFail($request->employee_id);
        $employee->client_id = $request->client_id;
        
        if ($employee->save()) {
            return json_encode(['status' => true, 'message' => 'Success']);
        }

    }

    public function data(Request $request)
    {
        $user = Auth::user();
        $data = [];
        if ($user->role === 'client') {
            $user_id = $user->id;
            $data = Employee::with('client')
                ->whereHas('client', function ($query) use ($user_id) {
                    $query->where('kabeng_id', $user_id);
                })
                ->where('is_kabeng', false)
                ->where('status', 'active')
                ->orderBy('fullname')
                ->get();
        }
        return DataTables::of($data)->addIndexColumn()->make(true);
    }
}
