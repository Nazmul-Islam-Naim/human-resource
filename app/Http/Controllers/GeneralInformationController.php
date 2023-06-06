<?php

namespace App\Http\Controllers;

use App\Enum\FreedomFighterEnum;
use App\Enum\MaritialStatusEnum;
use App\Enum\ReligionEnum;
use App\Enum\SexEnum;
use App\Http\Requests\GeneralIformation\CreateRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\District;
use App\Models\GeneralInformation;
use App\Models\SalaryScale;
use App\Models\Workstation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class GeneralInformationController extends Controller
{
    /**
     * Display a listing of the resource.
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
        return view ('employee.generalInformation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['all_department'] = Department::all();
        $data['all_designation'] = Designation::all();
        $data['all_salary_scale'] = SalaryScale::all();
        $data['districts'] = District::all();
        $data['all_workstation'] = Workstation::all();
        $data['sexes'] = SexEnum::getEnum();
        $data['maritialStatus'] = MaritialStatusEnum::getEnum();
        $data['religions'] = ReligionEnum::getEnum();
        $data['freedomFighters'] = FreedomFighterEnum::getEnum();
        return view('employee.generalInformation.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            $data = $request->all();
            if(Arr::has($data, 'photo')){
                $data['photo'] = (Arr::pull($data, 'photo'))->store('photos');
            }

            if(Arr::has($data, 'signature')){
                $data['signature'] = (Arr::pull($data, 'signature'))->store('signatures');
            }
            GeneralInformation::create($data);
            Session::flash('flash_message','Information Successfully Added !');
            return redirect()->route('generalInformations.index')->with('status_color','success');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
