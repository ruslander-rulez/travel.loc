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
                Рестораны
            </li>
        </ul>
    </div>
@endsection

@section("plugin-styles")
@endsection

@section("page-title")
    <h1 class="page-title">
        Рестораны
    </h1>
@endsection

@section("page-body")

    <div  id="restaurant-table-vue">
        <restaurant-table></restaurant-table>
    </div>

@endsection

@section("scripts")

    <script src="{{ asset("/js/restaurant.js") }}">
    </script>
    <script>
        const app = new Vue({
            el: '#restaurant-table-vue',
        });
    </script>

@endsection