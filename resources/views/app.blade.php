<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

    @include('layout.meta')

    @include('layout.style')

</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default">

    <!-- Begin page -->
    <div id="app-layout">

        <!-- Topbar Start -->
        <div class="topbar-custom">
            @include('layout.header')
        </div>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <div class="app-sidebar-menu">
            @include('layout.aside')

        </div>

        <div class="content-page">
            <!-- Start Content-->
            <div class="content">
                @yield('content')
            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                @include('layout.footer')
            </footer>
            <!-- end Footer -->

        </div>

    </div>
    <!-- END wrapper -->

    <div id="loadingOverlay">
        <div id="loading"></div>
    </div>

    @include('layout.script')

</body>

</html>
