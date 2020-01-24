@extends("dashboard.Layout.main")

@section("page-bar")
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route("root.index") }}">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Чат
            </li>
        </ul>
    </div>
@endsection

@section("page-body")
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th> Email </th>
                                <th> Имя </th>
                                <th> Сообщение </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($conversations as $conversation)
                                <tr>
                                    <td></td>
                                    <td> {{ $conversation->profile->email }} </td>
                                    <td> {{ $conversation->profile->name }} </td>
                                    <td> {{ str_limit($conversation->message) }} </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route("root.chat.details", ["people_id" => $conversation->profile_id]) }}" class="btn btn-sm btn-default">
                                                <i class="fa fa-comments" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                Пока диалогов нет...
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $conversations->links() }}
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
