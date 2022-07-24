@extends("errors.layouts.master")

@section('error_title','500 Internal Server Error')

@section('error_content')
<h2>500</h2>
<p>{{ $exception->getMessage() }}</p>
<a href="{{ route("admin.dashboard") }}">Back to Dashboard</a>
<a href="{{ route("admin.login") }}">admin login</a>
@endsection
