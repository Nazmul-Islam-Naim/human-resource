<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionInformation\CreateRequest;
use App\Http\Requests\PromotionInformation\UpdateRequest;
use App\Models\Designation;
use App\Models\GeneralInformation;
use App\Models\PromotionInformation;
use App\Models\SalaryScale;
use App\Models\Workstation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class PromotionInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alldata= PromotionInformation::with(['generalInformation','generalInformation.presentDesignation','generalInformation.presentWorkstation','promotionDesignation','salaryScale'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('promotionInformations.edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-edit1"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

                <?php return ob_get_clean();
            })->make(True);
        }
        return view ('employee.promotionInformation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['generalInformations'] = GeneralInformation::where('status',1)->get();
        $data['promotionDesignations'] = Designation::all();
        $data['promotionWorkstations'] = Workstation::all();
        $data['salaryScales'] = SalaryScale::all();
        return view('employee.promotionInformation.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $employee = GeneralInformation::findOrFail($request->general_information_id);
        try {
            $employee->promotionInformation()->create($request->all());
            $employee->update(['main_designation_id'=>$request->designation_id]);
            Session::flash('flash_message','Information Successfully Added !');
            return redirect()->route('promotionInformations-report')->with('status_color','success');
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
        $data['promotionInformation'] = PromotionInformation::findOrFail($id);
        return view('employee.promotionInformation.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    { 
        $data['generalInformations'] = GeneralInformation::all();
        $data['promotionDesignations'] = Designation::all();
        $data['promotionWorkstations'] = Workstation::all();
        $data['salaryScales'] = SalaryScale::all();
        $data['promotionInformation'] = PromotionInformation::findOrFail($id);
        return view('employee.promotionInformation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            $name = Arr::pull($data, 'name_in_bangla');
            $employee = PromotionInformation::where('id',$id)->first();
            $employee->update($data);
            $employee->generalInformation()->update(['main_designation_id'=>$request->designation_id]);
            Session::flash('flash_message','Information Successfully Updated !');
            return redirect()->route('promotionInformations.index')->with('status_color','success');
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
            $employee = PromotionInformation::findOrFail($id);
            $employee->delete();
            $lastDesigantion = PromotionInformation::where('general_information_id',$employee->general_information_id)->orderBy('id','desc')->first();
            $employee->generalInformation()->update(['main_designation_id' => $lastDesigantion->designation_id]);
            Session::flash('flash_message','Record Successfully Deleted.');
            return redirect()->route('promotionInformations.index')->with('status_color','success');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function report(Request $request)
    {
        if ($request->ajax()) {
            $alldata= GeneralInformation::with([
                'promotionInformationFirst',
                'presentDesignation',
                'presentWorkstation',
                'promotionInformationFirst.promotionDesignation',
                'promotionInformationFirst.salaryScale'
            ])
            ->where('status',1)
            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()->make(True);
        }
        return view ('employee.promotionInformation.report');
    }

    /**
     * Display a listing of the resource.
     */
    public function promotion(Request $request)
    {
        $designations = Designation::all();
        if ($request->ajax()) {
            if ($request->designation_id != '') {
                $alldata= GeneralInformation::with([
                    'promotionInformationFirst',
                    'presentDesignation',
                    'presentWorkstation',
                    'district',
                    'promotionInformationFirst.promotionDesignation',
                    'promotionInformationFirst.promotionWorkstation',
                ])
                ->where('status',1)
                ->whereHas('promotionInformationFirst', function($query) use($request){
                    $query->where('designation_id', $request->designation_id);
                })
                ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            } else {
                $alldata= GeneralInformation::with([
                    'promotionInformationFirst',
                    'presentDesignation',
                    'presentWorkstation',
                    'district',
                    'promotionInformationFirst.promotionDesignation',
                    'promotionInformationFirst.promotionWorkstation',
                ])
                ->where('status',1)
                ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            }
        }
        return view ('employee.promotionInformation.promotion', compact('designations'));
    }
}
