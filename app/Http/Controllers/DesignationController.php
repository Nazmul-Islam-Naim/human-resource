<?php

namespace App\Http\Controllers;

use App\Http\Requests\Designation\CreateRequest;
use App\Http\Requests\Designation\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use App\Models\Designation;
use Validator;
use Response;
use Session;
use Auth;
use Str;
use DB;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('app.designations.index');
        $data['alldata']= Designation::all();
        return view('user.designation', $data);
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
        // Gate::authorize('app.designations.create');
        try{
            Designation::create($request->all());
            Session::flash('flash_message','Designation Successfully Added !');
            return redirect()->route('designation.index')->with('status_color','success');
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
        // Gate::authorize('app.designations.edit');
        $data['single_data']= Designation::find($id);
        $data['alldata']= Designation::all();
        return view('user.designation', $data);
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
        // Gate::authorize('app.designations.edit');   
        try{
            $data = $request->all();
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            Designation::where('id',$id)->update($data); 
            Session::flash('flash_message','Designation Successfully Updated !');
            return redirect()->route('designation.index')->with('status_color','warning');
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
        // Gate::authorize('app.designations.destroy');
        try{
            Designation::where('id',$id)->delete(); 
            Session::flash('flash_message','Designation Successfully Deleted !');
            return redirect()->route('designation.index')->with('status_color','danger');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}

