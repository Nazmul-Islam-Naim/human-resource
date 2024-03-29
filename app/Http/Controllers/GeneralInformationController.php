<?php

namespace App\Http\Controllers;

use App\Enum\DocumentTitleEnum;
use App\Enum\JoiningType;
use App\Enum\MaritialStatusEnum;
use App\Enum\SexEnum;
use App\Http\Requests\GeneralIformation\CreateRequest;
use App\Http\Requests\GeneralIformation\UpdateRequest;
use App\Models\Designation;
use App\Models\DesignationWorkstation;
use App\Models\District;
use App\Models\DocumentHistory;
use App\Models\GeneralInformation;
use App\Models\Occupation;
use App\Models\SalaryScale;
use App\Models\Workstation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Rakibhstu\Banglanumber\Facades\NumberToBangla;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Contracts\Formatter;

class GeneralInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alldata= GeneralInformation::with(['district','presentDesignation','presentWorkStation'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('generalInformations.show',$row->id); ?>" target="_blank" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>" title="Profile"><i class="icon-eye"></i></a>
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
        $data['joiningTypes'] = JoiningType::get();
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

            if(Arr::has($data, 'document')){
                $data['document'] = (Arr::pull($data, 'document'))->store('offerLetters');
            }
            $joiningDate = Carbon::parse($request->birth_date);
            $data['prl_date'] = $joiningDate->addYears(59)->subDay();
            tap(GeneralInformation::create($data), function($query){
                $query->transferStatus()->create([
                    'present_joining_date' => $query->joining_date
                ]);

                $query->employeeTransfer()->create([
                    'workstation_id' => $query->present_workstation_id,
                    'designation_id' => $query->present_designation_id,
                    'salary_scale_id' => $query->salary_scale_id,
                    'salary' => $query->salaryScale->salary,
                    'joining_date' => $query->joining_date,
                ]);

                DesignationWorkstation::where([['workstation_id', $query->present_workstation_id], ['designation_id', $query->present_designation_id]])->update([
                    'general_information_id' => $query->id,
                    'joining_date' => $query->joining_date
                ]);

                if (!empty($query->document) || $query->document != '') {
                    $query->offerLetters()->create([
                        'general_information_id' => $query->id,
                        'document_title' => DocumentTitleEnum::Offer_Letter->toString(),
                        'document' => $query->document
                    ]);
                }
            });
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
        $data['joiningTypes'] = JoiningType::get();
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

            if(Arr::has($data, 'document')){
                $data['document'] = (Arr::pull($data, 'document'))->store('offerLetters');
            }
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');

            $joiningDate = Carbon::parse($request->birth_date);
            $data['prl_date'] = $joiningDate->addYears(59)->subDay();

            $generalInformation = GeneralInformation::findOrFail($id);

            DesignationWorkstation::where([['workstation_id', $generalInformation->present_workstation_id], ['designation_id', $generalInformation->present_designation_id]])->update([
                'general_information_id' => null,
                'joining_date' => null
            ]);

            tap($generalInformation->update($data), function() use ($generalInformation, $data){
                $generalInformation->transferStatus()->update([
                    'present_joining_date' => $data['joining_date']
                ]);

                $transfer = $generalInformation->employeeTransfer()->first();

                $transfer->update([
                    'workstation_id' => $generalInformation->present_workstation_id,
                    'designation_id' => $generalInformation->present_designation_id,
                    'salary_scale_id' => $generalInformation->salary_scale_id,
                    'salary' => $generalInformation->salaryScale->salary,
                    'joining_date' => $generalInformation->joining_date,
                ]);

                DesignationWorkstation::where([['workstation_id', $data['present_workstation_id']], ['designation_id', $data['present_designation_id']]])->update([
                    'general_information_id' => $generalInformation->id,
                    'joining_date' => $data['joining_date']
                ]);

                if (!empty($data['document'])) {
                    $generalInformation->offerLetters()->create([
                        'general_information_id' => $generalInformation->id,
                        'document_title' => DocumentTitleEnum::Offer_Letter->toString(),
                        'document' => $data['document']
                    ]);
                }
            });
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        if ($request->ajax()) {
            $alldata= GeneralInformation::with(['joiningDesignation','presentDesignation','presentDesignation','mainDesignation', 'employeeTransfer', 'employeeTransfer.workstation'])
                            ->where('status', 1)
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('workstations', function($row){
                $workstations = '';
                if (!empty($row->employeeTransfer)) {
                    foreach ($row->employeeTransfer as $key => $workstation) {
                       $workstations .= $workstation->workstation->name . '<br>';
                    }
                    return $workstations;
                } else {
                    return '';
                }

            })
            ->escapeColumns([])
            ->addColumn('timePeriods', function($row){
                $timePeriods = '';
                $joinDate = '';
                $releaseDate = '';
                if (!empty($row->employeeTransfer)) {
                    foreach ($row->employeeTransfer as $key => $date) {
                        $joinDate = Carbon::parse($date->joining_date);
                        $releaseDate = Carbon::parse($date->release_date);
                        $timePeriods .= NumberToBangla::bnNum($joinDate->format('d')).'-'.
                                       NumberToBangla::bnNum($joinDate->format('m')).'-'.
                                       NumberToBangla::bnNum($joinDate->format('Y')).' / '.
                                       NumberToBangla::bnNum($releaseDate->format('d')).'-'.
                                       NumberToBangla::bnNum($releaseDate->format('m')).'-'.
                                       NumberToBangla::bnNum($releaseDate->format('Y')). '<br>';
                    }
                    return $timePeriods;
                } else {
                    return '';
                }

            })
            ->escapeColumns([])
            ->make(True);
        }
        return view ('employee.generalInformation.report');
    }

    /**
     * document page
     */
    public function document($id)
    {
        $data['generalInformation'] = GeneralInformation::findOrFail($id);
        $data['documents'] = DocumentHistory::where('general_information_id', $id)->get();
        return view('employee.generalInformation.document', $data);
    }
}
