<?php

namespace App\Http\Controllers;


use App\Models\Designation;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Validator;
use Response;
use Session;
use Auth;
use Hash;
use DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Gate::authorize('app.users.index');
        if ($request->ajax()) {
            $alldata= User::with(['designation','role'])
                            ->where('role_id','!=',1)
                            ->where('role_id','!=',2)
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>
                
                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('user-list.edit', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-edit-3"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Gate::authorize('app.users.create');
        $data['roles']= Role::select('id','title')->get();
        $data['designations']= Designation::select('id','title')->get();
        return view('user.add-user', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Gate::authorize('app.users.create');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'nullable|email|unique:users',
            'phone' => 'required|max:15|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'designation_id' => 'required',
            'avatar' => 'nullable|image',
            'nid' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('user-avatar');
        }

        if(Arr::has($data, 'nid')){
            $data['nid'] = (Arr::pull($data, 'nid'));
            $data['nid'] = (Arr::pull($data, 'nid'))->store('user-nid');
        }

        try{
            User::create($data);
            Session::flash('flash_message','User Successfully Added !');
            return redirect()->route('user-list.index')->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Faild to create user!');
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
        
        $user = User::findOrFail($id);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Gate::authorize('app.users.edit');
        $roles= Role::select('id','title')->get();
        $designations= Designation::select('id','title')->get();
        $single_data=User::findOrFail($id);
        return view('user.add-user', ['roles' => $roles, 'designations' => $designations, 'single_data' =>$single_data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Gate::authorize('app.users.edit');
        $user=User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => ['nullable', 'email', Rule::unique(User::class)->ignore($id)],
            'phone' => ['required', 'max:15', Rule::unique(User::class)->ignore($id)],
            'role_id' => 'required',
            'designation_id' => 'required',
            'avatar' => 'nullable|image',
            'nid' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }
        
        $data = $request->all();

        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('user-avatar');
        }

        if(Arr::has($data, 'nid')){
            $data['nid'] = (Arr::pull($data, 'nid'));
            $data['nid'] = (Arr::pull($data, 'nid'))->store('user-nid');
        }
            
        if ($request->password !="") {
            $data['password'] = Hash::make($request->password);
            $data['password_hint'] = $request->password;
        }else{
            $data['password'] = $user->password;
        }

        try{
            $user->update($data);
            Session::flash('flash_message','Data Successfully Updated !');
            return redirect()->route('user-list.index')->with('status_color','warning');
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
    public function destroy(User $user)
    {
        // Gate::authorize('app.users.delete');
        $user->delete();
        Session::flash('flash_message','User Successfully Updated !');
        return redirect()->back()->with('status_color','warning');
    }

}
