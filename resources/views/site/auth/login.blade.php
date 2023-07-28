<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('font.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('site-assets/auth/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/sweetalert/sweetalert2.css') }}">
    <script src="{{ asset('admin-assets/sweetalert/sweetalert2.min.js') }}"></script>
</head>

<body dir="">
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('site-assets/auth/images/signin-image.jpg') }}" alt="sing up image">
                        </figure>
                        <a href="{{ route('auth.regitser-form') }}" class="signup-image-link fw-bold">حساب کاربری ندارید
                            ؟</a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title text-center">ورود به حساب</h2>
                        <form method="POST" action="/login-user" class="register-form"
                            id="register-form">
                            @csrf
                            <div class="form-group text-center">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" value="{{ old('username') }}" id="your_name"
                                    placeholder="نام کاربری" />
                                @error('username')
                                    <span class="text-danger bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="رمز عبور" />
                                @error('password')
                                    <span class="text-danger bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit"
                                    value="ورود" />

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset('site-assets/auth/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('site-assets/auth/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script> 
     {!! JsValidator::formRequest('Modules\Site\Http\Requests\Auth\LoginRequest') !!}
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.swal-warning')
</body>

</html>
