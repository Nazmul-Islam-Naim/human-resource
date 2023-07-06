<?php

namespace App\Http\Controllers;

use App\Models\DesignationWorkstation;
use App\Models\GeneralInformation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Workstation;
use App\Models\Designation;
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
        $data['dg'] = User::where('role_id',3)->orderBy('id','desc')->first();
        $data['secretary'] = User::where('role_id',4)->orderBy('id','desc')->first();
        $data['deputySecretary'] = User::where('role_id',6)->orderBy('id','desc')->first();
        $data['workstations'] = Workstation::count();
        $data['designations'] = Designation::count();
        $data['emptyDesignations'] = DesignationWorkstation::where('general_information_id',null)->count();
        $data['employees'] = GeneralInformation::count();
        $data['directors'] = GeneralInformation::where('status',1)->where('present_designation_id',4)->count();
        $data['assitantDirectors'] = GeneralInformation::where('status',1)->where('present_designation_id',5)->count();
        $data['subAssitantDirectors'] = GeneralInformation::where('status',1)->where('present_designation_id',6)->count();
        $data['runningEmployees'] = GeneralInformation::where('status',1)->count();
        $data['upComingPensions'] = GeneralInformation::whereDate('prl_date','>=', Carbon::now()->subDays(15))->whereDate('prl_date','<=', Carbon::now()->addDays(15))->count();
        $data['pensionEmployees'] = GeneralInformation::where('status',0)->count();
        return view('dashboard.dashboard',$data);
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
