@extends("dashboard.Layout.main")

@section("page-bar")
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route("root.index") }}">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Профили
            </li>
        </ul>
    </div>
@endsection

@section("page-body")
    <div class="row" style="margin-bottom: 15px; padding-top: 10px">
        <div class="col-md-12">
            <a href="{{ route("root.profile.new") }}" class="btn sbold green">
                Новый профиль
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> Email </th>
                                <th> Имя </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($profiles as $profile)
                                <tr>
                                    <td> {{ $profile->id }} </td>
                                    <td> {{ $profile->email }} </td>
                                    <td> {{ $profile->name }} </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route("root.profile.edit", ["profile" => $profile->id]) }}" class="btn btn-sm btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                Пока никого нет...
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $profiles->links() }}
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
