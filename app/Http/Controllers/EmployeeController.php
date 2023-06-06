<?php

namespace App\Http\Controllers;

use App\Enum\MaritialStatusEnum;
use App\Enum\SexEnum;
use App\Models\GeneralInformation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\TransactionReport;
use App\Models\Transaction;
use App\Models\EmployeeLedger;
use App\Models\Designation;
use App\Models\Department;
use App\Models\RequestedLeave;
use App\Models\SalaryScale;
use App\Models\District;
use App\Models\Workstation;
use App\Models\EmployeeTransfer;
use App\Models\EmployeePensionPrl;
use App\Models\EmployeeTransferApplication;
use DataTables;
use BanglaDateTime;
use Validator;
use Response;
use Session;
use Auth;
use Hash;
use DB;
require_once('ConverterController.php');
include(app_path() . '/library/commonFunction.php');

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alldata= GeneralInformation::with(['user_department_object','user_designation_object','user_salary_scale_object','user_district_object','user_workstation_object'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-pofile',$row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">প্রোফাইল</i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo route('edit-employee-list',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">সংশোধন</i></a>
                    </li>
                </ul>

<?php return ob_get_clean();
            })->make(True);
        }
        return view ('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_department'] = Department::all();
        $data['all_designation'] = Designation::all();
        $data['all_salary_scale'] = SalaryScale::all();
        $data['all_district'] = District::all();
        $data['all_workstation'] = Workstation::all();
        $data['sexes'] = SexEnum::getEnum();
        $data['maritialStatus'] = MaritialStatusEnum::getEnum();
        return view('employee.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'name' => 'required',
            'designation_id' => 'required',
            // 'email' => 'required|email|unique:users|max:191',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['user_type'] = 3;
        $input['status'] = 1;
        $input['employee_id'] = Converter::bn2en($request->employee_id);
        $input['salary'] = Converter::bn2en($request->salary);
        $input['dob'] = date('Y-m-d', strtotime($request->dob));
        $input['join_date'] = date('Y-m-d', strtotime($request->join_date));
        $input['system_id'] = session('branch_id');
        $input['joining_date'] = dateFormateForDB($request->joining_date);
        if ($request->hasFile('image')) {
            $photo=$request->file('image');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            $photo->move('storage/app/public/uploads/employee', $fileName);
            $input['image']=$fileName;
        }

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= User::create($input);
            
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Employee Successfully Added !');
            return redirect()->back()->with('status_color','success');
        }else{
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
        $data['single_data']= User::where('id', $id)->first();
        return view('employee.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['all_department'] = Department::where('status',1)->get();
        $data['all_designation'] = Designation::where('status',1)->get();
        $data['all_salary_scale'] = SalaryScale::where('status',1)->get();
        $data['all_district'] = District::where('status',1)->get();
        $data['all_workstation'] = Workstation::where('status',1)->get();
        $data['single_data'] = User::where('id',$id)->first();
        return view('employee.form',$data);
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
        $data=User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'name' => 'required',
            'designation_id' => 'required',
            // 'email' => 'required|unique:users,email,'.$data->id
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['user_type'] = 3;
        $input['employee_id'] = Converter::bn2en($request->employee_id);
        $input['salary'] = Converter::bn2en($request->salary);
        $input['dob'] = date('Y-m-d', strtotime($request->dob));
        $input['join_date'] = date('Y-m-d', strtotime($request->join_date));
        if(empty($request->image)){
            $input['image'] = $data->image;
        }else{
            if ($request->hasFile('image')) {
                $photo=$request->file('image');
                $fileType=$photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $photo->move('storage/app/public/uploads/employee', $fileName);
                $input['image']=$fileName;
            }
        }
        
        DB::beginTransaction();
        try{
            $bug=0;
            $data->update($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Employee Successfully Updated !');
            return redirect()->back()->with('status_color','warning');
        }else{
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
    
    public function storeSalary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|gt:0',
            'date' => 'required',
            'month' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 1;
        $input['created_by'] = Auth::id();
        $input['reason'] = 'salary';
        $input['tok'] = date('Ymdhis');
        $input['branch_id'] = session('branch_id');
        $input['date'] = dateFormateForDB($request->date);

        DB::beginTransaction();
        try{
            // checking duplicate
            $count = EmployeeLedger::where([['employee_id', $request->employee_id],['month', $request->month]])->whereYear('date', '=', date('Y'))->count();
            if($count == 1){
                $bug=1;
            }else{
                $bug=0;
                $insert= EmployeeLedger::create($input);
                
                $decrement=DB::table('bank_account')->where('id', $request->bank_id)->decrement('balance', $request->amount);

                $insert = TransactionReport::create([
                    'branch_id'=>session('branch_id'),
                    'bank_id'=>$request->bank_id,
                    'transaction_date'=>dateFormateForDB($request->date),
                    'reason'=>'payment(employee salary)',
                    'amount'=>$request->amount,
                    'note'=>$request->note,
                    'tok'=>date('Ymdhis'),
                    'status'=>'1',
                    'created_by'=>Auth::id()
                ]);

                $insert = Transaction::create([
                    'branch_id'=>session('branch_id'),
                    'date'=>dateFormateForDB($request->date),
                    'reason'=>'Payment(employee salary)',
                    'amount'=>$request->amount,
                    'tok'=>date('Ymdhis'),
                    'status'=>'1',
                    'created_by'=>Auth::id()
                ]);
            }
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Data Successfully Added !');
            return redirect()->back()->with('status_color','success');
        }elseif($bug==1){
            Session::flash('flash_message','Salary already Given !');
            return redirect()->back()->with('status_color','warning');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    
    public function employeeLedger(Request $request)
    {
        //$data['alldata']= ProductSell::where('tok', $request->id)->get();
        //$data['singleData']= Vat::where('tok', $request->id)->first();
        $data['alldata']= EmployeeLedger::where('employee_id', $request->id)->paginate(250);
        $data['singledata']= Employee::where('id', $request->id)->first();
        return view('employee.employeeLedger', $data);
    }
    
    public function filter(Request $request, $id)
    {
        if ($request->search && $request->start_date !="" && $request->end_date !="") {
            $data['alldata']= EmployeeLedger::where('employee_id', $id)->whereBetween('date', [dateFormateForDB($request->start_date), dateFormateForDB($request->end_date)])->paginate(250);
            $data['singledata']= Employee::where('id', $id)->first();
            $data['start_date']= $request->start_date;
            $data['end_date']= $request->end_date;
            return view('employee.employeeLedger', $data);
        }
    }
    
    public function report()
    {
        $data['alldata']= EmployeeLedger::orderBy('id', 'DESC')->paginate(250);
        return view('employee.report', $data);
    }
    
    public function reportFilter(Request $request)
    {
        if ($request->start_date !="" && $request->end_date !="") {
            $data['alldata']= EmployeeLedger::whereBetween('employee_ledger.date', [dateFormateForDB($request->start_date), dateFormateForDB($request->end_date)])->orderBy('employee_ledger.id', 'DESC')->select('employee_ledger.*')->paginate(250);
            $data['start_date']= $request->start_date;
            $data['end_date']= $request->end_date;
            return view('employee.report', $data);
        }else{ 
            $data['alldata']= EmployeeLedger::orderBy('id', 'DESC')->paginate(250);
            return view('employee.report', $data);
        }
    }
    
    public function getSalaryForAmendment()
    {
        $data['alldata']= EmployeeLedger::orderBy('id', 'DESC')->paginate(250);
        return view('amenment.employeeSalaryReport', $data);
    }
    
    public function deleteSalaryForAmendment($id)
    {
        DB::beginTransaction();
        try{
            $bug=0;
            $info= EmployeeLedger::where('tok', $id)->first();
            
            $decrement=DB::table('bank_account')->where('id', $info->bank_id)->increment('balance', $info->amount);

            $delete = TransactionReport::where('tok', $id)->delete();
            $delete = Transaction::where('tok', $id)->delete();
            $delete = EmployeeLedger::where('tok', $id)->delete();
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    
    public function searchEmpSalaryAmendmentFilter(Request $request)
    {
        if ($request->search && $request->start_date !="" && $request->end_date !="" && $request->input =="") {
            $data['alldata']= EmployeeLedger::whereBetween('employee_ledger.date', [$request->start_date, $request->end_date])->orderBy('employee_ledger.id', 'DESC')->select('employee_ledger.*')->paginate(250);
            $data['start_date']= $request->start_date;
            $data['end_date']= $request->end_date;
            return view('amenment.employeeSalaryReport', $data);
        }elseif ($request->search && $request->start_date !="" && $request->end_date !="" && $request->input !="") {
            $data['alldata']= EmployeeLedger::join('employees', 'employees.id', '=', 'employee_ledger.employee_id')->where('employees.name', 'like', '%' . $request->input . '%')->whereBetween('employee_ledger.date', [$request->start_date, $request->end_date])->orderBy('employee_ledger.id', 'DESC')->select('employee_ledger.*')->paginate(250);
            $data['start_date']= $request->start_date;
            $data['end_date']= $request->end_date;
            return view('amenment.employeeSalaryReport', $data);
        }elseif ($request->search && $request->start_date =="" && $request->end_date =="" && $request->input !="") {
            $data['alldata']= EmployeeLedger::join('employees', 'employees.id', '=', 'employee_ledger.employee_id')->where('employees.name', 'like', '%' . $request->input . '%')->orderBy('employee_ledger.id', 'DESC')->select('employee_ledger.*')->paginate(250);
            $data['start_date']= $request->start_date;
            $data['end_date']= $request->end_date;
            return view('amenment.employeeSalaryReport', $data);
        }
    }

    public function applyLeaveForm()
    {
        $data['alldata']= RequestedLeave::orderBy('id', 'DESC')->paginate(250);
        $data['allemployee']= User::where('user_type', '3')->get();
        return view('employee.applyLeave', $data);
    }

    public function storeApplyLeave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'leave_from_date' => 'required',
            'leave_to_date' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 0;
        $input['date'] = date('Y-m-d');
        $input['created_by'] = Auth::id();
        $input['leave_from_date'] = date('Y-m-d', strtotime($request->leave_from_date));
        $input['leave_to_date'] = date('Y-m-d', strtotime($request->leave_to_date));

        // get days from date
        /*$now = strtotime(date('Y-m-d', strtotime($request->leave_to_date))); 
        $your_date = strtotime(date('Y-m-d', strtotime($request->leave_from_date)));
        $datediff = $now - $your_date;
        $days = round($datediff / (60 * 60 * 24));*/

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= RequestedLeave::create($input);
            //$update= User::where('id', $request->employee_id)->decrement('total_leave', $days);
            
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Leave Request Successfully Sent !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function findTtlLeaveWithEmployeeId(Request $request)
    {
        $chequeno = User::select('total_leave', 'id')->where('id',$request->id)->first();
        return Response::json($chequeno);
        die;
    }

    public function approveAppliedLeave(Request $request, $id)
    {
        $data=RequestedLeave::findOrFail($id);
        $input['status'] = '1';

        // get days from date
        $now = strtotime(date('Y-m-d', strtotime($data->leave_to_date))); 
        $your_date = strtotime(date('Y-m-d', strtotime($data->leave_from_date)));
        $datediff = $now - $your_date;
        $days = round($datediff / (60 * 60 * 24));

        DB::beginTransaction();
        try{
            $bug=0;
            $data->update($input);
            $update= User::where('id', $data->employee_id)->decrement('total_leave', $days);
            
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Leave Request Successfully Approved !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function rejectAppliedLeave(Request $request, $id)
    {
        $data=RequestedLeave::findOrFail($id);
        $input['status'] = '2';

        DB::beginTransaction();
        try{
            $bug=0;
            $data->update($input);
            
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Leave Request Successfully Rejected !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }


    //================== transfer by naim ===============

    public function employeeListForTransfer(Request $request){
        if ($request->ajax()) {
            $alldata= User::with(['user_department_object','user_designation_object','user_salary_scale_object','user_district_object','user_workstation_object'])
                            ->where([['user_type', '3'],['status', '1']])
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
        return view ('employee.employeeListForTransfer');
    }

    public function trnasferForm($id)
    {
        $data['all_department'] = Department::where('status',1)->get();
        $data['all_designation'] = Designation::where('status',1)->get();
        $data['all_salary_scale'] = SalaryScale::where('status',1)->get();
        $data['all_district'] = District::where('status',1)->get();
        $data['all_workstation'] = Workstation::where('status',1)->get();
        $data['single_data']= User::where('id', $id)->first();
        return view ('employee.transferForm',$data);
    }

    public function trnasferFormStore(Request $request,$id)
    {
        $employee = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            // 'designation_id' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 1;
        $input['salary'] = Converter::bn2en($request->salary);
        $input['house_rent'] = Converter::bn2en($request->house_rent);
        $input['total_taken_leave'] = Converter::bn2en($request->total_taken_leave);
        $input['allowance'] = Converter::bn2en($request->allowance);
        $input['present_workstation_joining_date'] = date('Y-m-d', strtotime($request->present_workstation_joining_date));
        $input['transferred_workstation_date'] = dateFormateForDB($request->transferred_workstation_date);
        $input['transferred_workstation_joining_date'] = dateFormateForDB($request->transferred_workstation_joining_date);

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= EmployeeTransfer::create($input);
            $update = $employee->update([
                'designation_id' => $request->main_designation_id,
                'workstation_designation_id' => $request->transferred_workstation_designation_id,
                'workstation_id' => $request->transferred_workstation_id,
                'salary_scale_id' => $request->salary_scale_id,
                'salary' => Converter::bn2en($request->salary),
                'join_date' => dateFormateForDB($request->transferred_workstation_joining_date),
            ]);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Transferred Successfully Done !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function employeeTransferredList(Request $request)
    {
        if ($request->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)){
                $alldata=EmployeeTransfer::with(['user_department_object','user_present_designation_object','user_salary_scale_object','user_type_object','user_present_workstation_object','user_previous_workstation_object','user_previous_designation_object','user_main_designation_object'])
                ->whereBetween('transferred_workstation_date',array($request->start_date,$request->end_date))
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
                <a href="<?php echo route('employee-transfer-application',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">দরখস্থ </i></a>
                </li>
                </ul>

                <?php return ob_get_clean();
                })->make(True);
            }else{
                $alldata=EmployeeTransfer::with(['user_department_object','user_present_designation_object','user_salary_scale_object','user_type_object','user_present_workstation_object','user_previous_workstation_object','user_previous_designation_object','user_main_designation_object'])
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
                <a href="<?php echo route('employee-transfer-application',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>">দরখস্থ</i></a>
                </li>
                </ul>

                <?php return ob_get_clean();
                })->make(True);
            }
        }
        return view ('employee.employeeTransferredList');
        
    }

    public function employeeTransferredListUpdate($id)
    {
        $data['all_department'] = Department::where('status',1)->get();
        $data['all_designation'] = Designation::where('status',1)->get();
        $data['all_salary_scale'] = SalaryScale::where('status',1)->get();
        $data['all_district'] = District::where('status',1)->get();
        $data['all_workstation'] = Workstation::where('status',1)->get();
        $data['single_data']= EmployeeTransfer::where('id', $id)->first();
        return view ('employee.editTransferForm',$data);
    }
    public function employeeTransferredRecordUpdate(Request $request, $id)
    {
        $employee = User::findOrFail($request->employee_id);
        $transferredEmployee = EmployeeTransfer::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            // 'designation_id' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 1;
        $input['salary'] = Converter::bn2en($request->salary);
        $input['house_rent'] = Converter::bn2en($request->house_rent);
        $input['total_taken_leave'] = Converter::bn2en($request->total_taken_leave);
        $input['allowance'] = Converter::bn2en($request->allowance);
        $input['present_workstation_joining_date'] = date('Y-m-d', strtotime($request->present_workstation_joining_date));
        $input['transferred_workstation_date'] = dateFormateForDB($request->transferred_workstation_date);
        $input['transferred_workstation_joining_date'] = dateFormateForDB($request->transferred_workstation_joining_date);

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= $transferredEmployee->update($input);
            $update = $employee->update([
                'designation_id' => $request->main_designation_id,
                'workstation_designation_id' => $request->transferred_workstation_designation_id,
                'workstation_id' => $request->transferred_workstation_id,
                'salary_scale_id' => $request->salary_scale_id,
                'salary' => Converter::bn2en($request->salary),
                'join_date' => dateFormateForDB($request->transferred_workstation_joining_date),
            ]);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Transferred Record Successfully Updated !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function employeeTransferHistory($id)
    {
        $data['single_data'] = User::findOrFail($id);
        $data['alldata'] = EmployeeTransfer::where('employee_id',$id)->orderBy('id','desc')->get();
        return view('employee.transferredHistory',$data);
    }
    public function employeeTransferApplicationForm($id)
    {
        $data['single_data'] = EmployeeTransfer::findOrFail($id);
        return view('employee.transferApplicationForm',$data);
    }
    public function employeeTransferApplicationFormStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transfer_number' => 'required',
            'first_paragraph' => 'required',
            'editordata1' => 'required',
            'editordata2' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 1;
        $input['transferred_workstation_date'] = dateFormateForDB($request->transferred_workstation_date);

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= EmployeeTransferApplication::create($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Application Successfully Done !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function employeeTransferApplicationList(Request $request){
        if ($request->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)){
                $alldata= EmployeeTransferApplication::with(['user_type_object','user_main_designation_object','user_present_designation_object','user_present_workstation_object','user_previous_designation_object','user_previous_workstation_object'])
                            ->where([['status', '1']])
                            ->whereBetween('transferred_workstation_date',array($request->start_date,$request->end_date))
                            ->orderBy('id','desc')
                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-transfer-application-print',$row->id); ?>" class="badge badge-primary badge-sm" data-id="<?php echo $row->id; ?>">প্রিন্ট</i></a>
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
                $alldata= EmployeeTransferApplication::with(['user_type_object','user_main_designation_object','user_present_designation_object','user_present_workstation_object','user_previous_designation_object','user_previous_workstation_object'])
                            ->where([['status', '1']])
                            ->orderBy('id','desc')
                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('employee-transfer-application-print',$row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">প্রিন্ট</i></a>
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
        return view ('employee.employeeTransferredApplicationList');
    }
    public function employeeTransferApplicationPrint($id)
    {
        $data['single_data'] = EmployeeTransferApplication::findOrFail($id);
        return view('employee.transferApplicationPrint',$data);
    }
    public function employeeTransferApplicationEdit($id)
    {
        $data['single_data'] = EmployeeTransferApplication::findOrFail($id);
        return view('employee.transferApplicationFormEdit',$data);
    }
    public function employeeTransferApplicationUpdate(Request $request, $id)
    {
        $transferApplication = EmployeeTransferApplication::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            // 'designation_id' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 1;
        $input['transferred_workstation_date'] = dateFormateForDB($request->transferred_workstation_date);

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= $transferApplication->update($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Application Successfully Updated !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function employeeTransferApplicationDelete(Request $request, $id)
    {
        $transferApplication = EmployeeTransferApplication::findOrFail($id);

        DB::beginTransaction();
        try{
            $bug=0;
            $del= $transferApplication->delete();
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Application Successfully Deleted !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    // ============= pansion and prl by naim ===============
    
    public function employeePensionPrlForm($id)
    {
        $data['all_department'] = Department::where('status',1)->get();
        $data['all_designation'] = Designation::where('status',1)->get();
        $data['all_salary_scale'] = SalaryScale::where('status',1)->get();
        $data['all_district'] = District::where('status',1)->get();
        $data['all_workstation'] = Workstation::where('status',1)->get();
        $data['single_data']= User::where('id', $id)->first();
        return view('employee.pensionAndPrlFrom',$data);
    }
    public function employeePensionPrlFormStore(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            // 'designation_id' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 1;
        $input['last_basic_salary'] = Converter::bn2en($request->last_basic_salary);
        $input['leave_average_pay'] = Converter::bn2en($request->leave_average_pay);
        $input['leave_half_pay'] = Converter::bn2en($request->leave_half_pay);
        $input['due_provident_fund'] = Converter::bn2en($request->due_provident_fund);
        $input['leave_encashment_owed'] = Converter::bn2en($request->leave_encashment_owed);
        $input['amount_gratuity'] = Converter::bn2en($request->amount_gratuity);
        $input['audit_objected_amount'] = Converter::bn2en($request->audit_objected_amount);
        $input['total_amount_owed'] = Converter::bn2en($request->total_amount_owed);
        $input['amount_money_payable'] = Converter::bn2en($request->amount_money_payable);
        $input['provident_fund'] = Converter::bn2en($request->provident_fund);
        $input['leave_encashment'] = Converter::bn2en($request->leave_encashment);
        $input['gratuity'] = Converter::bn2en($request->gratuity);
        $input['amount_loan_taken'] = Converter::bn2en($request->amount_loan_taken);
        $input['dob'] = date('Y-m-d', strtotime($request->dob));
        $input['prl_date'] = dateFormateForDB($request->prl_date);

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= EmployeePensionPrl::create($input);
            $update = $employee->update([
                'status' =>2,
            ]);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Pension and Prl Successfully Done !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function employeePensionPrlList(Request $request)
    {
        if ($request->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)){
                $alldata=EmployeePensionPrl::with(['user_district_object','user_type_object'])
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
                $alldata=EmployeePensionPrl::with(['user_district_object','user_type_object'])
                ->orderBy('id','desc')
                ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                <li class="list-inline-item">
                <a href="<?php echo route('employee-pension-prl-history',$row->employee_id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">ভিউ</i></a>
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
        return view ('employee.employeePensionPrlList');
        
    }
    public function employeePensionHistory($id)
    {
       $data['single_data'] = EmployeePensionPrl::where('employee_id',$id)->first();
        return view ('employee.pensionHistory',$data);
        
    }
    public function pensionAndPrlFormEdit($id)
    {
       $data['single_data'] = EmployeePensionPrl::where('id',$id)->first();
        return view ('employee.pensionAndPrlFormEdit',$data);
        
    }
    public function pensionAndPrlFormUpdate(Request $request, $id)
    {
        $pensionEmployee = EmployeePensionPrl::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            // 'designation_id' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 1;
        $input['last_basic_salary'] = Converter::bn2en($request->last_basic_salary);
        $input['leave_average_pay'] = Converter::bn2en($request->leave_average_pay);
        $input['leave_half_pay'] = Converter::bn2en($request->leave_half_pay);
        $input['due_provident_fund'] = Converter::bn2en($request->due_provident_fund);
        $input['leave_encashment_owed'] = Converter::bn2en($request->leave_encashment_owed);
        $input['amount_gratuity'] = Converter::bn2en($request->amount_gratuity);
        $input['audit_objected_amount'] = Converter::bn2en($request->audit_objected_amount);
        $input['total_amount_owed'] = Converter::bn2en($request->total_amount_owed);
        $input['amount_money_payable'] = Converter::bn2en($request->amount_money_payable);
        $input['provident_fund'] = Converter::bn2en($request->provident_fund);
        $input['leave_encashment'] = Converter::bn2en($request->leave_encashment);
        $input['gratuity'] = Converter::bn2en($request->gratuity);
        $input['amount_loan_taken'] = Converter::bn2en($request->amount_loan_taken);
        $input['dob'] = date('Y-m-d', strtotime($request->dob));
        $input['prl_date'] = dateFormateForDB($request->prl_date);

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= $pensionEmployee->update($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Pension/Prl Successfully Updated !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function pensionAndPrlDelete(Request $request, $id)
    {
        $pensionEmployee = EmployeePensionPrl::findOrFail($id);
        $employee = User::findOrFail($pensionEmployee->employee_id);

        DB::beginTransaction();
        try{
            $bug=0;
            $upd = $employee->update([ "status" => 1]);
            $del= $pensionEmployee->delete();
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Pension/Prl Successfully Deleted !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
