<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationWorkstation\CreateRequest;
use App\Http\Requests\DesignationWorkstation\UpdateRequest;
use App\Models\Designation;
use App\Models\DesignationWorkstation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Workstation;
use Illuminate\Support\Arr;
use Rakibhstu\Banglanumber\Facades\NumberToBangla;
use Session;
use Yajra\DataTables\Facades\DataTables;

class WorkstationDesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alldata= DesignationWorkstation::with(['workstation', 'designation'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <!-- <li class="list-inline-item">
                        <a href="<?php echo route('workstation-designations.edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-edit1"></i></a>
                    </li> -->
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

                <?php return ob_get_clean();
            })->make(True);
        }
        return view ('catalogs.workstationDesignation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['workstations'] = Workstation::all();
        $data['designations'] = Designation::all();
        return view('catalogs.workstationDesignation.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try{
            foreach ($request->designation_id as $key => $value) {
                DesignationWorkstation::updateOrCreate(
                    [
                        'workstation_id' => $request->workstation_id,
                        'designation_id' => $value
                    ],
                    [
                        'workstation_id' => $request->workstation_id,
                        'designation_id' => $value
                    ]
                );
            }
            Session::flash('flash_message','Workstation Designation Successfully Added !');
            return redirect()->route('workstation-designations.index')->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['workstations'] = Workstation::all();
        $data['designations'] = Designation::all();
        $data['workstationDesignation'] = DesignationWorkstation::findOrFail($id);
        return view('catalogs.workstationDesignation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        try{
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            DesignationWorkstation::where('id',$id)->update($data);
            Session::flash('flash_message','Workstation Designation Successfully Updated !');
            return redirect()->route('workstation-designations.index')->with('status_color','warning');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
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
        try{
            DesignationWorkstation::where('id',$id)->delete();
            Session::flash('flash_message','Workstation Designation Successfully Deleted !');
            return redirect()->route('workstation-designations.index')->with('status_color','warning');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function workstations(Request $request)
    {
        if ($request->ajax()) {
            $alldata= Workstation::with([
                'workstations'
            ])->get();
            return DataTables::of($alldata)
            ->addIndexColumn()->addColumn('action', function($row){
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('workstations-report',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-book-open"></i></a>
                    </li>
                </ul>

                <?php return ob_get_clean();
            })
            ->addColumn('totalEmployee', function($row){
                if (!empty($row->workstations)) {
                    $totalEmployee = $row->workstations->where('general_information_id', '!=', null)->count();
                    return $totalEmployee;
                } else {
                    return '0';
                }
                
            })
            ->make(True);
        }
        return view ('employee.workstationDesignation.workstations');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, $id)
    {
        if ($request->ajax()) {
            $alldata= DesignationWorkstation::with(['generalInformation','generalInformation.mainDesignation','generalInformation.presentDesignation','workstation', 'designation'])
                            ->where('workstation_id', $id)
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()->addColumn('timePeriod', function($row){
                if (!empty($row->general_information_id)) {
                    if ($row->joining_date <= Carbon::now()) {
                        $workstationJoinDate = Carbon::parse($row->joining_date);
                        $timePriod = $workstationJoinDate->diff(Carbon::now());
                        return NumberToBangla::bnNum($timePriod->format('%y')).' বছর '.
                               NumberToBangla::bnNum($timePriod->format('%m')).' মাস '.
                               NumberToBangla::bnNum($timePriod->format('%d')).' দিন';
                    } else {
                        return '';
                    }
                } else {
                    return '';
                }
                
            })->addColumn('timePeriods', function($row){
                if (!empty($row->general_information_id)) {
                    $generalInformation = $row->generalInformation;
                    if ($generalInformation->joining_date <= Carbon::now()) {
                        $joinDate = Carbon::parse($generalInformation->joining_date);
                        $timePriods = $joinDate->diff(Carbon::now());
                        return NumberToBangla::bnNum($timePriods->format('%y')).' বছর '.
                               NumberToBangla::bnNum($timePriods->format('%m')).' মাস '.
                               NumberToBangla::bnNum($timePriods->format('%d')).' দিন';
                    } else {
                        return '';
                    }
                } else {
                    return '';
                }
                
            })->make(True);
        }
        return view ('employee.workstationDesignation.report', ['workstationId' => $id]);
    }
}
