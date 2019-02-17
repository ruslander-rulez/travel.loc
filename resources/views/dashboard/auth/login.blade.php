@extends("dashboard.Layout.auth")

@section("title") Login @endsection

@section('styles')

@stop

@section("body-class", "login")
@section("content")
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="index.html">
            <img src="{{asset("/dashboard/pages/img/logo-big.png")}}" alt="" /> </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="{{ route("dashboard.login") }}" method="post">
            <h3 class="form-title">Login to your account</h3>
            {{ csrf_field() }}
            @php
            /**
            * @var $errors ViewErrorBag
            */use Illuminate\Support\ViewErrorBag;
            @endphp
            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    @foreach($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            @endif
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="E-mail" name="email" value="{{ old("email") }}" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />
                </div>
            </div>
            <div class="form-actions">
                {{--<label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" /> Remember me
                    <span></span>
                </label>--}}
                <button type="submit" class="btn green pull-right"> Login </button>
            </div>
        </form>
        <!-- END LOGIN FORM -->
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <!-- END FORGOT PASSWORD FORM -->
        <!-- BEGIN REGISTRATION FORM -->
        <!-- END REGISTRATION FORM -->
    </div>
    <!-- END LOGIN -->
@endsection