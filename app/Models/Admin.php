<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPermissionGroups(){
        $getpermission_group = DB::table('permissions')
        ->select(DB::raw('group_name'))
        ->groupBy('group_name')
        ->get();
        return $getpermission_group;
    }

    public static function roleWiseAllParm($role_id){
        $roleWiseAllParm =  DB::table('role_has_permissions')
                        ->where('role_id',$role_id)
                        ->get();
        return $roleWiseAllParm;
    }

    public static function roleHasPermissions($role, $permissions){
        $hsePermission = true;

        foreach($permissions as $permission){

            if($role->hasPermissionTo($permission->name)){
                $hsePermission = false;
                return $hsePermission;
            }
        }
        return $hsePermission;
    }


}
