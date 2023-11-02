<?php

namespace App\Http\Controllers;

use App\Exports\BengkelExport;
use App\Helpers\Utils;
use App\Models\Client;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;



class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sadmin.clients.index');
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
            'file' => 'required',
            'city' => 'required',
            'address' => 'required',
            'id' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $img = Utils::uploadImage($request->file, 300);
        
        if ($request->kabeng) {
            $usr = User::where('email', strtolower($request->kabeng))->first();
            if (!$usr) {
                $email = Utils::generateEmail($request->kabeng);
                $user = User::create([
                    'name' => $request->kabeng,
                    'email' => $email,
                    'password' => Hash::make('pass.123'),
                    'role' => 'client'
                ]);
            } else {
                $user = $usr;
                $employee = Employee::where('is_kabeng', true)->where('user_id', $usr->id)->first();
                $total = Client::where('kabeng_id', $user->id)->count();
                // dd($total === $employee->quota);
                if (floatval($user->quota) === floatval($total)) {
                    return json_encode(['status'=> false, 'message'=> ['Kuota Bengkel Habis']]);
                }
            }

            $submit = Client::create([
                'title' => $request->name,
                'description' => $request->description,
                'code' => $request->id,
                'image' => $img,
                'address' => $request->address,
                'city' => $request->city,
                'status' => 'active',
                'kabeng_id' => $user->id
            ]);
            if (!$user) {
                Employee::create([
                    'user_id' => $user->id,
                    'client_id' => $submit->id,
                    'fullname' => $request->kabeng, 
                    'is_kabeng' => true,
                    'quota' => $request->kuota
                ]);
            }
            if ($submit) {
                return json_encode(['status'=> true, 'message'=> 'Success']);
            }
        } else {
            $submit = Client::create([
                'title' => $request->name,
                'description' => $request->description,
                'code' => $request->id,
                'image' => $img,
                'address' => $request->address,
                'city' => $request->city,
                'status' => 'active',
                'kabeng_id' => Auth::user()->id
            ]);
            if ($submit) {
                return json_encode(['status'=> true, 'message'=> 'Success']);
            }
        }
        return json_encode(['status'=> false, 'message'=> ['Something went wrong.']]);
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
        $client = Client::with('kabeng')->findOrFail($id);
        $count = Client::where('kabeng_id', $client->kabeng_id)->where('status', 'active')->count();
        $quota = Employee::where('user_id', $client->kabeng_id)->pluck('quota')->first();
        $expired_at = Carbon::parse($client->expired_at)->format('d M Y');
        return view('sadmin.clients.edit', compact('client', 'count', 'quota', 'expired_at'));
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
            'city' => 'required',
            'address' => 'required',
            'id' => 'required',
            'client_id' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
        }

        $client = Client::findOrFail($request->client_id);

        if (isset($request->quota)) {
            $kabeng = Employee::where('user_id', $client->kabeng_id)->where('is_kabeng', true)->first();
            
            $kabeng->quota = $request->quota;
            $kabeng->save();
        }

        if (isset($request->expired_at)) {
            Client::where('kabeng_id', $client->kabeng_id)->update([
                'expired_at' => $request->expired_at
            ]);
        }

        $client->title = $request->name;
        $client->code = $request->id;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->status = $request->status;
        $client->image = $request->has('file') ? $img : $client->image;
        $client->description = $request->description ? $request->description : $client->description;
        if ($client->save()) {
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
        $client = Client::findOrFail($id);
        $client->status = 'deleted';
        $client->save();
        return redirect()->back();
    }

    public function data()
    {
        $user = Auth::user();
        if ($user->role === 'client') {
            $data = Client::where('status', '!=', 'deleted')->where('kabeng_id', $user->id)->orderBy('title');
        } else {
            $data = Client::where('status', '!=', 'deleted')->orderBy('title');
        }
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }

    public function employee($id)
    {
        $client = Client::findOrFail($id);
        return view('sadmin.clients.employee', compact('client'));
    }

    public function employee_data($id)
    {
        $employee = Employee::with('user')->where('client_id', $id)->where('is_kabeng', false)->orderBy('fullname');
        return DataTables::of($employee->get())->addIndexColumn()->make(true);
    }

    public function kuota()
    {
        $auth = Auth::user();
        if ($auth->role === 'admin') {
            return json_encode(['status'=> true, 'message'=> 'Success']);
        } else if($auth->role === 'client'){
            $kuota = Employee::where('user_id', $auth->id)
            ->pluck('quota')
            ->first();

            $total_bengkel = Client::where('status', 'active')
            ->where('kabeng_id', $auth->id)
            ->count();
            
            return json_encode(['status'=> true, 'message'=> 'Success', 'total' => $total_bengkel, 'kuota' => floatval($kuota)]);
        }
    }

    public function download_bengkel(){
        return Excel::download(new BengkelExport, 'bengkel-'.date('y-m-d').'.xlsx');
    }
}
