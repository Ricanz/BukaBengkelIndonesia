<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Checking;
use App\Models\CompleteChecking;
use App\Models\CompleteImage;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class CompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sadmin.complete.index');
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
            'advisor' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        $employee_id = 1;
        $client_id = 1;

        $user = Auth::user();
        if ($user->role === 'employee') {
            $employee = Employee::where('user_id', $user->id)->first();
            $employee_id = $employee->id;
            $client_id = $employee->client_id;
        }

        $lastNumber = Checking::where('client_id', $employee->client->id)->orderByDesc('number')->pluck('number')->first();
        $nextNumber = (int)$lastNumber + 1;
        $formattedNextNumber = sprintf('%06d', $nextNumber);

        $checking = Checking::create([
            'user_id' => $user->id,
            'employee_id' => $employee_id,
            'client_id' => $client_id,
            'sa_id' => $request->advisor,
            'wo' => $request->wo,
            'plat_number' => $request->nopol,
            'type_id' => $request->type,
            'status' => 'active',
            'checking_type' => 'complete',
            'number' => $formattedNextNumber,
            'saran' => $request->saran,
            'note' => $request->catatan,
        ]);
        if ($checking) {
            if (count($request->master) > 0) {
                foreach ($request->master as $key => $value) {
                    CompleteChecking::create([
                        'master_checking_id' => $value,
                        'checking_id' => $checking->id,
                        'type' => $request->checking_type ? $request->checking_type : 'pre',
                        'status' => 'active',
                        'value_title' => $request->judul_hasil[$key],
                        'value' => $request->result[$key],
                        'val_check' => $request->hasil[$key],
                        'pass' => $request->hasil_check[$key]
                    ]);
                }
            }
            return json_encode(['status' => true, 'message' => 'Success']);
        } else {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
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
        $checking = Checking::with('complete')->where('id', $id)->where('checking_type', 'complete')->first();
        return view('sadmin.complete.show', compact('checking'));
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

        $checking->wo = $request->wo ? $request->wo : $checking->wo;
        $checking->plat_number = $request->nopol ? $request->nopol : $checking->plat_number;
        $checking->sa_id = $request->advisor ? $request->advisor : $checking->sa_id;
        $checking->saran = $request->saran ? $request->saran : $checking->saran;
        $checking->note = $request->catatan ? $request->catatan : $checking->note;

        if ($checking->save()) {
            if (count($request->master) > 0) {
                $total_record = CompleteChecking::where('checking_id', $checking->id)->where('type', 'pre')->count();
                foreach ($request->master as $key => $value) {
                    if ($key < $total_record) {
                        $complete = CompleteChecking::where('checking_id', $checking->id)->where('master_checking_id', $value)->first();
                        $complete->value_title = $request->judul_hasil[$key];
                        $complete->value = $request->result[$key];
                        $complete->val_check = $request->hasil[$key];
                        $complete->pass = $request->hasil_check[$key];
                        $complete->save();
                    } else {
                        CompleteChecking::create([
                            'master_checking_id' => $value,
                            'checking_id' => $checking->id,
                            'type' => 'pre',
                            'status' => 'active',
                            'value_title' => $request->judul_hasil[$key],
                            'value' => $request->result[$key],
                            'val_check' => $request->hasil[$key],
                            'pass' => $request->hasil_check[$key]
                        ]);
                    }
                }
            }
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
        //
    }

    public function data()
    {
        $user = Auth::user();
        if ($user->role === 'client') {
            $user_id = $user->id;
            $data = Checking::with('employee', 'client', 'types', 'advisor', 'complete_post')->where('checking_type', 'Complete')->whereHas('client', function ($query) use ($user_id) {
                $query->where('kabeng_id', $user_id);
            })->where('status', 'active');
        } else if ($user->role === 'employee') {
            $data = Checking::with('employee', 'client', 'types', 'advisor', 'complete_post')->where('checking_type', 'Complete')->where('user_id', $user->id)->where('status', 'active');
        } else {
            $data = Checking::with('employee', 'client', 'types', 'advisor', 'complete_post')->where('checking_type', 'Complete')->where('status', 'active');
        }
        return DataTables::of($data->orderByDesc('created_at')->get())->addIndexColumn()->make(true);
    }

    public function image_data(Request $request)
    {
        $data = CompleteImage::with('master')->where('checking_id', $request->id)->where('type', $request->type)->where('status', '!=', 'deleted');
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }

    public function image(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'file' => 'required',
            'description' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }

        $complete = CompleteChecking::where('checking_id', $request->checking_id)->where('type', $request->type)->first();

        $submit = CompleteImage::create([
            'image' => Utils::uploadImage($request->file, 300),
            'checking_id' => $complete->checking_id,
            'desc_id' => $request->description,
            'type' => $complete->type
        ]);
        if ($submit) {
            return json_encode(['status' => true, 'message' => 'Success']);
        } else {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
    }

    public function image_update(Request $request)
    {
        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
            $image = CompleteImage::findOrFail($request->id);
            $image->image = $img;
            if ($image->save()) {
                return json_encode(['status' => true, 'message' => 'Success']);
            } else {
                return json_encode(['status' => false, 'message' => 'Something went wrong.']);
            }
        }
    }

    public function image_destroy($id)
    {
        $image = CompleteImage::findOrFail($id);
        $image->status = 'deleted';
        $image->save();
        return redirect()->back();
    }


    public function create_post($id)
    {
        $checking = Checking::with('advisor', 'types')->find($id);
        return view('sadmin.complete.create-post', compact('checking'));
    }

    public function store_post(Request $request)
    {
        $checking = Checking::where('id', $request->checking_id)->first();
        if (!$checking) {
            return json_encode(['status' => false, 'message' => ['Something went wrong.']]);
        }
        DB::beginTransaction();
        try {
            $checking->saran_post = $request->saran;
            $checking->note_post = $request->catatan;
            $checking->has_post = true;

            if ($checking->save()) {
                if (count($request->id) > 0) {
                    foreach ($request->id as $key => $value) {
                        $complete = CompleteChecking::where('checking_id', $checking->id)->where('id', $value)->first();
                        $complete->value_post = $request->result[$key];
                        $complete->val_check_post = $request->hasil[$key];
                        $complete->pass_post = $request->hasil_check[$key];
                        $complete->save();
                    }
                }
                DB::commit();
                return json_encode(['status' => true, 'message' => 'Success']);
            } else {
                return json_encode(['status' => false, 'message' => ['Something went wrong.']]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return json_encode(['status' => false, 'message' => ['Something went wrong.']]);
        }
    }

    public function show_post($id)
    {
        $checking = Checking::with('employee', 'client', 'types', 'advisor', 'complete_posts')->findOrFail($id);
        // dd($checking->complete_posts[0]);
        return view('sadmin.complete.show-post', compact('checking'));
    }

    public function pdf($id)
    {
        $checking = Checking::with('advisor', 'client', 'complete', 'types', 'employee')->find($id);
        $images = CompleteImage::where('checking_id', $checking->id)->where('status', 'active')->get();

        $firstBatch = $images->slice(0, 3); // 3 data pertama
        $secondBatch = $images->slice(3, 3);
        $thirdBatch = $images->slice(6, 3);
        $fourthBatch = $images->slice(9, 3);
        // return view('pdf.precheck-complete', compact('checking', 'first_batch', 'second_batch', 'third_batch', 'fourth_batch'));

        $data = [
            'checking' => $checking,
            'first_batch' => $firstBatch,
            'second_batch' => $secondBatch,
            'third_batch' => $thirdBatch,
            'fourth_batch' => $fourthBatch
        ];

        $pdf = PDF::loadView('pdf.precheck-complete', $data);
        $pdf_name = $checking->client->title . '-' . 'Complete-Pre-Check' . $checking->wo . '-' . now()->format('d-m-Y') . '.pdf';
        $pdf->setPaper('A4');
        return $pdf->stream($pdf_name);
        // return $pdf->download($pdf_name);
    }

    public function pdf_post($id)
    {
        $checking = Checking::with('advisor', 'client', 'complete', 'types', 'employee')->find($id);
        $images = CompleteImage::where('checking_id', $checking->id)->where('type', 'post')->where('status', 'active')->get();

        $firstBatch = $images->slice(0, 3); // 3 data pertama
        $secondBatch = $images->slice(3, 3);
        $thirdBatch = $images->slice(6, 3);
        $fourthBatch = $images->slice(9, 3);
        // return view('pdf.precheck-complete', compact('checking', 'first_batch', 'second_batch', 'third_batch', 'fourth_batch'));

        $data = [
            'checking' => $checking,
            'first_batch' => $firstBatch,
            'second_batch' => $secondBatch,
            'third_batch' => $thirdBatch,
            'fourth_batch' => $fourthBatch
        ];

        $pdf = PDF::loadView('pdf.postcheck-complete', $data);
        $pdf_name = $checking->client->title . '-' . 'Complete-Post-Check' . $checking->wo . '-' . now()->format('d-m-Y') . '.pdf';
        $pdf->setPaper('A4');
        return $pdf->stream($pdf_name);
        // return $pdf->download($pdf_name);
    }
}
