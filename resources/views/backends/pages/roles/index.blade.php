@extends("backends.layouts.master")

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endpush

@section('admin-title')
 Admin Title - Roles
@endsection

@section("admin_header_area")
<div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Roles</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="index.html">Home</a></li>
        <li><span>Roles List</span></li>
    </ul>
</div>
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
           <h1>This is Roles</h1>
           <div class="card">
            <div class="card-body">
                <h4 class="header-title">Role List</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $key => $role)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    action
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
