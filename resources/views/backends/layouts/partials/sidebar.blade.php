<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('backend/assets/images/icon/logo.png') }} " alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is("admin.dashboard") ? "active" : '' }}"><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Roles
                            </span></a>
                        <ul class="
                        {{
                        Route::is("roles.index") || Route::is("roles.edit") || Route::is("roles.create") ? 'in' : ''
                        }}
                        collapse">
                            <li class="{{ Route::is("admin.index") ? "active" : '' }}"><a href="{{ route('roles.index') }}">Roles List</a></li>
                            <li class="{{ Route::is("admin.create") ? "active" : '' }}"><a href="{{ route("roles.create") }}">Role Create</a></li>
                        </ul>
                    </li>


                </ul>
            </nav>
        </div>
    </div>
</div>
