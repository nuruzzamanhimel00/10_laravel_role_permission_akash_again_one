<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view("backends.pages.users.index",compact('users'));

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
            'email' => 'required|unique:users|string',
            'password' => 'required|min:6',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        if($user){
            if(count($request->roles)){
                $user->syncRoles($request->roles);
            }
            return redirect()->route('users.index')->with('success','User Created Sucessfully');
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
        $user = User::find($id);
        $roles = Role::all();
        return view("backends.pages.users.edit",compact('roles','user'));
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
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user =  User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if(count($request->roles) > 0){
            // old role deleted successfully
            $user->roles()->detach();
            $user->assignRole($request->roles);
        }

        return redirect()->route('users.index')->with('success','User Update Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $role = Role::findById($id);
        if($role->delete()){
            return redirect()->back()->with('success','Role Deleted successfuly');
        }
    }
}
