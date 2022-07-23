<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();

        return view("backends.pages.admins.index",compact('admins'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $roles = Role::all();
        return view("backends.pages.users.create",compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validaton create
         $request->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users|string',
            'email' => 'required|unique:users|string',
            'password' => 'required|min:6',
            'roles' => 'required'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->name.rand(1,1000),
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        if($admin){
            if(count($request->roles)){
                //model_has_roles
                $admin->syncRoles($request->roles);
            }
            return redirect()->route('users.index')->with('success','Admin Created Sucessfully');
        }


    }


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
        $admin = Admin::find($id);
        $roles = Role::all();
        return view("backends.pages.admins.edit",compact('roles','admin'));
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
        //validaton create

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,'.$id,
        ]);

        $admin =  Admin::find($id);
        $admin->name = $request->name;
        if(empty($admin->username)){
            $admin->username = $request->name.rand(1,1000);
        }
        $admin->email = $request->email;
        if(!empty($request->password)){
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        if(count($request->roles) > 0){
            // old role deleted successfully
            $admin->roles()->detach();
            // model has role
            $admin->assignRole($request->roles);
        }

        return redirect()->route('admins.index')->with('success','Admin Update Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->roles()->detach() && $user->delete()){
            return redirect()->back()->with('success','User Deleted successfuly');
        }
    }
}
