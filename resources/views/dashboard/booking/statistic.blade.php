@extends("dashboard.Layout.main")

@section("title") Главная @endsection

@section("page-body")
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Пассажиропоток / Пассажирооборот</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach(array_keys($statistic) as $key)
                                    @if (!$loop->last)
                                        <td>{{ __("month." . $key) }}</td>
                                    @endif
                                    @if ($loop->last)
                                        <td><b>{{ $key }}</b></td>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($statistic as $month)
                            <td>{{ array_get($month, "passenger_flow", 0) }} / {{ array_get($month, "passenger_turnover", 0) }}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
@endsection


