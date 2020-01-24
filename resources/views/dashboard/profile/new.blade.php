@extends("dashboard.Layout.main")

@section("page-body")
    <div class="row" style="padding-top: 10px">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Новый профиль</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="{{ route("root.profile.create") }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Имя</label>
                                <div class="col-md-7">
                                    <input type="text" name="name" class="form-control input-circle" placeholder="Введите имя" value="{{ old("name") }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                                                        <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </span>
                                        <input type="email" name="email" value="{{ old("email") }}" class="form-control input-circle-right" placeholder="Email Address"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Пароль</label>
                                <div class="col-md-7">
                                    <input type="password" name="password" class="form-control spinner input-circle" placeholder="Password"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Подтверждение пароля</label>
                                <div class="col-md-7">
                                    <input type="password" name="password_confirmation" class="form-control spinner input-circle" placeholder="Password"> </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm green">Создать <i class="fa fa-save"></i></button>
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
