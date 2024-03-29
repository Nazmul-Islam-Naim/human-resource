<?php

namespace App\Http\Controllers;

use App\Http\Requests\District\CreateRequest;
use App\Http\Requests\District\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\District;
use Illuminate\Support\Arr;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata']= District::where('status',1)->orderBy('id', 'DESC')->get();
        return view('catalogs.district', $data);
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
             District::create($request->all());
             Session::flash('flash_message','District Successfully Added !');
             return redirect()->route('district.index')->with('status_color','success');
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
        $data['single_data']= District::find($id);
        $data['alldata']= District::orderBy('id', 'DESC')->paginate(15);
        return view('catalogs.district', $data);
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
            District::where('id',$id)->update($data);
            Session::flash('flash_message','District Successfully Updated !');
            return redirect()->route('district.index')->with('status_color','danger');
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
            District::where('id',$id)->delete();
            Session::flash('flash_message','District Successfully Deleted !');
            return redirect()->route('district.index')->with('status_color','danger');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
