@extends("backends.layouts.master")

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endpush

@section('admin-title')
 Admin Title - Users
@endsection

@section("admin_header_area")
<div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Users</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="index.html">Home</a></li>
        <li><span>Users List</span></li>
    </ul>
</div>
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
           <h1>This is Users</h1>
           <div class="card">
            <div class="card-body">
                <h4 class="header-title">User List</h4>
                @include("backends.layouts.partials.notify")
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th width="30%">Role Nmae</th>
                                <th>action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                   {{ $user->email }}
                                </td>
                                <td>
                                    @foreach($user->getRoleNames() as $name)
                                    <span class="badge badge-success" style="font-size: 14px;">
                                        {{ $name }}
                                    </span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('users.edit',['user'=>$user->id]) }}" class="btn btn-success btn-sm">Edit</a>


                                    <a href="{{ route('users.destroy',['user'=>$user->id]) }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('userDestry_{{ $user->id }}').submit();"
                                        class="btn btn-danger btn-sm">Delete</a>

                                    <form  action="{{ route('users.destroy',['user'=>$user->id]) }}" method="POST" class="d-none" id="userDestry_{{ $user->id }}">
                                        @csrf
                                        {{-- // method spoofing --}}
                                        @method("DELETE")
                                    </form>

                                    {{-- <a href="{{ route('Users.destroy',['role'=>$role->id]) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
          /*================================
    datatable active
    ==================================*/
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            responsive: true
        });
    }

    </script>
@endpush
