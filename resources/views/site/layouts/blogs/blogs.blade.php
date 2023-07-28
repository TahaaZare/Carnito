@extends('site.layouts.blogs.layouts.master')

@section('head-tag')
    <title>کارنیتو وبلاگـ</title>
@endsection

@section('content')
    @include('site.layouts.blogs.layouts.trending')
    <div class="main-container container pt-24" id="main-container">

        <!-- Content -->
        <div class="row">
            <!-- Posts -->
            <div class="col-lg-8 blog__content">
                <!-- Latest News -->
                <section class="section tab-post mb-16">
                    <!-- tab content -->
                    <div class="tabs__content tabs__content-trigger tab-post__tabs-content">
                        <div class="tabs__content-pane tabs__content-pane--active" id="tab-all">
                            <div class="row card-row">
                                @foreach ($posts as $blog)
                                    <div class="col-md-6">
                                        <article class="entry card">
                                            <div class="entry__img-holder card__img-holder">
                                                <a href="{{ route('show.blog', $blog) }}">
                                                    <div class="thumb-container thumb-70">
                                                        <img data-src="{{ asset($blog->image) }}"
                                                            src="{{ asset($blog->image) }}" class="entry__img lazyload"
                                                            alt="{{ $blog->name }}" />
                                                    </div>
                                                </a>
                                                <a href="#"
                                                    class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">
                                                    {{ $blog->postCategory->name }}
                                                </a>
                                            </div>

                                            <div class="entry__body card__body">
                                                <div class="entry__header">

                                                    <h2 class="entry__title">
                                                        <a href="{{ route('show.blog', $blog) }}">
                                                            {{ $blog->name }}
                                                        </a>
                                                    </h2>
                                                    <ul class="entry__meta">
                                                        <li class="entry__meta-author">
                                                            <span>نویسنده:</span>
                                                            <a href="#">{{ $blog->author->username }}</a>
                                                        </li>
                                                        <li class="entry__meta-date">
                                                            {{ jalaliDate($blog->created_at) }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="entry__excerpt">
                                                    {!! $blog->summary !!}
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach

                            </div>
                        </div> <!-- end pane 1 -->
                    </div> <!-- end tab content -->
                </section> <!-- end latest news -->

            </div> <!-- end posts -->

            <!-- Sidebar -->
            <aside class="col-lg-4 sidebar sidebar--right">

                <!-- Widget Popular Posts -->
                <aside class="widget widget-popular-posts">
                    <h4 class="widget-title">محبوب ترین مقالات</h4>
                    <ul class="post-list-small">
                        @foreach ($posts as $blog)
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-100">
                                            <a href="single-post.html">
                                                <img data-src="{{ asset($blog->image) }}" src="{{ asset($blog->image) }}"
                                                    alt="{{ $blog->name }}"
                                                    class="post-list-small__img--rounded lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="{{ route('show.blog', $blog) }}">
                                                {{ $blog->name }}
                                            </a>
                                        </h3>
                                        <ul class="entry__meta">
                                            <li class="entry__meta-author">
                                                <span>نویسنده:</span>
                                                <a href="#">{{ $blog->author->username }}</a>
                                            </li>
                                            <li class="entry__meta-date">
                                                {{ jalaliDate($blog->created_at) }}
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                            </li>
                        @endforeach
                        <!-- Pagination -->
                        {{-- <nav class="pagination">
                            <span class="pagination__page pagination__page--current">۱</span>
                            <a href="#" class="pagination__page">۲</a>
                            <a href="#" class="pagination__page">۳</a>
                            <a href="#" class="pagination__page">۴</a>
                            <a href="#" class="pagination__page pagination__icon pagination__page--next"><i
                                    class="ui-arrow-left"></i></a>
                        </nav> --}}
                    </ul>
                </aside> <!-- end widget popular posts -->



            </aside> <!-- end sidebar -->

        </div> <!-- end content -->

        <!-- Carousel posts -->
        <section class="section mb-0">
            <div class="title-wrap title-wrap--line">
                <h3 class="section-title">پربازدیدترین مقالات</h3>
            </div>

            <!-- Slider -->
            <div id="owl-posts" class="owl-carousel owl-theme owl-carousel--arrows-outside">
                @foreach ($posts as $blog)
                    <article class="entry thumb thumb--size-1">
                        <div class="entry__img-holder thumb__img-holder">
                            <img data-src="{{ asset($blog->image) }}" src="{{ asset($blog->image) }}"
                                alt="{{ $blog->name }}" class="entry__img-holder thumb__img-holder">
                            <div class="bottom-gradient"></div>
                            <div class="thumb-text-holder">
                                <h2 class="thumb-entry-title">
                                    <a href="{{ route('show.blog', $blog) }}">
                                        {{ $blog->name }}
                                    </a>
                                </h2>
                            </div>
                            <a href="single-post.html" class="thumb-url"></a>
                        </div>
                    </article>
                @endforeach

            </div> <!-- end slider -->

        </section> <!-- end carousel posts -->

    </div> <!-- end main container -->
      <!-- Footer -->
    <div id="back-to-top">
        <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
    </div>
@endsection
