@extends("backends.layouts.master")

@push('style')

@endpush

@section('admin-title')
 Admin Title - Roles Create
@endsection

@section("admin_header_area")
<div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Roles</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="index.html">Home</a></li>
        <li><span>Roles Create</span></li>
    </ul>
</div>
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Basic Role Create</h4>
                    @include("backends.layouts.partials.notify")
                    <form action="{{ route("roles.store") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="roleName">Role name</label>
                            <input type="text" class="form-control" id="roleName" name="name" placeholder="Enter role name">
                        </div>
                        <div class="form-group">
                            <label for="roleName">Permissions</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="allPermission"  >
                                <label class="form-check-label" for="permissionName">
                                   ALL
                                </label>
                            </div>
                            <br>
                            @foreach ($permissions as $permission )
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="permissionName" name="permissions[]" value="{{ $permission->name }}">
                                    <label class="form-check-label" for="permissionName">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Role name</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('change','#allPermission',function(){
           if($(this).prop('checked')){
            $("input[type=checkbox]").prop('checked',true);
           }else {
            $("input[type=checkbox]").prop('checked',false);
            }
        });
    </script>
@endpush
