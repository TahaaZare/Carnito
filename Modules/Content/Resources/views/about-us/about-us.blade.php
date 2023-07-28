@extends('site.layouts.master')

@section('head-tag')
    <title>درباره مـا</title>
   
@endsection

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-5 col-12">
                <h2 class="text-white">درباره مـا</h2>
            </div>

        </div>
    </div>
</header>
<section class="explore-section section-padding" id="section_2">
    <div class="container">
        <section class="about-shot-info section-sm" dir="rtl">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mt-20">
                        @foreach ($messages as $message)
                            {!! $message->text !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

@endsection
