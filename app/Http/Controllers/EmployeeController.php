<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        return view('sadmin.employee.show', compact('employee'));

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
            'fullname' => 'required',
            'status' => 'required',
            'email' => 'required',
            'client_id' => 'required',
            'employee_id' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
        }

        $employee = Employee::findOrFail($request->employee_id);
        $employee->fullname = $request->fullname;
        $employee->image = $request->has('file') ? $img : $employee->image;
        $employee->is_kabeng = $request->is_kabeng === "true" ? true : false;
        $employee->status = $request->status;

        $user = User::findOrFail($employee->user_id);
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        if ($employee->save() && $user->save()) {
            return json_encode(['status'=> true, 'message'=> 'Success']);
        } else {
            return json_encode(['status'=> false, 'message'=> 'Something went wrong.']);
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
        //
    }
}
