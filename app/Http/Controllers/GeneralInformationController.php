<?php

namespace App\Http\Controllers;

use App\Enum\FreedomFighterEnum;
use App\Enum\MaritialStatusEnum;
use App\Enum\ReligionEnum;
use App\Enum\SexEnum;
use App\Http\Requests\GeneralIformation\CreateRequest;
use App\Http\Requests\GeneralIformation\UpdateRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\District;
use App\Models\GeneralInformation;
use App\Models\Occupation;
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
            $alldata= GeneralInformation::with(['district','presentDesignation','presentWorkStation','salaryScale'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('generalInformations.show',$row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>" title="Profile"><i class="icon-eye"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo route('generalInformations.edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-edit1"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
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
        $data['occupations'] = Occupation::all();
        $data['designations'] = Designation::all();
        $data['salaryScales'] = SalaryScale::all();
        $data['districts'] = District::all();
        $data['workstations'] = Workstation::all();
        $data['sexes'] = SexEnum::getEnum();
        $data['maritialStatus'] = MaritialStatusEnum::getEnum();
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
    public function show($id)
    {
        $data['generalInformation'] = GeneralInformation::findOrFail($id);
        return view('employee.generalInformation.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['occupations'] = Occupation::all();
        $data['designations'] = Designation::all();
        $data['salaryScales'] = SalaryScale::all();
        $data['districts'] = District::all();
        $data['workstations'] = Workstation::all();
        $data['sexes'] = SexEnum::getEnum();
        $data['maritialStatus'] = MaritialStatusEnum::getEnum();
        $data['generalInformation'] = GeneralInformation::findOrFail($id);
        return view('employee.generalInformation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            if(Arr::has($data, 'photo')){
                $data['photo'] = (Arr::pull($data, 'photo'))->store('photos');
            }

            if(Arr::has($data, 'signature')){
                $data['signature'] = (Arr::pull($data, 'signature'))->store('signatures');
            }
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            GeneralInformation::where('id',$id)->update($data);
            Session::flash('flash_message','Information Successfully Updated !');
            return redirect()->route('generalInformations.index')->with('status_color','success');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            GeneralInformation::where('id',$id)->delete($id);
            Session::flash('flash_message','Record Successfully Deleted.');
            return redirect()->route('generalInformations.index')->with('status_color','success');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
