<!DOCTYPE html>
<html lang="{{ "en" }}">

@include("web.Layout.partials.head")

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

    @include("web.Layout.partials.navbar")
    @include("web.Layout.partials.sidebar")
    <div class="content-wrapper">

        @yield("content")
    </div>

    @include("web.Layout.partials.footer")

</div>
@include("web.Layout.partials.foot")
</body>
</html>
