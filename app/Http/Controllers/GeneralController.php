<?php

namespace App\Http\Controllers;

use App\Models\Checking;
use App\Models\Employee;
use App\Models\StandartChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        switch ($user->role) {
            case 'admin':
                return view('sadmin.admin-dashboard');
                break;
            case 'client':
                return view('sadmin.client-dashboard');
                break;
            default:
                $employee = Employee::with('client')->where('user_id', $user->id)->first();
                $total_standart_checking = Checking::where('employee_id', $employee->id)->where('status', 'active')->where('checking_type', 'standart')->count();
                $total_complete_checking = Checking::where('employee_id', $employee->id)->where('status', 'active')->where('checking_type', 'complete')->count();
                $total = $total_standart_checking + $total_complete_checking;
                return view('sadmin.employee-dashboard', compact('employee', 'total_standart_checking', 'total_complete_checking', 'total'));
                break;
        }
    }
}
