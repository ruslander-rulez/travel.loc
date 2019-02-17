<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>@yield("title")</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for blank page layout" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

    <link href="{{ asset("dashboard/global/plugins/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("dashboard/global/plugins/simple-line-icons/simple-line-icons.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("dashboard/global/plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("dashboard/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    @yield("plugin-styles")
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset("dashboard/global/css/components-md.min.css") }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset("dashboard/global/css/plugins-md.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset("dashboard/layouts/layout/css/layout.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("dashboard/layouts/layout/css/themes/darkblue.min.css") }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset("dashboard/layouts/layout/css/custom.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    @yield("styles")
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    @include("dashboard.Layout.header")
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
      @include("dashboard.Layout.sidebar")
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN THEME PANEL -->
              {{--  @include("dashboard.Layout.theme-panel")--}}
                <!-- END THEME PANEL -->
                <!-- BEGIN PAGE BAR -->
                @yield("page-bar")
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                @yield("page-title")
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                @yield("page-body")
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        {{--@include("dashboard.Layout.quick-sidebar")--}}
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> {{ date("Y") }} &copy; <a href="http://keenthemes.com/preview/metronic/theme/admin_1_material_design/page_general_search_3.html">
                Magnifiers Admin Panel
            </a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->
{{--@include("dashboard.Layout.quick-nav")--}}
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="{{ asset('dashboard/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('dashboard/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('dashboard/global/plugins/ie8.fix.min.js')}}"></script>
<![endif]-->
<script src="{{ asset("js/laroute.js") }}" type="text/javascript"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset("dashboard/global/plugins/jquery.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("dashboard/global/plugins/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("dashboard/global/plugins/js.cookie.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("dashboard/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("dashboard/global/plugins/jquery.blockui.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("dashboard/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset("dashboard/global/scripts/app.min.js") }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset("dashboard/layouts/layout/scripts/layout.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("dashboard/layouts/layout/scripts/demo.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("dashboard/layouts/global/scripts/quick-sidebar.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("dashboard/layouts/global/scripts/quick-nav.min.js") }}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
@yield("scripts")

</body>

</html>