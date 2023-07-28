@extends('site.layouts.master')

@section('head-tag')
    <title>سرویس های مـا</title>
@endsection

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-5 col-12">
                <h2 class="text-white">سرویس های مـا</h2>
            </div>

        </div>
    </div>
</header>
<section class="explore-section section-padding" id="section_2">
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane m-2 fade show active" tabindex="0">
                            <div class="row">
                                @foreach ($services as $service)
                                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                        <div class="custom-block text-center bg-white shadow-lg">
                                            <a class="text-center">
                                                <img src="{{ asset($service->image) }}" alt="{{ $service->name }}"
                                                    class="rounded-3 m-2 d-flex justify-content-center shadow"
                                                    style="border-radius: 100% !important" width="90" height="90">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">{{ $service->name }}</h5>
                                                        @if ($service->description != null)
                                                            {!! $service->description !!}
                                                        @endif
                                                    </div>
                                                </div>
        
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</section>

@endsection
