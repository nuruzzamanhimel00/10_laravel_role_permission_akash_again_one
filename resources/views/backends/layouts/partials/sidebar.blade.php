<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('backend/assets/images/icon/logo.png') }} " alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                @php
                    $auth = Auth::guard('admin')->user();
                @endphp
                <ul class="metismenu" id="menu">
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is("admin.dashboard") ? "active" : '' }}"><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
                        </ul>
                    </li>
                    @if($auth->can('role.view') || $auth->can('role.create'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Roles
                            </span></a>
                        <ul class="
                        {{
                        Route::is("roles.index") || Route::is("roles.edit") || Route::is("roles.create") ? 'in' : ''
                        }}
                        collapse">
                            @if($auth->can('role.view'))
                                <li class="{{ Route::is("admin.index") ? "active" : '' }}"><a href="{{ route('roles.index') }}">Roles List</a></li>
                            @endif
                            @if($auth->can('role.create'))
                                <li class="{{ Route::is("admin.create") ? "active" : '' }}"><a href="{{ route("roles.create") }}">Role Create</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if($auth->can('admin.view') || $auth->can('admin.create'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Admin
                            </span></a>
                        <ul class="
                        {{
                        Route::is("admins.index") || Route::is("admins.edit") || Route::is("admins.create") ? 'in' : ''
                        }}
                        collapse">
                        @if($auth->can('admin.view'))
                            <li class="{{ Route::is("admins.index") ? "active" : '' }}"><a href="{{ route('admins.index') }}">admins List</a></li>
                        @endif
                        @if($auth->can('admin.create'))
                            <li class="{{ Route::is("admins.create") ? "active" : '' }}"><a href="{{ route("admins.create") }}">Admin Create</a></li>
                        @endif
                        </ul>
                    </li>
                    @endif


                </ul>
            </nav>
        </div>
    </div>
</div>
