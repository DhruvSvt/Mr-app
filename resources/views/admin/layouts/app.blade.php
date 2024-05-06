<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

@include('admin.inc.headerLinks')
@yield('style')
</head>

<body class="text-left">

    <!-- Pre Loader Strat  -->
    <div class='loadscreen' id="preloader">
        <div class="loader spinner-bubble spinner-bubble-primary">
        </div>
    </div>
    <!-- Pre Loader end  -->

    <!-- ============ Compact Layout start ============= -->

    <!-- ============Deafult  Large SIdebar Layout start ============= -->
    <div class="app-admin-wrap layout-sidebar-large clearfix">
        @include('admin.inc.header')
        <!-- header top menu end -->

        @include('admin.inc.sidebar')

        <!--=============== Left side End ================-->

        @yield('section')

    </div>
    <!--=============== End app-admin-wrap ================-->

    <!-- ============ Large Sidebar Layout End ============= -->

    @include('admin.inc.footerLinks')
    @yield('script')

</body>

</html>
