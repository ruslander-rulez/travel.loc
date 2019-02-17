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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/dashboard/global/plugins/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{asset("/dashboard/global/plugins/simple-line-icons/simple-line-icons.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/dashboard/global/plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/dashboard/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset("/dashboard/global/plugins/select2/css/select2.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/dashboard/global/plugins/select2/css/select2-bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset("/dashboard/global/css/components-md.min.css") }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset("/dashboard/global/css/plugins-md.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset("/dashboard/pages/css/login-4.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    @yield("styles")
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<body class="@yield("body-class")">
@yield("content")
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> {{ date("Y") }} &copy; Metronic - Admin Dashboard Template. </div>
<!-- END COPYRIGHT -->
<!--[if lt IE 9]>
<script src="{{ asset("/dashboard/global/plugins/respond.min.js") }}"></script>
<script src="{{ asset("/dashboard/global/plugins/excanvas.min.js") }}"></script>
<script src="{{ asset("/dashboard/global/plugins/ie8.fix.min.js") }}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset("/dashboard/global/plugins/jquery.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/dashboard/global/plugins/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/dashboard/global/plugins/js.cookie.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/dashboard/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/dashboard/global/plugins/jquery.blockui.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/dashboard/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset("/dashboard/global/plugins/jquery-validation/js/jquery.validate.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/dashboard/global/plugins/jquery-validation/js/additional-methods.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/dashboard/global/plugins/select2/js/select2.full.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/dashboard/global/plugins/backstretch/jquery.backstretch.min.js") }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset(("/dashboard/global/scripts/app.min.js")) }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset("/dashboard/pages/scripts/login-4.min.js") }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>