<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Client;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


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
        
        $submit = Client::create([
            'title' => $request->name,
            'description' => $request->description,
            'code' => $request->id,
            'image' => $img,
            'address' => $request->address,
            'city' => $request->city,
            'status' => 'active',
        ]);

        if ($submit) {
            if ($request->kabeng) {
                $email = Utils::generateEmail($request->kabeng);
                $user = User::create([
                    'name' => $request->kabeng,
                    'email' => $email,
                    'password' => Hash::make('pass.123'),
                    'role' => 'client'
                ]);
                Employee::create([
                    'user_id' => $user->id,
                    'client_id' => $submit->id,
                    'fullname' => $request->kabeng, 
                    'is_kabeng' => true
                ]);
            }
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
        $client = Client::findOrFail($id);
        return view('sadmin.clients.edit', compact('client'));
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

        $client = Client::findOrFail($request->client_id);
        $client->title = $request->name;
        $client->code = $request->id;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->status = $request->status;
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
        //
    }

    public function data()
    {
        $data = Client::orderBy('id', 'desc');
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }
}
