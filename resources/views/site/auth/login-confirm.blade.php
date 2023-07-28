<!DOCTYPE html>
<html lang="en">

<head>
    <title>ورود</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('site-assets/auth-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('site-assets/auth-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('site-assets/auth-assets/vendor/animate/animate.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('site-assets/auth-assets/vendor/css-hamburgers/hamburgers.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('site-assets/auth-assets/vendor/select2/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('site-assets/auth-assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('site-assets/auth-assets/css/main.css') }}">

</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="">
                <div class="login100-pic js-tilt my-5" data-tilt>
                    <img src="{{ asset('site-assets/auth-assets/images/img-01.png') }}" alt="IMG">
                </div>
                <h4 class="text-center m-2 text-white">
                    کد تایید را وارد نمایید
                </h4>
                <br>
                <form action="{{ route('auth.login-confirm', $token) }}" method="POST">
                    @csrf
                    <div class="control is-bigger has-icon">
                        @if ($otp->type == 0)
                            <div class="">
                                <span class="login-info text-center text-white">
                                    کد تایید برای شماره موبایل {{ $otp->login_id }} ارسال گردید
                                </span>
                                <hr>
                            </div>
                        @endif
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" value="{{ old('otp') }}" name="otp">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                            @error('otp')
                                <span class="alert_required fw-bold bg-danger text-white p-1 rounded" role="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                            @enderror
                        </div>
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                تایید
                            </button>
                        </div>
                        <hr>
                        <section id="resend-otp" class="d-none">
                            <a href="{{ route('auth.login-resend-otp', $token) }}"
                                class="text-decoration-none text-warning fw-bold text-primary">دریافت
                                مجدد کد تایید</a>
                        </section>
                        <br>
                        <section id="timer" class="text-center font-weight-bolder text-white"></section>
                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('site-assets/auth-assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ asset('site-assets/auth-assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('site-assets/auth-assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('site-assets/auth-assets/vendor/select2/select2.min.js') }}"></script>

    <script src="{{ asset('site-assets/auth-assets/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

    <script src="{{ asset('site-assets/auth-assets/js/main.js') }}"></script>
    @php
        $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(3)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
    @endphp

    <script>
        var countDownDate = new Date().getTime() + {{ $timer }};
        var timer = $('#timer');
        var resendOtp = $('#resend-otp');

        var x = setInterval(function() {

            var now = new Date().getTime();

            var distance = countDownDate - now;

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (minutes == 0) {
                timer.html('ارسال مجدد کد تایید تا ' + seconds + ' ' + 'ثانیه دیگر')
            } else {
                timer.html('ارسال مجدد کد تایید تا ' + minutes + ' ' + 'دقیقه و ' + seconds + ' ' + 'ثانیه دیگر');
            }
            if (distance < 0) {
                clearInterval(x);
                timer.addClass('d-none');
                resendOtp.removeClass('d-none');
            }

        }, 1000)
    </script>
</body>

</html>
