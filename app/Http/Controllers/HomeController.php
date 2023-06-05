<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\Workstation;
use App\Models\Department;
use App\Models\Designation;
use Session;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2 || Auth::user()->user_type == 3){
            $data['total_workstation'] = Workstation::where('status',1)->count();
            $data['total_department'] = Department::where('status',1)->count();
            $data['total_designation'] = Designation::where('status',1)->count();
            $data['total_employee_present'] = User::where([['user_type',3],['status',1]])->count();
            $data['total_employee_pension'] = User::where([['user_type',3],['status',2]])->count();
            $data['total_employee'] = User::where('user_type',3)->count();
            return view('home',$data);
        }else{
            return view('user-home');
        }
    }

    public function selectBranch()
    {
        return view('branchPanelPopup');
    }

    public function adminSelectedDashboard($branch_id)
    {
        if(Auth::user()->user_type == 1)
        {
            session(['branch_id' => $branch_id]);
            return redirect('home');
        }
    }
}
