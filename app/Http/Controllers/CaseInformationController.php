<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaseInformation\CreateRequest;
use App\Http\Requests\CaseInformation\UpdateRequest;
use App\Models\CaseInformation;
use App\Models\GeneralInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CaseInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alldata= CaseInformation::with(['generalInformation','generalInformation.presentDesignation','generalInformation.presentWorkstation'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('caseInformations.edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-edit1"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

<?php return ob_get_clean();
            })->make(True);
        }
        return view ('employee.caseInformation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['generalInformations'] = GeneralInformation::all();
        return view('employee.caseInformation.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $employee = GeneralInformation::findOrFail($request->general_information_id);
        try {
            foreach ($request->addmore as $data) {
                if(Arr::has($data, 'document')){
                    $data['document'] = (Arr::pull($data, 'document'))->store('case-documents');
                }
                $employee->caseInformation()->create($data);
            }
            Session::flash('flash_message','Information Successfully Added !');
            return redirect()->route('caseInformations-report')->with('status_color','success');
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
        $data['caseInformation'] = CaseInformation::findOrFail($id);
        return view('employee.caseInformation.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    { 
        $data['generalInformations'] = GeneralInformation::all();
        $data['caseInformation'] = CaseInformation::findOrFail($id);
        return view('employee.caseInformation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            if(Arr::has($data, 'document')){
                $data['document'] = (Arr::pull($data, 'document'))->store('case-documents');
            }
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            $name = Arr::pull($data, 'name_in_bangla');
            CaseInformation::where('id',$id)->update($data);
            Session::flash('flash_message','Information Successfully Updated !');
            return redirect()->route('caseInformations.index')->with('status_color','success');
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
            CaseInformation::where('id',$id)->delete($id);
            Session::flash('flash_message','Record Successfully Deleted.');
            return redirect()->route('caseInformations.index')->with('status_color','success');
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
                'caseInformationFirst',
                'presentDesignation',
                'presentWorkstation'
            ])
            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()->make(True);
        }
        return view ('employee.caseInformation.report');
    }
}
