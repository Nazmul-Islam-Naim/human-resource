<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferStatus\UpdateRequest;
use App\Models\Designation;
use App\Models\TransferStatus;
use App\Models\Workstation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Rakibhstu\Banglanumber\Facades\NumberToBangla;
use Yajra\DataTables\Facades\DataTables;

class TransferStatusController extends Controller
{
    
    public function index(Request $request){
        if ($request->ajax()) {
            $transferStatuses = TransferStatus::with('generalInformation', 'generalInformation.mainDesignation', 'generalInformation.district',
                                                     'generalInformation.presentDesignation', 'generalInformation.presentWorkStation',
                                                     'previousWorkstation', 'previousDesignation'
                                                     )->get();
            return DataTables::of($transferStatuses)->addIndexColumn()->addColumn('action', function ($row) {
                ob_start() ?>

                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="<?php echo route('transfer-status-edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">সংশোধন</i></a>
                        </li>
                    </ul>

                <?php return ob_get_clean();
            })->make(True);
        }

        return view('employee.transferStatus.index');
    }

    public function edit($id){
        $data['workstations'] = Workstation::all();
        $data['designations'] = Designation::all();
        $data['transferStatus'] = TransferStatus::findOrFail($id);
        return view('employee.transferStatus.edit',$data);
    }

    public function update(UpdateRequest $request, $id){
        try{
            $data = $request->all();
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            TransferStatus::where('id',$id)->update($data);
            Session::flash('flash_message','Record Successfully Updated !');
            return redirect()->route('transfer-status-index')->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function report(Request $request){
        $designations = Designation::select('id', 'title')->get();
        if ($request->ajax()) {
            if ($request->designation_id != '') {
                $transferStatuses = TransferStatus::with('generalInformation', 'generalInformation.mainDesignation', 'generalInformation.district',
                                                         'generalInformation.presentDesignation', 'generalInformation.presentWorkStation',
                                                         'previousWorkstation', 'previousDesignation'
                                                         )
                                                         ->whereHas('generalInformation',function($query) use($request){
                                                            $query->where('present_designation_id',$request->designation_id);
                                                         })
                                                         ->get();
                return DataTables::of($transferStatuses)->addIndexColumn()->make(true);
            } else {
                $transferStatuses = TransferStatus::with('generalInformation', 'generalInformation.mainDesignation', 'generalInformation.district',
                                                         'generalInformation.presentDesignation', 'generalInformation.presentWorkStation',
                                                         'previousWorkstation', 'previousDesignation'
                                                         )->get();
                return DataTables::of($transferStatuses)->addIndexColumn()->make(true);
            }
            
        }

        return view('employee.transferStatus.report', compact('designations'));
    }

    public function time(Request $request){
        $designations = Designation::select('id', 'title')->get();
        if ($request->ajax()) {
            if ($request->designation_id != '') {
                $transferStatuses = TransferStatus::with('generalInformation', 'generalInformation.mainDesignation', 'generalInformation.district',
                                                         'generalInformation.presentDesignation', 'generalInformation.presentWorkStation',
                                                         )
                                                         ->whereHas('generalInformation', function($query) use($request){
                                                            $query->where('present_designation_id',$request->designation_id);
                                                         })
                                                         ->get();
                return DataTables::of($transferStatuses)->addIndexColumn()->addColumn('timePeriod', function($row){
                    $joiningDate = Carbon::parse($row->present_joining_date);
                    $timePriod = $joiningDate->diff(Carbon::now());
                    return NumberToBangla::bnNum($timePriod->format('%y')).' বছর '.NumberToBangla::bnNum($timePriod->format('%m')).' মাস '.NumberToBangla::bnNum($timePriod->format('%d')).' দিন';
                })->make(true);
            } else {
                $transferStatuses = TransferStatus::with('generalInformation', 'generalInformation.mainDesignation', 'generalInformation.district',
                                                         'generalInformation.presentDesignation', 'generalInformation.presentWorkStation',
                                                         )->get();
                return DataTables::of($transferStatuses)->addIndexColumn()->addColumn('timePeriod', function($row){
                    $joiningDate = Carbon::parse($row->present_joining_date);
                    $timePriod = $joiningDate->diff(Carbon::now());
                    return NumberToBangla::bnNum($timePriod->format('%y')).' বছর '.NumberToBangla::bnNum($timePriod->format('%m')).' মাস '.NumberToBangla::bnNum($timePriod->format('%d')).' দিন';
                })->make(true);
            }
            
        }

        return view('employee.transferStatus.time', compact('designations'));
    }

}
