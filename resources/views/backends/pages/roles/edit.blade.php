@extends("backends.layouts.master")

@push('style')

@endpush

@section('admin-title')
 Admin Title - Roles Edit
@endsection

@section("admin_header_area")
<div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Roles</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="index.html">Home</a></li>
        <li><span>Roles Edit</span></li>
    </ul>
</div>
@endsection
@inject('user_obj', 'App\Models\User')
@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Basic Role Edit ( {{ $role->name }} )</h4>
                    @include("backends.layouts.partials.notify")
                    <form action="{{ route("roles.update",['role'=>$role->id]) }}" method="POST">
                        @csrf
                        {{-- // method spoofing --}}
                        @method('PUT')
                        <div class="form-group">
                            <label for="roleName">Role name</label>
                            <input type="text" class="form-control" id="roleName" name="name" placeholder="Enter role name" value="{{ $role->name }}">
                        </div>

                        <div class="form-group">
                            <label for="roleName">Permissions</label>
                            @php
                                $allPermissionArray = $permissions->pluck('id')->toArray();
                                $roleWiseAllParm = \App\Models\User::roleWiseAllParm($role->id);

                                // dd(array_diff($allPermissionArray, $roleWiseAllParm->pluck('permission_id')->toArray() ));
                            @endphp

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="allPermission"
                                {{ array_diff($allPermissionArray, $roleWiseAllParm->pluck('permission_id')->toArray() ) != false ? '' : 'checked' }}
                                >
                                <label class="form-check-label" for="permissionName">
                                   ALL
                                </label>
                            </div>
                            <br>
                            @foreach ($permission_groups as $permission_group )
                                @php

                                    $grupNameWiseAllParm = $permissions->where('group_name',$permission_group->group_name)->pluck('id')->toArray();

                                    $hasRoleWiseGrupParm = $roleWiseAllParm->whereIn('permission_id',$grupNameWiseAllParm)->pluck('permission_id')->toArray();

                                @endphp
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">

                                            <input type="checkbox" class="form-check-input perGrpName"  data-gname="{{ $permission_group->group_name }}_checkbox" id="{{ $permission_group->group_name }}_checkbox"
                                            {{ array_diff($grupNameWiseAllParm,$hasRoleWiseGrupParm) != false ? '' : 'checked' }}
                                            >
                                            <label class="form-check-label" for="permGrpClsId">
                                                {{ $permission_group->group_name }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @foreach ($permissions->where('group_name',$permission_group->group_name) as $permission )
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input singPerName {{ $permission_group->group_name }}_checkbox"
                                                data-gname="{{ $permission_group->group_name }}_checkbox"
                                                id="permissionName" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} name="permissions[]" value="{{ $permission->name }}">

                                                <label class="form-check-label" for="permissionName">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <br>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Role name</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @include("backends.layouts.partials.role_creae_script")
@endpush
