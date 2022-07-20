<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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
    public function create()
    {
        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroups();
        // return $permission_groups;
        // dd($permissions);
        return view("backends.pages.Users.create",compact('permissions','permission_groups'));
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
            'name' => 'required|unique:Users'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);
        $permissions = $request->permissions;
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        return back()->with('success','Role Created Sucessfully');
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
        $role = Role::findById($id);

        // dd($Users_permissions);
        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroups();
        return view("backends.pages.Users.edit",compact('permissions','permission_groups','role'));
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
            'name' => 'required|unique:Users,name,'.$id
        ]);

        $role = Role::findById($id);
        $permissions = $request->permissions;

        if( $role && $role->update(['name'=>$request->name])){
            if(!empty($permissions)){
                $role->syncPermissions($permissions);
            }
            return back()->with('success','Role Permission update Sucessfully');
        }
        return back()->with('error','Role Permission fail to update');

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
