<!DOCTYPE html>
<html lang="fa">

<head>
    @include('site.layouts.blogs.layouts.head-tag')
    @yield('head-tag')
</head>

<body class="bg-light style-default style-rounded">

    <!-- Preloader -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
        </div>
    </div>

    <!-- Bg Overlay -->
    <div class="content-overlay"></div>
    @include('site.layouts.blogs.layouts.header')
    <main class="main oh" id="main">
        @include('site.layouts.blogs.layouts.nav')
        @yield('content')
    </main>
    <!--
    Essential Scripts
    =====================================-->
    <!-- Main jQuery -->
    @include('site.layouts.blogs.layouts.script')
    @yield('script')
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.swal-warning')
</body>

</html>
