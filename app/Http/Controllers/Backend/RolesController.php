<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public $user;

    public function __construct(){
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('role.view') ){
            abort(403, 'Unauthonticated Access');
        }
        $roles = Role::all();
        return view("backends.pages.roles.index",compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(is_null($this->user) || !$this->user->can('role.create') ){
            abort(403, 'Unauthonticated Access');
        }

        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroups();
        // return $permission_groups;
        // dd($permissions);
        return view("backends.pages.roles.create",compact('permissions','permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('role.store') ){
            abort(403, 'Unauthonticated Access');
        }
         //validaton create
         $request->validate([
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name'=>'admin'
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
        if(is_null($this->user) || !$this->user->can('role.edit') ){
            abort(403, 'Unauthonticated Access');
        }
        $role = static::findByIdGardName($id, 'admin');

        // dd($roles_permissions);
        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroups();
        return view("backends.pages.roles.edit",compact('permissions','permission_groups','role'));
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

        if(is_null($this->user) || !$this->user->can('role.update') ){
            abort(403, 'Unauthonticated Access');
        }
        //validaton create
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id
        ]);

        $role = static::findByIdGardName($id, 'admin');
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
        if(is_null($this->user) || !$this->user->can('role.delete') ){
            abort(403, 'Unauthonticated Access');
        }

        $role = static::findByIdGardName($id, 'admin');
        if($role->delete()){
            return redirect()->back()->with('success','Role Deleted successfuly');
        }
    }

    public static function findByIdGardName($id ,$guardName){
        if(empty($guardName)){
            return $role = Role::findById($id,'admin');
        }
        return $role = Role::findById($id,$guardName);
    }
}
