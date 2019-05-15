@extends("dashboard.Layout.main")

@section("title") Главная @endsection

@section("page-body")

    <div  id="dashboard-vue">
        <index-page></index-page>
    </div>

@endsection

@section("scripts")

    <script src="{{ asset("/js/index.js") }}">
    </script>
    <script>
        const app = new Vue({
            el: '#dashboard-vue',
        });
    </script>

@endsection


