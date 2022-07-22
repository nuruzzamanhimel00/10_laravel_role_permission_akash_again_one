<div class="user-profile pull-right">
    <img class="avatar user-thumb" src="{{ asset('backend/assets/images/author/avatar.png') }} " alt="avatar">
    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
        {{ Auth::guard('admin')->user()->name }}
        <i class="fa fa-angle-down"></i></h4>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Message</a>
        <a class="dropdown-item" href="#">Settings</a>
        <a class="dropdown-item" href="#">Log Out</a>
    </div> &nbsp; &nbsp;
    <button class="btn btn-danger"
    onclick="
    event.preventDefault();
    document.getElementById('adminLogoutId').submit();
    "
    >
        logout
    </button>
    <form action="{{ route('admin.logout.submit') }}" id="adminLogoutId" method="POST">
        @csrf
    </form>
</div>
