<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends RestController
{
    public function client_data()
    {
        $data = Client::orderBy('id', 'desc')->paginate(10);
        return response()->json([
    		'success' => true,
    		'data' => $data,
            'meta' => [],
    		'message' => ''
    	], 200);
    }
}
