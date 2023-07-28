<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span>کارنیتو</span>
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav  ms-lg-5 me-lg-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('home') }}">خانه</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('our-services') }}">سرویس ها</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('about-us') }}">درباره مـا</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('contactUs') }}">تماس با مـا</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link  fw-bold dropdown-toggle" href="#" id="navbarLightDropdownMenuLink"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">لینکـ های مفید</a>

                    <ul class="dropdown-menu text-center dropdown-menu-light"
                        aria-labelledby="navbarLightDropdownMenuLink">
                        <li><a class="dropdown-item fw-bold" href="{{ route('blogs') }}">وبلاگـ</a></li>
                        <li><a class="dropdown-item fw-bold" href="">سوالات متداول</a></li>
                        <li><a class="dropdown-item fw-bold" href="{{ route('team.members') }}">تیم کارنیتـو</a></li>
                    </ul>
                </li>
                @auth
                    @php
                        $user = auth()->user();
                    @endphp
                    <li class="nav-item">
                        <a href="{{ route('customer.profile.profile') }}" class="bg-white p-2 rounded-5 bi-person smoothscroll">
                            @if ($user->first_name == null && $user->last_name == null)
                                <small>
                                    {{ $user->username }} خوش آمدید
                                </small>
                            @else
                            <small>
                                {{ $user->fullName }} خوش آمدید  
                            </small>
                            @endif
                        </a>
                    </li>
                @endauth
            </ul>
            @guest

                <ul class="navbar-nav  ms-lg-5 me-lg-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link  fw-bold dropdown-toggle" href="#" id="navbarLightDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">ورود / ثبت نام</a>

                        <ul class="dropdown-menu text-center dropdown-menu-light"
                            aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item fw-bold" href="{{ route('auth.login-form') }}">ورود</a></li>
                            <li><a class="dropdown-item fw-bold" href="{{ route('auth.regitser-form') }}">ثبت نام</a></li>
                        </ul>
                    </li>
                </ul>

            @endguest

        </div>
    </div>
</nav>
