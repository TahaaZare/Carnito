@extends('site.layouts.master')
@section('head-tag')
    <title>تماس با مـا</title>
@endsection

@section('content')

<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-5 col-12">
                <h2 class="text-white">فرم تماس با ما</h2>
            </div>

        </div>
    </div>
</header>


<section class="section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
            </div>

            <div class="col-lg-12 col-12">
                <form action="{{ route('contactUs.store') }}" method="post" class="custom-form contact-form" role="form">
                        @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" placeholder="نام کامل" class="form-control rounded" name="name"
                                id="name" required>
                                <label for="">نام کامل</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12"> 
                            <div class="form-floating">
                                <input type="email" placeholder="ایمیل" class="form-control rounded" name="email"
                                id="email" required>
                                <label for="">ایمیل</label>

                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <div class="form-floating">
                                <input type="text" placeholder="موضوع" class="form-control rounded" name="subject"
                                id="subject" required>
                                <label for="">موضوع</label>
                            </div>

                            <div class="form-floating">
                                <textarea rows="6" placeholder="متن پیام" class="form-control rounded" name="text" id="message" required></textarea>
                                <label for="">متن پیام</label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 ms-auto">
                            <button type="submit" class="form-control">ارسال</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
