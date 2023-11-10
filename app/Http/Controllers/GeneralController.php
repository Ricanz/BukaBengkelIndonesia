<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Checking;
use App\Models\CheckingImage;
use App\Models\Client;
use App\Models\Employee;
use App\Models\MasterChecking;
use App\Models\MasterType;
use App\Models\ServiceAdvisor;
use App\Models\StandartChecking;
use App\Models\StandartChecking2;
use App\Models\StandartCheckingPost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GeneralController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        switch ($user->role) {
            case 'admin':
                $checking = Checking::with('advisor')->where('status', 'active')->orderByDesc('id')->limit(5)->get();
                $standart_checking = Checking::with('advisor')->where('status', 'active')->where('checking_type', 'standart')->orderByDesc('id')->limit(5)->get();
                $complete_checking = Checking::with('advisor')->where('status', 'active')->where('checking_type', 'complete')->orderByDesc('id')->limit(5)->get();
                
                $total = count($standart_checking) + count($complete_checking);
                $total_bengkel = Client::where('status', 'active')->count();
                $total_teknisi = Employee::Where('status', 'active')->where('is_kabeng', false)->count();
                return view('sadmin.admin-dashboard', compact('standart_checking', 'complete_checking', 'total', 'checking', 'total_bengkel', 'total_teknisi'));
                break;
            case 'client':
                $clients = Client::where('kabeng_id', $user->id)->pluck('id')->toArray();
                
                $employee = Employee::with('client')->where('user_id', $user->id)->first();
                $checking = Checking::with('advisor')->whereIn('client_id', $clients)->where('status', 'active')->orderByDesc('id')->limit(5)->get();
                $standart_checking = Checking::with('advisor')->whereIn('client_id', $clients)->where('status', 'active')->where('checking_type', 'standart')->orderByDesc('id')->limit(5)->get();
                $complete_checking = Checking::with('advisor')->whereIn('client_id', $clients)->where('status', 'active')->where('checking_type', 'complete')->orderByDesc('id')->limit(5)->get();
                
                $total = count($standart_checking) + count($complete_checking);
                return view('sadmin.client-dashboard', compact('employee', 'standart_checking', 'complete_checking', 'total', 'checking'));
                break;
            default:
                $employee = Employee::with('client')->where('user_id', $user->id)->first();
                $checking = Checking::with('advisor')->where('user_id', $user->id)->where('status', 'active')->orderByDesc('id')->limit(5)->get();
                $standart_checking = Checking::with('advisor')->where('employee_id', $employee->id)->where('status', 'active')->where('checking_type', 'standart')->orderByDesc('id')->limit(5)->get();
                $complete_checking = Checking::with('advisor')->where('employee_id', $employee->id)->where('status', 'active')->where('checking_type', 'complete')->orderByDesc('id')->limit(5)->get();
                
                $total = count($standart_checking) + count($complete_checking);
                return view('sadmin.employee-dashboard', compact('employee', 'standart_checking', 'complete_checking', 'total', 'checking'));
                break;
        }
    }

    public function user_profile()
    {
        $user = Auth::user();
        $employee = Employee::with('user')->where('user_id', $user->id)->first();
        return view('sadmin.profile.show', compact('employee'));
    }

    public function post_user_profile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $employee = Employee::where('user_id', $user->id)->first();
        
        $user->email = $request->email ? $request->email : $user->email;
        $user->name = $request->fullname ? $request->fullname : $employee->fullname;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->save();

        $employee->image = $request->has('file') ? Utils::uploadImage($request->file, 300) : $employee->image;
        $employee->fullname = $request->fullname ? $request->fullname : $employee->fullname;
        $employee->save();
        
        return json_encode(['status' => true, 'message' => ['Success']]);

    }

    public function backup()
    {
        return view('sadmin.backup.index');
    }

    public function backup_store(Request $request)
    {
        $standart = StandartChecking2::where('no_wo', $request->wo)->first();
        $client_id = Client::whereRaw('LOWER(title) = ?', [strtolower($request->client)])->pluck('id')->first();
        $sa_id = ServiceAdvisor::whereRaw('LOWER(name) = ?', [strtolower($request->sa)])->pluck('id')->first();
        $type_id = MasterType::whereRaw('LOWER(name) = ?', [strtolower($request->type)])->pluck('id')->first();
        $user = Auth::user();
        $employee_id = Employee::where('user_id', $user->id)->pluck('id')->first();

        $lastNumber = Checking::where('client_id', $client_id)->orderByDesc('number')->pluck('number')->first();
        $nextNumber = (int)$lastNumber + 1;
        $formattedNextNumber = sprintf('%06d', $nextNumber);

        $wo = Utils::generateStaticWo();

        DB::beginTransaction();
        try {
            $checking = Checking::create([
                'user_id' => $user->id,
                'employee_id' => $employee_id,
                'client_id' => $client_id,
                'sa_id' => $sa_id,
                'wo' => $wo,
                'plat_number' => $standart->nopol,
                'type_id' => $type_id,
                'status' => 'active',
                'checking_type' => 'standart',
                'number' => $formattedNextNumber,
                'saran' => substr($standart->saran_perbaikan, 0, 75),
                'note' => null
            ]);
    
            if ($checking) {
                $s_checking = StandartChecking::create([
                    'checking_id' => $checking->id,
                    'km' => $standart->kilometer,
                    'high' => Utils::check_text($standart->high_pressure),
                    'low' => Utils::check_text($standart->low_pressure),
                    'suhu' => Utils::check_text($standart->suhu_blower),
                    'wind' => Utils::check_text($standart->wind_speed),
                    'saran' => $standart->saran_perbaikan,
                    'compressor' => 'Berfungsi Normal',
                    'cabin' => 'Bersih',
                    'blower' => 'Berfungsi',
                    'fan' => '',
                    'status' => 'active',
                    'type' => 'pre'
                ]);

                if ($standart->img_tampak_depan) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLink($standart->img_tampak_depan),
                        'desc_id' => 18,
                        'type' => 'pre',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($standart->img_km) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLink($standart->img_km),
                        'desc_id' => 22,
                        'type' => 'pre',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($standart->img_suhu) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLink($standart->img_suhu),
                        'desc_id' => 19,
                        'type' => 'pre',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($standart->img_blower) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLink($standart->img_blower),
                        'desc_id' => 20,
                        'type' => 'pre',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($standart->img_evaporator) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLink($standart->img_evaporator),
                        'desc_id' => 24,
                        'type' => 'pre',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
                DB::commit();
                // return json_encode(['status' => true, 'message' => 'Success']);
                return redirect('/success-backup');
            } else {
                DB::rollBack();
                return json_encode(['status' => false, 'message' => 'Something went wrong.']);
            }
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
    }

    public function backup_post()
    {
        return view('sadmin.backup.post');
    }

    public function backup_post_store(Request $request)
    {
        $pre = StandartChecking2::where('no_wo', $request->wo)->first();

        $standart = StandartCheckingPost::where('id_pcs', $pre->id_pcs)->first();
        DB::beginTransaction();
        try {
            $std = StandartChecking::where('km', $pre->kilometer)->first();
            if (!$std) {
                dd("Wo tidak ditemukan, masukkan wo baru lainnya!");
            }
            $checking = Checking::where('id', $std->checking_id)->first();
            dd($standart);
            $checking->saran_post = substr($standart->po_hasil_pekerjaan, 0, 75);
            $checking->catatan_post = $standart->po_catatan_perbaikan;
            $checking->has_post = true;
            if ($checking->save()) {
                $s_checking = StandartChecking::create([
                    'checking_id' => $checking->id,
                    'km' => $standart->po_kilometer,
                    'high' => Utils::check_text($standart->po_high_pressure),
                    'low' => Utils::check_text($standart->po_low_pressure),
                    'suhu' => Utils::check_text($standart->po_suhu_blower),
                    'wind' => Utils::check_text($standart->po_wind_speed),
                    'saran' => substr($standart->po_hasil_pekerjaan, 0, 75),
                    'compressor' => $standart->po_kompressor,
                    'cabin' => $standart->po_cabin_air_filter,
                    'blower' => $standart->po_blower,
                    'fan' => '',
                    'status' => 'active',
                    'type' => 'post'
                ]);

                if ($standart->po_img_tampak_depan !== null) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLinkPost($standart->po_img_tampak_depan),
                        'desc_id' => 18,
                        'type' => 'post',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($standart->po_img_km) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLinkPost($standart->po_img_km),
                        'desc_id' => 22,
                        'type' => 'post',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($standart->po_img_suhu) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLinkPost($standart->po_img_suhu),
                        'desc_id' => 19,
                        'type' => 'post',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($standart->po_img_blower) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLinkPost($standart->po_img_blower),
                        'desc_id' => 20,
                        'type' => 'post',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($standart->po_img_evaporator) {
                    CheckingImage::create([
                        'checking_id' => $s_checking->id,
                        'checking_type' => 'standart',
                        'image' => Utils::uploadImageByLinkPost($standart->po_img_evaporator),
                        'desc_id' => 24,
                        'type' => 'post',
                        'status' => 'active',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
                DB::commit();
                // return json_encode(['status' => true, 'message' => 'Success']);
                return redirect('/success-backup');
            } else {
                DB::rollBack();
                return json_encode(['status' => false, 'message' => 'Something went wrong.']);
            }
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return json_encode(['status' => false, 'message' => 'Something went wrong.']);
        }
    }
}
