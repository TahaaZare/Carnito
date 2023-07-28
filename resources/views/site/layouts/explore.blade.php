<section class="explore-section section-padding" id="section_2">
    <div class="container">

        <div class="col-12 text-center">
            <h2 class="mb-4">سرویس های مـا</h1>
        </div>

    </div>
    </div>

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


</section>


