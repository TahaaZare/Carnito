<section class="service-2 section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- section title -->
                <div class="title text-center">
                    <h2>سرویس های مـا</h2>
                    <div class="border"></div>
                </div>
                <!-- /section title -->
            </div>
        </div>
        <div class="row" dir="rtl">
            <div class="col-md-12">
                <div class="row text-center">
                    @foreach ($services as $service)
                        <div class="col-md-6 col-sm-6">
                            <div class="service-item">
                                <div class=""> <img src="{{ asset($service->image) }}" alt="icon"
                                        class="rounded-3 shadow rounded-circle" width="90" height="90" class="my-3 p-2"></div>
                                <h4 class="my-3">{{ $service->name }}</h4>
                                @if ($service->description != null)
                                    {!! $service->description !!}
                                @endif
                            </div>
                        </div><!-- END COL -->
                    @endforeach

                </div>
            </div>
        </div> <!-- End row -->
    </div> <!-- End container -->
</section> <!-- End section -->
