<?php

namespace App\Http\Controllers;

use App\Enum\Status;
use App\Http\Requests\EmployeePensionPrl\PensionCreateRequest;
use App\Http\Requests\EmployeePensionPrl\PensionUpdateRequest;
use App\Http\Requests\EmployeeTransfer\CreateRequest;
use App\Http\Requests\EmployeeTransfer\UpdateRequest;
use App\Http\Requests\TransferApplication\ApplicationCreateRequest;
use App\Http\Requests\TransferApplication\ApplicationUpdateRequest;
use App\Models\GeneralInformation;
use App\Models\TransferStatus;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;
use App\Models\SalaryScale;
use App\Models\District;
use App\Models\Workstation;
use App\Models\EmployeeTransfer;
use App\Models\EmployeePensionPrl;
use App\Models\EmployeeTransferApplication;
use DataTables;
use Illuminate\Support\Arr;
use Validator;
use Session;
use DB;
require_once('ConverterController.php');
include(app_path() . '/library/commonFunction.php');

class EmployeeController extends Controller
{
    //================== transfer by naim ===============

    public function employeeListForTransfer(Request $request){
        if ($request->ajax()) {
            $alldata= GeneralInformation::with(['district','presentDesignation','presentWorkStation','salaryScale'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('transfer-form',$row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">বদলী</i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-pension-prl',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">পেনশন</i></a>
                    </li>
                </ul>

<?php return ob_get_clean();
            })->make(True);
        }
        return view ('employee.transferInformation.index');
    }

    public function trnasferForm($id)
    {
        $data['designations'] = Designation::all();
        $data['salaryScales'] = SalaryScale::all();
        $data['districts'] = District::all();
        $data['workstations'] = Workstation::all();
        $data['generalInformation']= GeneralInformation::findOrFail($id);
        return view ('employee.transferInformation.create',$data);
    }

    public function trnasferFormStore(CreateRequest $request,$id)
    {
        $employee = GeneralInformation::findOrFail($id);
        try{
            tap($employee->employeeTransfer()->create($request->all()), function($query) use ($employee){
                $query->generalInformation()->update([
                    'present_designation_id' => $query->designation_id, 
                    'present_workstation_id' => $query->workstation_id,
                    'salary_scale_id' => $query->salary_scale_id,
                ]);

                $employee->transferStatus()->update([
                    'present_joining_date' => $query->joining_date,
                    'workstation_id' => $employee->present_workstation_id,
                    'designation_id' => $employee->present_designation_id,
                    'previous_joining_date' => $employee->transferStatus->present_joining_date,
                ]);
            });
            Session::flash('flash_message','Transferred Successfully Done !');
            return redirect()->route('employee-transferred-list')->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function employeeTransferredList(Request $request)
    {
        if ($request->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)){
                $alldata=EmployeeTransfer::with(['generalInformation','generalInformation.district','workstation','designation','salaryScale'])
                ->whereBetween('transferred_date',array($request->start_date,$request->end_date))
                ->orWhereBetween('joining_date',array($request->start_date,$request->end_date))
                ->orderBy('id','desc')
                ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                <li class="list-inline-item">
                <a href="<?php echo route('employee-transferred-list-edit',$row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">সংশোধন</i></a>
                </li>
                <li class="list-inline-item">
                <a href="<?php echo route('employee-release',$row->id); ?>" class="badge bg-secondary badge-sm" data-id="<?php echo $row->id; ?>">অব্যাহতি</i></a>
                </li>
                <li class="list-inline-item">
                <a href="<?php echo route('employee-transfer-application',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">দরখস্থ </i></a>
                </li>
                </ul>

                <?php return ob_get_clean();
                })->make(True);
            }else{
                $alldata=EmployeeTransfer::with(['generalInformation','generalInformation.district','workstation','designation','salaryScale'])
                ->orderBy('id','desc')
                ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                <li class="list-inline-item">
                <a href="<?php echo route('employee-transferred-list-edit',$row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">সংশোধন</i></a>
                </li>
                <li class="list-inline-item">
                <a href="<?php echo route('employee-release',$row->id); ?>" class="badge bg-secondary badge-sm" data-id="<?php echo $row->id; ?>">অব্যাহতি</i></a>
                </li>
                <li class="list-inline-item">
                <a href="<?php echo route('employee-transfer-application',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">দরখস্থ</i></a>
                </li>
                </ul>

                <?php return ob_get_clean();
                })->make(True);
            }
        }
        return view ('employee.transferInformation.list');
        
    }

    public function employeeTransferredListUpdate($id)
    {
        $data['designations'] = Designation::all();
        $data['salaryScales'] = SalaryScale::all();
        $data['districts'] = District::all();
        $data['workstations'] = Workstation::all();
        $data['employeeTransfer']= EmployeeTransfer::findOrFail($id);
        return view ('employee.transferInformation.edit',$data);
    }
    public function employeeTransferredRecordUpdate(UpdateRequest $request, $id)
    {
        try{
            $employeeTransfer = EmployeeTransfer::findOrFail($id);
            $employeeTransfer->update($request->all());
            $employee = GeneralInformation::findOrFail($employeeTransfer->general_information_id);
            $employee->update([
                'present_designation_id' => $request->designation_id, 
                'present_workstation_id' => $request->workstation_id,
                'salary_scale_id' => $request->salary_scale_id,
            ]);
    
            $employee->transferStatus()->update([
                'present_joining_date' => $request->joining_date,
            ]);
            Session::flash('flash_message','Transferred Record Successfully Updated !');
            return redirect()->route('employee-transferred-list')->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function employeeRelease($id)
    {
        $data['employeeTransfer']= EmployeeTransfer::findOrFail($id);
        return view ('employee.transferInformation.release',$data);
    }
    
    public function employeeReleaseUpdate(Request $request, $id)
    {
        try{
            EmployeeTransfer::where('id',$id)->update(['release_date' => $request->release_date]);
            Session::flash('flash_message','Transferred Record Successfully Updated !');
            return redirect()->route('employee-transferred-list')->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function employeeTransferApplicationForm($id)
    {
        $data['secretaries'] = User::where('role_id', 4)->get();
        $data['deputySecretaries'] = User::where('role_id', 6)->get();
        $data['employeeTransfer'] = EmployeeTransfer::findOrFail($id);
        return view('employee.applicationInformation.create',$data);
    }
    public function employeeTransferApplicationFormStore(ApplicationCreateRequest $request)
    {

        try{
            EmployeeTransferApplication::create($request->all());
            Session::flash('flash_message','Application Successfully Done !');
            return redirect()->route('employee-transfer-application-list')->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function employeeTransferApplicationList(Request $request){
        if ($request->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)){
                $alldata= EmployeeTransferApplication::with(['employeeTransfer','presentDesignation','presentWorkstation','transferredDesignation','transferredWorkstation'])
                            ->whereBetween('transferred_workstation_date',array($request->start_date,$request->end_date))
                            ->orderBy('id','desc')
                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-transfer-application-print',$row->id); ?>" target="_blank" class="badge badge-primary badge-sm" data-id="<?php echo $row->id; ?>">প্রিন্ট</i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-transfer-application-edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">সংশোধন</i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-transfer-application-delete',$row->id); ?>" class="badge bg-danger badge-sm" data-id="<?php echo $row->id; ?>">ডিলিট</i></a>
                    </li>
                </ul>

<?php return ob_get_clean();
                })->make(True);
            }else{
                $alldata= EmployeeTransferApplication::with(['employeeTransfer', 'employeeTransfer.generalInformation', 'presentDesignation','presentWorkstation','transferredDesignation','transferredWorkstation'])
                            ->orderBy('id','desc')
                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-transfer-application-print',$row->id); ?>" target="_blank" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">প্রিন্ট</i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-transfer-application-edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">সংশোধন</i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-transfer-application-delete',$row->id); ?>" class="badge bg-danger badge-sm" data-id="<?php echo $row->id; ?>">ডিলিট</i></a>
                    </li>
                </ul>

<?php return ob_get_clean();
                })->make(True);
            }
        }
        return view ('employee.applicationInformation.index');
    }
    public function employeeTransferApplicationPrint($id)
    {
        $data['employeeTransferApplication'] = EmployeeTransferApplication::findOrFail($id);
        return view('employee.applicationInformation.print',$data);
    }
    public function employeeTransferApplicationEdit($id)
    {
        $data['secretaries'] = User::where('role_id', 4)->get();
        $data['deputySecretaries'] = User::where('role_id', 6)->get();
        $data['employeeTransferApplication'] = EmployeeTransferApplication::findOrFail($id);
        return view('employee.applicationInformation.edit',$data);
    }
    public function employeeTransferApplicationUpdate(ApplicationUpdateRequest $request, $id)
    {
        try{
            $data = $request->all();
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            $name = Arr::pull($data, 'name');
            EmployeeTransferApplication::where('id',$id)->update($data);
            Session::flash('flash_message','Application Successfully Updated !');
            return redirect()->route('employee-transfer-application-list')->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function employeeTransferApplicationDelete(Request $request, $id)
    {
        try{
            EmployeeTransferApplication::where('id',$id)->delete();
            Session::flash('flash_message','Application Successfully Deleted !');
            return redirect()->route('employee-transfer-application-list')->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    // ============= pansion and prl by naim ===============
    
    public function employeePensionPrlForm($id)
    {
        $data['generalInformation']= GeneralInformation::findOrFail($id);
        return view('employee.pensionPrlInformation.create',$data);
    }
    public function employeePensionPrlFormStore(PensionCreateRequest $request, $id)
    {
        try{
            $employee = GeneralInformation::findOrFail($id);
            $employee->employeePensionPrl()->create($request->all());
            $employee->update(['status'=>Status::getFromName('Inactive')]);
            Session::flash('flash_message','Pension and Prl Successfully Done !');
            return redirect()->route('employee-pension-prl-list')->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function employeePensionPrlList(Request $request)
    {
        if ($request->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)){
                $alldata=EmployeePensionPrl::with(['generalInformation','generalInformation.district'])
                        ->whereBetween('prl_date',array($request->start_date,$request->end_date))
                        ->orderBy('id','desc')
                        ->get();
                return DataTables::of($alldata)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {
                        ob_start() ?>

                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a href="<?php echo route('employee-pension-prl-history',$row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">ভিউ</i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo route('employee-pension-prl-edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">সংশোধন</i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo route('employee-pension-prl-delete',$row->id); ?>" class="badge bg-danger badge-sm" data-id="<?php echo $row->id; ?>">ডিলিট</i></a>
                            </li>
                        </ul>

                        <?php return ob_get_clean();
                        })->make(True);
            }else{
                $alldata=EmployeePensionPrl::with(['generalInformation','generalInformation.district'])
                        ->orderBy('id','desc')
                        ->get();
                        return DataTables::of($alldata)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {
                        ob_start() ?>

                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a href="<?php echo route('employee-pension-prl-history',$row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">ভিউ</i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo route('employee-pension-prl-edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">সংশোধন</i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo route('employee-pension-prl-delete',$row->id); ?>" class="badge bg-danger badge-sm" data-id="<?php echo $row->id; ?>">ডিলিট</i></a>
                            </li>
                        </ul>

                        <?php return ob_get_clean();
                        })->make(True);
            }
        }
        return view ('employee.pensionPrlInformation.index');
        
    }
    public function employeePensionHistory($id)
    {
       $data['employeePensionPrl'] = EmployeePensionPrl::findOrFail($id);
        return view ('employee.pensionPrlInformation.show',$data);
        
    }
    public function pensionAndPrlFormEdit($id)
    {
       $data['employeePensionPrl'] = EmployeePensionPrl::findOrFail($id);
        return view ('employee.pensionPrlInformation.edit',$data);
        
    }
    public function pensionAndPrlFormUpdate(PensionUpdateRequest $request, $id)
    {
        $data = $request->all();
        $method = Arr::pull($data, '_method');
        $token = Arr::pull($data, '_token');
        try{
            EmployeePensionPrl::where('id',$id)->update($data);
            Session::flash('flash_message','Pension/Prl Successfully Updated !');
            return redirect()->route('employee-pension-prl-list')->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function pensionAndPrlDelete(Request $request, $id)
    {
        try{
            $pensionEmployee = EmployeePensionPrl::findOrFail($id);
            $pensionEmployee->generalInformation->update([ "status" => Status::getFromName('Active')]);
            $pensionEmployee->delete();
            Session::flash('flash_message','Pension/Prl Successfully Deleted !');
            return redirect()->back()->with('status_color','success');
        }catch(\Exception $exception){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
