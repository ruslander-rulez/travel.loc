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
            <li>
                Редактирование профиля
            </li>
        </ul>
    </div>
@endsection

@section("page-body")
    <div class="row" style="padding-top: 10px">
        <div class="col-md-7">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Профиль {{ $profile->name }} </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form" style="display: block;">
                    <!-- BEGIN FORM-->
                    <form action="{{ route("root.profile.update", ["id" => $profile->id]) }}" method="post" class="form-horizontal">
                        @csrf
                        @method("put")
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Имя</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control input-circle" placeholder="Введите имя" value="{{ $profile->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                                                        <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </span>
                                        <input type="email" name="email" value="{{ $profile->email }}" class="form-control input-circle-right" placeholder="Email Address"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm green">Сохранить <i class="fa fa-save"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Смена пароля</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form" style="display: block;">
                    <!-- BEGIN FORM-->
                    <form action="{{ route("root.profile.update.password", ["id" => $profile->id]) }}" method="post" class="form-horizontal">
                        @csrf
                        @method("put")
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Новый пароль</label>
                                <div class="col-md-4">
                                    <input type="text" name="password" class="form-control spinner input-circle" placeholder="Password"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Подтвержждение</label>
                                <div class="col-md-4">
                                    <input type="text" name="password_confirmation" class="form-control spinner input-circle" placeholder="Password"> </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm green">Сменить пароль <i class="fa fa-save"></i></button>
                                    <button class="btn btn-sm white" id="generate-new-password">Сгенерировать <i class="fa fa-random" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        function makepassword(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        $("#generate-new-password").click(function (e) {
            e.preventDefault()
            let password = makepassword(10);
            $("[name='password'], [name='password_confirmation']").val(password)
        })
    </script>
@endsection