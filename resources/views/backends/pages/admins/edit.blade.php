@extends("backends.layouts.master")

@push('style')

@endpush

@section('admin-title')
 Admin Title - Admin Update
@endsection

@section("admin_header_area")
<div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Admin</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="index.html">Home</a></li>
        <li><span>Admin Update</span></li>
    </ul>
</div>
@endsection
@inject('admin_obj', 'App\Models\Admin')
@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Basic Role Update ( {{ $admin->name }} )</h4>
                    @include("backends.layouts.partials.notify")
                    <form action="{{ route('admins.update',['admin'=>$admin->id]) }}" method="POST">
                        @csrf
                        {{-- //method spoofing --}}
                        @method('PUT')
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" placeholder="Enter name">

                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter password">
                        </div>

                        <div class="form-group">
                            <label for="sltRole">Roles</label>
                            <select multiple class="form-control" id="sltRole" name="roles[]" value="">
                                @forelse ($roles as $role )
                                    <option value="{{ $role->id }}"
                                        {{ $admin->hasRole($role->name) ? 'selected' : '' }}
                                        >{{ $role->name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                          </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- @include("backends.layouts.partials.role_creae_script") --}}
@endpush
