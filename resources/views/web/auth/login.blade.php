<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset("/web/login-page/images/icons/favicon.ico")}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("web/login-page/css/util.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("web/login-page/css/main.css")}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
            <form class="login100-form validate-form"  method="post" action="{{ route("web.login") }}">
                @csrf
					<span class="login100-form-title p-b-55">
						Login
					</span>

                @if($errors->count())
                    <div class="alert alert-danger w-full" role="alert">
                        Email or password are incorrect
                    </div>
                @endif
                <div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email" value="{{old("email")}}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
                </div>

                <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
                </div>

                <div class="contact100-form-checkbox m-l-4">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div class="container-login100-form-btn p-t-25">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center w-full p-t-50">
						<span class="txt1">
							Not a member?
						</span>

                    <a class="txt1 bo1 hov1" href="{{ route("web.register") }}">
                        Sign up now
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--===============================================================================================-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script>

    (function ($) {
        "use strict";


        /*==================================================================
        [ Validate ]*/
        var input = $('.validate-input .input100');

        $('.validate-form').on('submit',function(){
            var check = true;

            for(var i=0; i<input.length; i++) {
                if(validate(input[i]) == false){
                    showValidate(input[i]);
                    check=false;
                }
            }

            return check;
        });


        $('.validate-form .input100').each(function(){
            $(this).focus(function(){
                hideValidate(this);
            });
        });

        function validate (input) {
            if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
                if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                    return false;
                }
            }
            else {
                if($(input).val().trim() == ''){
                    return false;
                }
            }
        }

        function showValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-validate');
        }

        function hideValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).removeClass('alert-validate');
        }
    })(jQuery);
</script>

</body>
</html>