<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\CreateRequest;
use App\Http\Requests\Department\UpdateRequest;
use App\Models\Department;
use Illuminate\Support\Arr;
use Session;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata']= Department::where('status',1)->orderBy('id', 'DESC')->get();
        return view('catalogs.departmant', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try{
           Department::create($request->all());
           Session::flash('flash_message','Department Successfully Added !');
           return redirect()->route('department.index')->with('status_color','success');
        }catch(\Exception $e){
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['single_data']= Department::find($id);
        $data['alldata']= Department::orderBy('id', 'DESC')->paginate(15);
        return view('catalogs.departmant', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $data = $request->all();
            $token = Arr::pull($data, '_token');
            $method = Arr::pull($data, '_method');
            Department::where('id',$id)->update($data);
            Session::flash('flash_message','Department Successfully Updated !');
            return redirect()->route('department.index')->with('status_color','warning');
        }catch(\Exception $e){
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
        try {
            Department::where('id', $id)->delete();
            Session::flash('flash_message','Department Successfully Delete !');
            return redirect()->route('department.index')->with('status_color','warning');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
