<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sadmin.employee.index');
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
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cabang' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
        }

        $submit = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => strtolower($request->filter)
        ]);
        if ($submit) {
            $submit_employee = Employee::create([
                'fullname' => $request->name,
                'image' => $request->has('file') ? $img : Utils::emptyImage(),
                'user_id' => $submit->id,
                'client_id' => $request->cabang,
                'code' => $request->id,
                'status' => $request->status,
                'is_kabeng' => false
            ]);
            if ($submit_employee) {
                return json_encode(['status' => true, 'message' => 'Success']);
            } else {
                return json_encode(['status' => false, 'message' => 'Something went wrong.']);
            }
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
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }

        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
        }

        $employee = Employee::findOrFail($request->employee_id);
        $employee->fullname = $request->fullname;
        $employee->image = $request->has('file') ? $img : $employee->image;
        $employee->is_kabeng = $request->is_kabeng === "true" ? true : false;
        $employee->status = $request->status;
        $employee->code = $request->code;

        $user = User::findOrFail($employee->user_id);
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->role = $request->is_kabeng === "true" ? "client" : "employee";
        if ($employee->save() && $user->save()) {
            return json_encode(['status' => true, 'message' => 'Success']);
        } else {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
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
        $employee = Employee::findOrFail($id);
        $employee->status = 'deleted';

        $user = User::findOrFail($employee->user_id);
        $user->status = 'deleted';
        if ($employee->save() && $user->save()) {
            return redirect()->back();
        }
        return json_encode(['status' => false, 'message' => 'Gagal Hapus!']);
    }

    public function data(Request $request)
    {
        $user = Auth::user();
        $data = [];
        if ($request->filter) {
            if ($user->role === 'client') {

                $user_id = $user->id;
                switch ($request->filter) {
                    case 'client':
                        $data = Employee::with('client')
                            ->whereHas('client', function ($query) use ($user_id) {
                                $query->where('kabeng_id', $user_id);
                            })
                            ->where('is_kabeng', true)
                            ->where('status', '!=', 'deleted')
                            ->orderBy('fullname')
                            ->get();
                        break;
                    case 'employee':
                        $data = Employee::with('client')
                            ->whereHas('client', function ($query) use ($user_id) {
                                $query->where('kabeng_id', $user_id);
                            })
                            ->where('is_kabeng', false)
                            ->where('status', '!=', 'deleted')
                            ->orderBy('fullname')
                            ->get();
                        break;
                    default:
                        $data = [];
                        break;
                }
            } else {
                switch ($request->filter) {
                    case 'client':
                        $data = Employee::with('client')->where('is_kabeng', true)->where('status', '!=', 'deleted')->orderBy('fullname')->get();
                        break;
                    case 'employee':
                        $data = Employee::with('client')->where('is_kabeng', false)->where('status', '!=', 'deleted')->orderBy('fullname')->get();
                        break;
                    default:
                        $data = [];
                        break;
                }
            }
            return DataTables::of($data)->addIndexColumn()->make(true);
        } else {
            $data = User::where('role', 'admin')->orderBy('name');
            return DataTables::of($data->get())->addIndexColumn()->make(true);
        }
        return DataTables::of($data)->addIndexColumn()->make(true);
    }
}
