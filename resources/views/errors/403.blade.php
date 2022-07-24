@extends("errors.layouts.master")

@section('error_content')
<h2>403</h2>
<p>{{ $exception->getMessage() }}</p>
<a href="{{ route("admin.dashboard") }}">Back to Dashboard</a>
<a href="{{ route("admin.login") }}">admin login</a>
@endsection
