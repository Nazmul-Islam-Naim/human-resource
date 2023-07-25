<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationWorkstation\CreateRequest;
use App\Http\Requests\DesignationWorkstation\UpdateRequest;
use App\Models\Designation;
use App\Models\DesignationWorkstation;
use App\Models\EmployeeTransfer;
use App\Models\GeneralInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Workstation;
use Illuminate\Support\Arr;
use Rakibhstu\Banglanumber\Facades\NumberToBangla;
use Session;
use Yajra\DataTables\Facades\DataTables;

class EmptyDesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alldata= DesignationWorkstation::with(['workstation', 'designation', 'generalInformation'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('empty-designations.edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-edit1"></i></a>
                    </li>
                </ul>

<?php return ob_get_clean();
            })->make(True);
        }
        return view ('employee.emptyDesignation.index');
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
    public function store(CreateRequest $request)
    {
        try{
            foreach ($request->designation_id as $key => $value) {
                DesignationWorkstation::create([
                    'workstation_id' => $request->workstation_id,
                    'designation_id' => $value
                ]);
            }
            Session::flash('flash_message','Workstation Designation Successfully Added !');
            return redirect()->route('workstation-designations.index')->with('status_color','success');
        }catch(\Exception $e){
            dd($e->getMessage());
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
        $data['generalInformations'] = GeneralInformation::where('status',1)->select('id','name_in_bangla')->get();
        $data['workstationDesignation'] = DesignationWorkstation::findOrFail($id);
        return view('employee.emptyDesignation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        try{
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            DesignationWorkstation::where('id',$id)->update($data);
            Session::flash('flash_message','Workstation Designation Successfully Updated !');
            return redirect()->route('empty-designations.index')->with('status_color','warning');
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
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyDesignation(Request $request)
    {
        // $alldata = Designation::findOrFail(6);
        // dd($alldata->zeroDesignations);
        if ($request->ajax()) {
            $alldata= Designation::with(['designations', 'workingDesignations', 'zeroDesignations'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()->make(True);
        }
        return view ('employee.emptyDesignation.emptyDesignation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, $designationId)
    {
        if ($request->ajax()) {
            $alldata= DesignationWorkstation::with(['workstation', 'designation'])
                            ->where('designation_id',$request->designationId)
                            ->where('general_information_id',null)
                            ->get();
            return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('timePeriod', function($row){
                    $releaseDate = Carbon::parse($row->release_date);
                    $timePriod = $releaseDate->diff(Carbon::now());
                    return NumberToBangla::bnNum($timePriod->format('%y')).' বছর '.
                        NumberToBangla::bnNum($timePriod->format('%m')).' মাস '.
                        NumberToBangla::bnNum($timePriod->format('%d')).' দিন';
                })
                ->addColumn('lastEmployee', function($row){
                    $lastEmployee = EmployeeTransfer::with(['generalInformation'])
                                    ->where('workstation_id', $row->workstation_id)
                                    ->where('designation_id', $row->designation_id)
                                    ->latest()
                                    ->skip(1)
                                    ->first();
                    return $lastEmployee = $lastEmployee->generalInformation->name_in_bangla ?? '';
                })
                ->make(True);
        }
        return view ('employee.emptyDesignation.report', compact('designationId'));
    }
}
