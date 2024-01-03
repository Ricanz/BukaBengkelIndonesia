<?php

namespace App\Http\Controllers;

use App\Exports\CheckingExport as ExportsCheckingExport;
use App\Helpers\Utils;
use App\Models\Checking;
use App\Models\CheckingImage;
use App\Models\Employee;
use App\Models\StandartChecking;
use CheckingExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class  CheckingController extends Controller
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
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        DB::beginTransaction();
        try {
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
                'checking_type' => 'standart',
                'number' => $formattedNextNumber,
                'saran' => $request->saran,
                'note' => $request->catatan
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
                    'compressor' => $request->compressor,
                    'cabin' => $request->cabin,
                    'blower' => $request->blower,
                    'fan' => $request->fan,
                    'status' => 'active',
                    'type' => 'pre'
                ]);
                DB::commit();
                return json_encode(['status' => true, 'message' => 'Success', 'id' => $checking->id]);
            } else {
                DB::rollBack();
                return json_encode(['status' => false, 'message' => 'Something went wrong.']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
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
        $checking = Checking::with('employee', 'client', 'types', 'standart', 'advisor')->findOrFail($id);
        return view('sadmin.checking.show', compact('checking'));
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

        $checking->wo = $request->wo ? $request->wo : $checking->wo;
        $checking->plat_number = $request->nopol ? $request->nopol : $checking->plat_number;
        $checking->sa_id = $request->advisor ? $request->advisor : $checking->sa_id;
        $checking->type_id = $request->type ? $request->type : $checking->type_id;
        
        $checking->saran = $request->saran;
        $checking->note = $request->catatan;

        $detail->km = $request->km;
        $detail->high = $request->high;
        $detail->low = $request->low;
        $detail->suhu = $request->suhu;
        $detail->wind = $request->wind;
        $detail->compressor = $request->compressor;
        $detail->cabin = $request->cabin;
        $detail->blower = $request->blower;
        $detail->fan = $request->fan;

        if ($checking->save() && $detail->save()) {
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
            $data = Checking::with('employee', 'client', 'types', 'post')->with('advisor', function($q){
                $q->with('client');
            })->where('checking_type', 'standart')->whereHas('client', function ($query) use ($user_id) {
                $query->where('kabeng_id', $user_id);
            })->where('status', 'active');
        } else if ($user->role === 'employee') {
            $data = Checking::with('employee', 'client', 'types', 'post')->with('advisor', function($q){
                $q->with('client');
            })->where('checking_type', 'standart')->where('user_id', $user->id)->where('status', 'active');
        } else {
            $data = Checking::with('employee', 'client', 'types', 'post')->with('advisor', function($q){
                $q->with('client');
            })->where('checking_type', 'standart')->where('status', 'active');
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
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        
        $file = $request->file('file'); // Pastikan 'file' adalah nama field di form Anda
        $extension = $file->getClientOriginalExtension();

        if ($extension == 'heic' || $extension == 'heif') {
            return json_encode(['status' => false, 'message' => ['Tidak bisa upload dengan format .HEIC dan .HEIF']]);
        }

        $checking = StandartChecking::find($request->checking_id);

        if (!$checking) {
            return json_encode(['status' => false, 'message' => ['Something went wrong.']]);
        }
        $submit = CheckingImage::create([
            'image' => Utils::uploadImage($request->file, 300),
            'checking_id' => $request->checking_id,
            'desc_id' => $request->description,
            'type' => $checking->type,
            'checking_type' => $request->checking_type,
        ]);
        if ($submit) {
            return json_encode(['status' => true, 'message' => 'Success']);
        } else {
            return json_encode(['status' => false, ['message' => 'Something went wrong.']]);
        }
    }

    public function image_data(Request $request)
    {
        $data = CheckingImage::with('types')->where('checking_id', $request->id)->where('type', $request->type)->where('checking_type', $request->checkingType)->where('status', 'active');
        return DataTables::of($data->get())->addIndexColumn()->make(true);
    }

    public function image_update(Request $request)
    {
        if ($request->has('file')) {
            $img = Utils::uploadImage($request->file, 300);
            $image = CheckingImage::findOrFail($request->id);
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
        $image = CheckingImage::findOrFail($id);
        $image->status = 'deleted';
        $image->save();
        return redirect()->back();
    }

    public function create_post($id){
        $check = Checking::with('advisor', 'types')->find($id);
        return view('sadmin.checking.create-post', compact('check'));
    }

    public function store_post(Request $request)
    {
        $checking = Checking::where('id', $request->id)->first();
        if (!$checking) {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
        
        $checking->saran_post = $request->saran;
        $checking->note_post = $request->catatan;
        if ($checking->save()) {
            $post = StandartChecking::where('checking_id', $checking->id)->where('status', 'active')->where('type', 'post')->first();
            if ($post) {
                $post->km = $request->km ? $request->km : $post->km;
                $post->high = $request->high ? $request->high : $post->high;
                $post->low = $request->low ? $request->low : $post->low;
                $post->suhu = $request->suhu ? $request->suhu : $post->suhu;
                $post->wind = $request->wind ? $request->wind : $post->wind;
                $post->compressor = $request->compressor ? $request->compressor : $post->compressor;
                $post->cabin = $request->cabin ? $request->cabin : $post->cabin;
                $post->blower = $request->blower ? $request->blower : $post->blower;
                $post->fan = $request->fan ? $request->fan : $post->fan;
                $post->save();
            } else {
                StandartChecking::create([
                    'checking_id' => $checking->id,
                    'km' => $request->km,
                    'high' => $request->high,
                    'low' => $request->low,
                    'suhu' => $request->suhu,
                    'wind' => $request->wind,
                    'compressor' => $request->compressor,
                    'cabin' => $request->cabin,
                    'blower' => $request->blower,
                    'fan' => $request->fan,
                    'status' => 'active',
                    'type' => 'post'
                ]);
            }
            return json_encode(['status' => true, 'message' => 'Success']);
        } else {
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
    }

    public function show_post($id)
    {
        $checking = Checking::with('employee', 'client', 'types', 'post', 'advisor')->findOrFail($id);
        $images = CheckingImage::where('checking_id', $checking->post->id)->where('type', 'post')->count();
        
        return view('sadmin.checking.show-post', compact('checking', 'images'));
    }

    public function pdf($id)
    {
        $checking = Checking::with('advisor', 'client', 'standart', 'types', 'employee')->find($id);
        // dd($checking->standart->images[0]->types);
        // $first_batch = $checking->standart->images->slice(0, 3); // 3 data pertama
        // $second_batch = $checking->standart->images->slice(3, 2);
        // return view('pdf.precheck', compact('checking', 'first_batch', 'second_batch'));
        $firstBatch = $checking->standart->images->slice(0, 3); // 3 data pertama
        $secondBatch = $checking->standart->images->slice(3, 3);
        $data = [
            'checking' => $checking,
            'first_batch' => $firstBatch,
            'second_batch' => $secondBatch
        ];

        $pdf = PDF::loadView('pdf.precheck', $data);
        $pdf_name = $checking->client->title.'-'.'Pre-Check-'.$checking->wo.'-'.now()->format('d-m-Y').'.pdf';
        $pdf->setPaper('A4');
        return $pdf->stream($pdf_name);
        // return $pdf->download($pdf_name);
    }

    public function pdf_post($id)
    {
        $checking = Checking::with('advisor', 'client', 'post', 'types', 'employee')->find($id);
        // dd($checking->standart->images[0]->types);
        // $first_batch = $checking->standart->images->slice(0, 3); // 3 data pertama
        // $second_batch = $checking->standart->images->slice(3, 2);
        // return view('pdf.postcheck', compact('checking', 'first_batch', 'second_batch'));
        $firstBatch = $checking->post->images_post->slice(0, 3); // 3 data pertama
        $secondBatch = $checking->post->images_post->slice(3, 3);
        $data = [
            'checking' => $checking,
            'first_batch' => $firstBatch,
            'second_batch' => $secondBatch
        ];

        $pdf = PDF::loadView('pdf.postcheck', $data);
        $pdf_name = $checking->client->title.'-'.'Post-Check-'.$checking->wo.'-'.now()->format('d-m-Y').'.pdf';
        $pdf->setPaper('A4');
        return $pdf->stream($pdf_name);
    }

    public function view_pdf($id)
    {
        $checking = Checking::with('advisor', 'client', 'standart', 'types', 'employee')->find($id);
        
        $images = $checking->standart->images;
        return view('pdf.view.precheck-standart', compact('checking', 'images'));
    }

    public function view_pdf_post($id)
    {
        $checking = Checking::with('advisor', 'client', 'standart', 'types', 'employee')->find($id);
        
        $images = $checking->post->images_post;
        return view('pdf.view.postcheck-standart', compact('checking', 'images'));
    }

    public function download(){
        return Excel::download(new ExportsCheckingExport, 'checking-'.date('y-m-d').'.xlsx');
    }
}
