<?php

namespace App\Http\Controllers;

use App\Models\GeneralInformation;
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
        $data['workstations'] = Workstation::count();
        $data['designations'] = Designation::count();
        $data['employees'] = GeneralInformation::count();
        $data['directors'] = GeneralInformation::where('status',1)->where('present_designation_id',4)->count();
        $data['assitantDirectors'] = GeneralInformation::where('status',1)->where('present_designation_id',5)->count();
        $data['subAssitantDirectors'] = GeneralInformation::where('status',1)->where('present_designation_id',6)->count();
        $data['runningEmployees'] = GeneralInformation::where('status',1)->count();
        $data['pensionEmployees'] = GeneralInformation::where('status',0)->count();
        return view('user-home',$data);
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
