@extends("backends.layouts.master")

@section('admin-title')
 Admin Title - Dashboard
@endsection

@section("admin_header_area")
<div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Dashboard</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="index.html">Home</a></li>
        <li><span>Dashboard</span></li>
    </ul>
</div>
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
           <h1>This is Dashboard</h1>
        </div>
    </div>
@endsection
