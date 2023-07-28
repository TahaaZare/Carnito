<footer class="site-footer section-padding ">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-4 col-6">
                <h6 class="site-footer-title text-center mb-3">لینک های مفید</h6>

                <ul class="site-footer-links text-center">
                    <li class="site-footer-link-item"><a class="site-footer-link text-center"
                            href="{{ route('about-us') }}">درباره مـا</a></li>
                    <li class="site-footer-link-item"><a class="site-footer-link text-center"
                            href="{{ route('our-services') }}">سرویس ها</a></li>
                    <li class="site-footer-link-item"><a class="site-footer-link text-center" href="">وبلاگـ</a>
                    </li>
                </ul>
            </div>


            <div class="col-lg-4 col-md-4 col-6">
                <h6 class="site-footer-title text-center mb-3">سرویس ها</h6>
                <ul class="site-footer-links text-center">
                    @php
                        $services = Modules\Content\Entities\Service::where('status', 1)->get();
                    @endphp
                    @foreach ($services as $service)
                        <li class="site-footer-link-item"><a href=""
                                class=" text-center">{{ $service->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <p >&copy;تمامی حقوق مادی و معنوی این سایت متعلق به <strong>کارینتو</strong> می باشد و هرگونه کپی برداری
                غیرقانونی محسوب خواهد شد
            </p>
        </div>
          
    </div>
</footer>
