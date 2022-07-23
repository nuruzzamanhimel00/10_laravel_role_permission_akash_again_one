@extends("backends.layouts.master")

@push('style')

@endpush

@section('admin-title')
 Admin Title - Admin Create
@endsection

@section("admin_header_area")
<div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Admin</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="index.html">Home</a></li>
        <li><span>Admin Create</span></li>
    </ul>
</div>
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Basic Admin Create</h4>
                    @include("backends.layouts.partials.notify")
                    <form action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">

                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter password">
                        </div>

                        <div class="form-group">
                            <label for="sltRole">Roles</label>
                            <select multiple class="form-control" id="sltRole" name="roles[]" value="{{ old('roles') }}">
                                @forelse ($roles as $role )
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @empty
                                @endforelse
                            </select>
                          </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- @include("backends.layouts.partials.role_creae_script") --}}
@endpush
