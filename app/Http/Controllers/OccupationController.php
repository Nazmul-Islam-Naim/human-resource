<?php

namespace App\Http\Controllers;

use App\Http\Requests\Occupation\CreateRequest;
use App\Http\Requests\Occupation\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Occupation;
use Illuminate\Support\Arr;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata']= Occupation::where('status',1)->orderBy('id', 'DESC')->get();
        return view('catalogs.occupation', $data);
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
            Occupation::create($request->all());
            Session::flash('flash_message','Occupation Successfully Added !');
            return redirect()->route('occupation.index')->with('status_color','success');
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
        $data['single_data']= Occupation::find($id);
        $data['alldata']= Occupation::orderBy('id', 'DESC')->paginate(15);
        return view('catalogs.occupation', $data);
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
            Occupation::where('id',$id)->update($data); 
            Session::flash('flash_message','Occupation Successfully Updated !');
            return redirect()->route('occupation.index')->with('status_color','warning');
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
            Occupation::where('id',$id)->delete(); 
            Session::flash('flash_message','Occupation Successfully Deleted !');
            return redirect()->route('occupation.index')->with('status_color','danger');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
