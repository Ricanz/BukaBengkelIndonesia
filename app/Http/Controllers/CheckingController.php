<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Checking;
use App\Models\CheckingImage;
use App\Models\Employee;
use App\Models\StandartChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('sadmin.checking.create');
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
            'advisor' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $employee_id = 1;
        $client_id = 1;

        $user = Auth::user();
        if ($user->role === 'employee') {
            $employee = Employee::where('user_id', $user->id)->first();
            $employee_id = $employee->id;
            $client_id = $employee->client_id;
        }
        $checking = Checking::create([
            'user_id' => $user->id,
            'employee_id' => $employee_id,
            'client_id' => $client_id,
            'sa_id' => $request->advisor,
            'wo' => $request->wo,
            'plat_number' => $request->nopol,
            'type_id' => $request->type,
            'status' => 'active',
            'checking_type' => 'Standart'
        ]);
        if ($checking) {
            StandartChecking::create([
                'checking_id' => $checking->id, 
                'km' => $request->km, 
                'high' => $request->high, 
                'low' => $request->low, 
                'suhu' => $request->suhu, 
                'wind' => $request->wind, 
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
        $checking = Checking::with('employee', 'client', 'types', 'standart', 'advisor')->findOrFail($id);
        return view('sadmin.checking.show', compact('checking'));
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
        $checking = Checking::findOrFail($request->checking_id);
        $detail = StandartChecking::where('checking_id', $checking->id)->first();

        $checking->wo = $request->wo;
        $checking->plat_number = $request->nopol;
        $checking->sa_id = $request->advisor;

        $detail->km = $request->km;
        $detail->high = $request->km;
        $detail->low = $request->low;
        $detail->suhu = $request->suhu;
        $detail->wind = $request->wind;
        $detail->saran = $request->saran;

        if ($checking->save() && $detail->save()) {
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
        $checking = Checking::findOrFail($id);
        $checking->status = 'deleted';
        $checking->save();
        return redirect()->back();
    }

    public function data()
    {
        $user = Auth::user();
        if ($user->role === 'client') {
            $user_id = $user->id;
            $data = Checking::with('employee', 'client', 'types', 'advisor')->whereHas('client', function ($query) use ($user_id) {
                $query->where('kabeng_id', $user_id);
            })->where('status', 'active');
            
        } else if ($user->role === 'employee'){
            $data = Checking::with('employee', 'client', 'types', 'advisor')->where('user_id', $user->id)->where('status', 'active');
        } else {
            $data = Checking::with('employee', 'client', 'types', 'advisor')->where('status', 'active');
        }
        return DataTables::of($data->orderByDesc('created_at')->get())->addIndexColumn()->make(true);
    }

    public function image(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'file' => 'required',
            'description' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $submit = CheckingImage::create([
            'image' => Utils::uploadImage($request->file, 300),
            'checking_id' => $request->checking_id,
            'desc_id' => $request->description,
            'type' => 'pre'
        ]);
        if ($submit) {
            return json_encode(['status'=> true, 'message'=> 'Success']);
        } else {
            return json_encode(['status'=> false, 'message'=> 'Something went wrong.']);
        }
    }

    public function image_data(Request $request)
    {
        $data = CheckingImage::with('type')->where('checking_id', $request->id)->where('status', '!=', 'deleted');
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }

    public function image_update(Request $request)
    {
        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
            $image = CheckingImage::findOrFail($request->id);
            $image->image = $img;
            if ($image->save()) {
                return json_encode(['status'=> true, 'message'=> 'Success']);
            } else {
                return json_encode(['status'=> false, 'message'=> 'Something went wrong.']);
            }
        }
    }

    public function image_destroy($id)
    {
        $image = CheckingImage::findOrFail($id);
        $image->status = 'deleted';
        $image->save();
        return redirect()->back();
    }
}
