<!doctype html>
<html dir="rtl" lang="fa">

<head>
    @include('admin.layouts.head-tag')
    @yield('head-tag')
</head>

<body class="theme-blush">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="{{asset('admin-assets/assets/images/loader.svg')}}" width="48" height="48"
                    alt="Aero"></div>
            <p>لطفا صبر کنید...</p>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Left Sidebar -->
    @include('admin.layouts.left-sidebar')

    <!-- Right Sidebar -->
    @include('admin.layouts.right-sidebar')
    <!-- Main Content -->

    <section class="content">
        <div class="">
            <div class="block-header">
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                        class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </section>


    <!-- Jquery Core Js -->
    @include('admin.layouts.script')
    @yield('script')
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.swal-warning')
</body>

<!-- Mirrored from idehro.ir/aero/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Aug 2022 07:24:36 GMT -->

</html>
