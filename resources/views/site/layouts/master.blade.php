<!doctype html>
<html lang="en">

<head>
    @include('site.layouts.head-tag')
    @yield('head-tag')
</head>

<body id="top" dir="rtl">

    <main>
        <!-- nav -->
        @include('site.layouts.header')
        <!-- hero -->
        @yield('content')
    </main>

    <!-- footer -->
    @include('site.layouts.footer')


    <!-- script -->
    @include('site.layouts.script')
    @yield('script')
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.swal-warning')
</body>

</html>
