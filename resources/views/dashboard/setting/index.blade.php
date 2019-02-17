@extends("dashboard.Layout.main")

@section("page-bar")
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route("root.index") }}">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Настройки
            </li>
        </ul>
        {{--        <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="#">
                                    <i class="icon-bell"></i> Action</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-shield"></i> Another action</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-user"></i> Something else here</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="#">
                                    <i class="icon-bag"></i> Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>--}}
    </div>
@endsection

@section("plugin-styles")
    <link href="{{ asset("/dashboard/global/plugins/datatables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/dashboard/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section("page-title")
    <h1 class="page-title">
        Настройки
    </h1>
@endsection

@section("page-body")

    <div  id="settings-table-vue">
        <settings-table></settings-table>
    </div>

@endsection

@section("scripts")
    <script src="{{ asset("/js/settings.js") }}">
    </script>
    <script>
        const app = new Vue({
            el: '#settings-table-vue',
        });
    </script>

@endsection