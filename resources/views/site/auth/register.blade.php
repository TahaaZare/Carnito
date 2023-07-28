<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('font.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('site-assets/auth/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/sweetalert/sweetalert2.css') }}">
    <script src="{{ asset('admin-assets/sweetalert/sweetalert2.min.js') }}"></script>
</head>

<body dir="rtl">
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form text-center">
                        <h2 class="form-title text-center">ثبت نام</h2>
                        <form method="POST" action="{{ route('auth.regitser') }}" class="register-form"
                            id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" value="{{ old('username') }}" id="name"
                                    placeholder="نام کاربری" />
                                @error('username')
                                    <span class="text-danger bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="رمز عبور" />
                                @error('password')
                                    <span class="text-danger bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirmation" id="re_pass"
                                    placeholder="تکرار رمز عبور" />
                                @error('password_confirmation')
                                    <span class="text-danger bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit"
                                    value="ثبت نام" />

                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('site-assets/auth/images/signup-image.jpg') }}" alt="sing up image">
                        </figure>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset('site-assets/auth/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('site-assets/auth/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('Modules\Site\Http\Requests\Auth\RegisterRequest') !!}
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.swal-warning')
</body>

</html>
