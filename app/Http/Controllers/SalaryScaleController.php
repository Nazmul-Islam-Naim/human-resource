<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryScale\CreateRequest;
use App\Http\Requests\SalaryScale\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\SalaryScale;
use Illuminate\Support\Arr;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class SalaryScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata']= SalaryScale::orderBy('id', 'DESC')->get();
        return view('catalogs.salaryScale', $data);
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
            SalaryScale::create($request->all());
            Session::flash('flash_message','Grade Successfully Added !');
            return redirect()->route('salary-scale.index')->with('status_color','success');
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
        $data['single_data']= SalaryScale::find($id);
        $data['alldata']= SalaryScale::orderBy('id', 'DESC')->paginate(15);
        return view('catalogs.salaryScale', $data);
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
            $method = Arr::pull($data, '_method');
            $token = Arr::pull($data, '_token');
            SalaryScale::where('id',$id)->update($data); 
            Session::flash('flash_message','Grade Successfully Updated !');
            return redirect()->route('salary-scale.index')->with('status_color','warning');
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
        try{
            SalaryScale::where('id',$id)->delete(); 
            Session::flash('flash_message','Grade Successfully Deleted !');
            return redirect()->route('salary-scale.index')->with('status_color','warning');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
