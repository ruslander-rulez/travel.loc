@extends("dashboard.Layout.main")
@section("styles")
    <link rel="stylesheet" href="{{ asset("dashboard/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") }}">
@endsection

@section("page-bar")
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route("root.index") }}">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Отели
            </li>
        </ul>
    </div>
@endsection

@section("plugin-styles")
@endsection

@section("page-title")
    <h1 class="page-title">
        Отели
    </h1>
@endsection

@section("page-body")

    <div  id="hotel-table-vue">
        <hotel-table></hotel-table>
    </div>

@endsection

@section("scripts")

    <script src="{{ asset("/js/hotel.js") }}">
    </script>
    <script>
        const app = new Vue({
            el: '#hotel-table-vue',
        });
    </script>

@endsection