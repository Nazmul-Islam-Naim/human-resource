<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentWorkstation\CreateRequest;
use App\Http\Requests\DepartmentWorkstation\UpdateRequest;
use App\Models\Department;
use App\Models\DepartmentWorkstation;
use App\Models\Workstation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DepartmentWorkstationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $alldata= DepartmentWorkstation::with(['department', 'workstation'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

                <?php return ob_get_clean();
            })->make(True);
        }
        return view ('catalogs.departmentWorkstation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['departments'] = Department::all();
        $data['workstations'] = Workstation::all();
        return view('catalogs.departmentWorkstation.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try{
            foreach ($request->workstation_id as $key => $value) {
                DepartmentWorkstation::updateOrCreate(
                    [
                        'department_id' => $request->department_id,
                        'workstation_id' => $value
                    ],
                    [
                        'department_id' => $request->department_id,
                        'workstation_id' => $value
                    ]
                );
            }
            Session::flash('flash_message','Department Workstation Successfully Added !');
            return redirect()->route('department-workstations.index')->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['departments'] = Department::all();
        $data['workstations'] = Workstation::all();
        $data['departmentWorkstation'] = DepartmentWorkstation::findOrFail($id);
        return view('catalogs.departmentWorkstation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        try{
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            DepartmentWorkstation::where('id',$id)->update($data);
            Session::flash('flash_message','Department Workstation Successfully Updated !');
            return redirect()->route('department-workstations.index')->with('status_color','warning');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            DepartmentWorkstation::where('id',$id)->delete();
            Session::flash('flash_message','Department Workstation Successfully Deleted !');
            return redirect()->route('department-workstations.index')->with('status_color','warning');
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
    public function departments(Request $request)
    {
        if ($request->ajax()) {
            $alldata= Department::with([
                    'departments',
                    'departments.workstation',
                    'departments.workstation.workstations'
                ])
                ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()->addColumn('action', function($row){
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('departments-report',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-book-open"></i></a>
                    </li>
                </ul>

                <?php return ob_get_clean();
            })
            ->addColumn('totalEmployee', function($row){
                if (!empty($row->departments)) {
                    $totalEmployee = 0;
                    foreach ($row->departments as $key => $department) {
                        $totalEmployee += $department->workstation->workstations->where('general_information_id', '!=', null)->count();

                    }
                    return $totalEmployee;
                } else {
                    return '0';
                }

            })
            ->make(True);
        }
        return view ('employee.departmentWorkstation.departments');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, $id)
    {
        $departmentName = Department::select('name')->where('id', $id)->first()->name;
        if ($request->ajax()) {
            $alldata= DepartmentWorkstation::with([
                            'department',
                            'workstation',
                            'workstation.workstations.designation',
                            'workstation.workstations.generalInformation'
                            ])
                            ->where('department_id', $id)
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('employees', function($row){
                $employees = '';
                if (!empty($row->workstation->workstations)) {
                    foreach ($row->workstation->workstations as $key => $generalInformation) {
                       $employees .= ($generalInformation->generalInformation->name_in_bangla ?? 'নাই') . '<br/>';
                    }
                    return $employees;
                } else {
                    return 'নাই'. '<br/>';
                }
            })
            ->escapeColumns([])
            ->addColumn('designations', function($row){
                $designations = '';
                if (!empty($row->workstation->workstations)) {
                    foreach ($row->workstation->workstations as $key => $designation) {
                       $designations .= $designation->designation->title . '<br/>';
                    }
                    return $designations;
                } else {
                    return '';
                }
            })
            ->escapeColumns([])
            ->addColumn('totalEmployee', function($row){
                $totalEmployee = '';
                if (!empty($row->workstation->workstations)) {
                    $totalEmployee = $row->workstation->workstations->where('general_information_id', '!=', null)->count();
                    return $totalEmployee.'<br>';
                } else {
                    return '';
                }
            })
            ->escapeColumns([])
            ->make(True);
        }
        return view ('employee.departmentWorkstation.report', ['departmentId' => $id, 'departmentName' => $departmentName]);
    }
}
