<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\MasterItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterItemController extends Controller
{
    public function index()
    {
        return view('sadmin.item.index');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'item' => 'required',
            'checklist' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }

        $slug = Utils::slugify($request->item);
        $submit = MasterItem::create([
            'item' => $request->item,
            'checklist' => $request->checklist,
            'status' => 'active',
            'slug' => $slug
        ]);

        if ($submit) {
            return json_encode(['status' => true, 'message' => 'Success']);
        } else {
            return json_encode(['status' => false, 'message' => ['Something went wrong.']]);
        }
    }

    public function edit($id)
    {
        $data = MasterItem::find($id);
        return view('sadmin.item.show', compact('data'));
    }

    public function update(Request $request)
    {
        $item = MasterItem::find($request->id);
        if ($item) {
            $item->item = $request->item;
            $item->checklist = $request->checklist;
            $item->status = $request->status;
            if ($item->save()) {
                return json_encode(['status' => true, 'message' => 'Success']);
            }
            return json_encode(['status' => false, 'message' => ['Something went wrong.']]);
        }
        return json_encode(['status' => false, 'message' => ['Something went wrong.']]);
    }

    public function data(Request $request)
    {
        $data = MasterItem::where('status', '!=', 'deleted')->orderByDesc('id');
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }

    public function destroy($id)
    {
        $master = MasterItem::findOrFail($id);
        $master->status = 'deleted';
    
        if ($master->save()) {
            return redirect()->back();
        }
        return json_encode(['status' => false, 'message' => ['Gagal Hapus!']]);
    }
}
