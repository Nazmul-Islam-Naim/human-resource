<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationInformation\CreateRequest;
use App\Http\Requests\PublicationInformation\UpdateRequest;
use App\Models\GeneralInformation;
use App\Models\Publication;
use App\Models\PublicationInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class PublicationInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alldata= PublicationInformation::with(['generalInformation','generalInformation.presentDesignation','generalInformation.presentWorkstation','publication'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('publicationInformations.edit',$row->id); ?>" class="badge bg-info badge-sm" data-id="<?php echo $row->id; ?>" title="Edit"><i class="icon-edit1"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

                <?php return ob_get_clean();
            })->make(True);
        }
        return view ('employee.publicationInformation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['generalInformations'] = GeneralInformation::all();
        $data['publications'] = Publication::all();
        return view('employee.publicationInformation.create',$data);
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
                    $data['document'] = (Arr::pull($data, 'document'))->store('publication-documents');
                }
                $employee->publicationInformation()->create($data);
            }
            Session::flash('flash_message','Information Successfully Added !');
            return redirect()->route('publicationInformations-report')->with('status_color','success');
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
        $data['publicationInformation'] = PublicationInformation::findOrFail($id);
        return view('employee.publicationInformation.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    { 
        $data['generalInformations'] = GeneralInformation::all();
        $data['publications'] = Publication::all();
        $data['publicationInformation'] = PublicationInformation::findOrFail($id);
        return view('employee.publicationInformation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            if(Arr::has($data, 'document')){
                $data['document'] = (Arr::pull($data, 'document'))->store('publication-documents');
            }
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            $name = Arr::pull($data, 'name_in_bangla');
            PublicationInformation::where('id',$id)->update($data);
            Session::flash('flash_message','Information Successfully Updated !');
            return redirect()->route('publicationInformations.index')->with('status_color','success');
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
            PublicationInformation::where('id',$id)->delete($id);
            Session::flash('flash_message','Record Successfully Deleted.');
            return redirect()->route('publicationInformations.index')->with('status_color','success');
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
                'publicationInformationFirst',
                'presentDesignation',
                'presentWorkstation',
                'publicationInformationFirst.publication'])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()->make(True);
        }
        return view ('employee.publicationInformation.report');
    }
}
