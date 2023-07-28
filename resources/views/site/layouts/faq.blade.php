@if ($faqs->count() != 0)

    <section class="faq-section section-padding " id="section_4">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">
                    <h2 class="mb-4">سولات متداول</h2>
                </div>

                <div class="clearfix"></div>

                <div class="col-lg-5 col-12">
                    <img src="{{ asset('site-assets/images/faq_graphic.jpg') }}" class="img-fluid" alt="FAQs">
                </div>

                <div class="col-lg-6 col-12 m-auto">
                    @foreach ($faqs as $key => $faq)
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="mx-2">{{ $faq->question }}</span>
                                    </button>
                                </h2>

                                <div id="collapseOne" class="accordion-collaps collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body  bg-transparente">
                                        {!! $faq->awnser !!}
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>

        </div>
        </div>
    </section>
@endif
