
<!doctype html>
<html class="no.js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        @yield('admin-title','Admin Title Content')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include("backends.layouts.partials.style")
    @stack('style')
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include("backends.layouts.partials.sidebar")
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            @include("backends.layouts.partials.header")
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        @yield("admin_header_area")

                    </div>
                    <div class="col-sm-6 clearfix">
                        @include("backends.layouts.partials.logout")
                    </div>
                </div>
            </div>



            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    @yield('admin_content')

                </div>




            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
       @include('backends.layouts.partials.footer')
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    @include("backends.layouts.partials.offset-area")
    @include("backends.layouts.partials.script")
    @stack('script')
</body>

</html>
