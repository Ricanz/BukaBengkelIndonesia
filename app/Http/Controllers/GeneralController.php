<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Checking;
use App\Models\Client;
use App\Models\Employee;
use App\Models\StandartChecking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
