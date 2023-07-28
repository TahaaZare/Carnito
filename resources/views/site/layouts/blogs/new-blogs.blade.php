<section class="explore-section section-padding section-bg" id="section_2">
    <div class="container">

        <div class="col-12 text-center">
            <h2 class="mb-4"> آخرین وبلاگـ </h1>
        </div>

    </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane m-2 fade show active " tabindex="0">
                        <div class="row" dir="rtl">
                            @foreach ($posts as $post)
                                <!-- single blog post -->
                                <article class="col-lg-4 col-md-6 col-sm-12" dir="rtl">
                                    <div class="container">
                                        <section class="mx-auto my-5" style="max-width: 80%;border-radius: 2rem">
                                            <div class="card shadow" style="border-radius: 1.5rem">
                                                <div class="bg-image hover-overlay ripple"
                                                    data-mdb-ripple-color="light">
                                                    <a href="{{ route('show.blog', $post->slug) }}">
                                                        <img class="img-fluid" style="border-radius: 1.5rem"
                                                            src="{{ asset($post->image) }}"
                                                            alt="{{ $post->name }}" /></a>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="text-center my-2">{{ $post->name }}</h5>
                                                    <div class="d-flex text-right">
                                                        <p>
                                                            {!! $post->summary !!}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card-body d-flex flex-row">
                                                    @if ($post->author->profile_photo_path == null)
                                                        <img src="{{ asset('static-img/user-avatar.png') }}"
                                                            class="rounded-circle me-3" height="50px" width="50px"
                                                            alt="avatar" />
                                                    @else
                                                        <img src="{{ asset($post->author->profile_photo_path) }}"
                                                            class="rounded-circle me-3" height="50px" width="50px"
                                                            alt="avatar" />
                                                    @endif

                                                    <div>
                                                        <span class="card-title mx-2 font-weight-bold mb-2">
                                                            {{ $post->author->username }}
                                                        </span>
                                                        <br>
                                                        <span class=" text text-muted card-text"><i
                                                                class="far fa-clock pe-2"></i>
                                                            {{ jalaliAgo($post->created_at) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </section>
                                    </div>
                                </article>
                                <!-- /single blog post -->
                            @endforeach

                        </div> <!-- end row -->

                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
