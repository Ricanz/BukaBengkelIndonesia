<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
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

    public function search()
    {
        $search = isset($_GET["query"]) ? $_GET["query"] : '';

        $data = Article::select('title', 'slug')->where('title', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [],
            'message' => ''
        ], 200);
    }
}
