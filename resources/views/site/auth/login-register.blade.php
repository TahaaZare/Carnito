<!DOCTYPE html>
<html lang="en">

<head>
    <title>ورود</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

    <link rel="stylesheet" type="text/css" href="site-assets/auth-assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('font.css') }}">
    <link rel="stylesheet" type="text/css"
        href="site-assets/auth-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="site-assets/auth-assets/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="site-assets/auth-assets/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="site-assets/auth-assets/vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="site-assets/auth-assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="site-assets/auth-assets/css/main.css">

</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="">
                <div class="login100-pic js-tilt my-5" data-tilt>
                    <img src="site-assets/auth-assets/images/img-01.png" alt="IMG">
                </div>
                <form class="" id="form" action="{{ route('auth.login-register') }}"
                    method="POST">
                    @csrf
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" value="{{ old('id') }}" name="id"
                            placeholder="شماره تماس خود را وارد کنید">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                        @error('id')
                            <span class="alert_required fw-bold bg-danger text-white p-1 rounded" role="alert">
                                <small>
                                    {{ $message }}
                                </small>
                            </span>
                        @enderror
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            ورود
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script src="site-assets/auth-assets/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="site-assets/auth-assets/vendor/bootstrap/js/popper.js"></script>
    <script src="site-assets/auth-assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="site-assets/auth-assets/vendor/select2/select2.min.js"></script>

    <script src="site-assets/auth-assets/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

    <script src="site-assets/auth-assets/js/main.js"></script>

</body>

</html>
