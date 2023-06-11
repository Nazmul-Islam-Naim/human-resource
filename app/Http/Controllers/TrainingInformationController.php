<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingInformation\CreateRequest;
use App\Http\Requests\TrainingInformation\UpdateRequest;
use App\Models\Course;
use App\Models\GeneralInformation;
use App\Models\Institute;
use App\Models\TrainingInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class TrainingInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alldata= TrainingInformation::with(['generalInformation','generalInformation.presentDesignation','generalInformation.presentWorkstation','course','institute'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('trainingInformations.edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-edit1"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

<?php return ob_get_clean();
            })->make(True);
        }
        return view ('employee.trainingInformation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['generalInformations'] = GeneralInformation::all();
        $data['courses'] = Course::all();
        $data['institutes'] = Institute::all();
        return view('employee.trainingInformation.create',$data);
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
                    $data['document'] = (Arr::pull($data, 'document'))->store('training-documents');
                }
                $employee->trainingInformation()->create($data);
            }
            Session::flash('flash_message','Information Successfully Added !');
            return redirect()->route('trainingInformations.index')->with('status_color','success');
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
        $data['trainingInformation'] = TrainingInformation::findOrFail($id);
        return view('employee.trainingInformation.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    { 
        $data['generalInformations'] = GeneralInformation::all();
        $data['courses'] = Course::all();
        $data['institutes'] = Institute::all();
        $data['trainingInformation'] = TrainingInformation::findOrFail($id);
        return view('employee.trainingInformation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            if(Arr::has($data, 'document')){
                $data['document'] = (Arr::pull($data, 'document'))->store('training-documents');
            }
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            $name = Arr::pull($data, 'name_in_bangla');
            TrainingInformation::where('id',$id)->update($data);
            Session::flash('flash_message','Information Successfully Updated !');
            return redirect()->route('trainingInformations.index')->with('status_color','success');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
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
            TrainingInformation::where('id',$id)->delete($id);
            Session::flash('flash_message','Record Successfully Deleted.');
            return redirect()->route('trainingInformations.index')->with('status_color','success');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
