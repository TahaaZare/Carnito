@extends('site.layouts.blogs.layouts.master')

@section('head-tag')
    <title>مقاله - {{ $post->name }}</title>
    <meta name=googlebot content=index,follow>
    <meta name=robots content=noodp,noydir>
    <meta name="description" content="{!! $post->summary !!}">

    <meta property=og:site_name value="تیم کارنیتو">
    <meta property=og:title content="{{ $post->name }}">
    <meta property=og:url content="{{ route('show.blog', $post) }}" />
    <meta property=og:image content="{{ asset($post->image) }}">
    <meta property=og:image:url content="{{ asset($post->image) }}" />
    <meta property=og:image:width content="700">
    <meta property=og:image:type content="image/jpg">
    <meta property=og:description content="">
    <meta property=og:price:currency content="IRR">
    <meta property=og:locale content="ir_FA">
@endsection

@section('content')
    @php
        $user = auth()->user();
    @endphp
    <div class="main-container container my-5" id="main-container">
        <!-- Content -->
        <div class="row">
            <!-- post content -->
            <div class="col-lg-12 blog__content mb-72">
                <div class="content-box">

                    <!-- standard post -->
                    <article class="entry mb-0">

                        <div class="single-post__entry-header entry__header">
                            <a href="categories.html"
                                class="entry__meta-category entry__meta-category--label entry__meta-category--green">
                                {{ $post->postCategory->name }}
                            </a>
                            <h1 class="single-post__entry-title">
                                {{ $post->name }} </h1>

                            <div class="entry__meta-holder">
                                <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                        <span>نویسنده:</span>
                                        <a href="#">{{ $post->author->username }}</a>
                                    </li>
                                    <li class="entry__meta-date">
                                        {{ jalaliDate($post->created_at) }}
                                    </li>
                                </ul>

                                <ul class="entry__meta">
                                    <li class="entry__meta-views">
                                        <i class="ui-eye"></i>
                                        {{-- <span>۱۲۴۳</span> --}}
                                    </li>
                                </ul>
                            </div>
                        </div> <!-- end entry header -->

                        <div class="entry__img-holder">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->slug }}" class="entry__img">
                        </div>

                        <div class="entry__article-wrap">
                            <div class="entry__article">
                                {!! $post->description !!}
                                <!-- tags -->
                                <div class="entry__tags">
                                    <i class="ui-tags"></i>
                                    <span class="entry__tags-label">برچسب ها:</span>
                                    @foreach ($tags as $tag)
                                        <a href="#" rel="tag">{{ $tag }}</a>
                                    @endforeach
                                </div> <!-- end tags -->

                            </div> <!-- end entry article -->
                        </div> <!-- end entry article wrap -->

                        <!-- Author -->
                        <div class="entry-author clearfix">
                            @if ($post->author->profile_photo_path == null)
                                <img alt="" data-src="{{ asset('static-img/user-avatar.png') }}"
                                    src="{{ asset('static-img/user-avatar.png') }}" class="avatar lazyloaded">
                            @else
                                <img alt="" data-src="{{ asset($post->author->profile_photo_path) }}"
                                    src="{{ asset($post->author->profile_photo_path) }}" class="avatar lazyloaded">
                            @endif

                            <div class="entry-author__info">
                                <h6 class="entry-author__name">
                                    <a href="#">{{ $post->author->fullName }}</a>

                                </h6>
                                @if ($post->author->job != null)
                                    <br>
                                    <span class="text-muted">
                                        {{ $post->author->job }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </article> <!-- end standard post -->
                    @if ($post->comment_able == 1)
                        @auth
                            <div class="entry-comments">

                                <div class="title-wrap title-wrap--line">
                                    <h3 class="section-title">{{ $post->activeComments()->count() }} دیدگاه</h3>
                                </div>
                                <h3>نظر خود را برایمان بنویسید </h3>
                                <!-- Comment Form -->
                                <form action="{{ route('post.add-comment', $post) }}" method="POST" class="comment-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <textarea class="form-control rounded" name="body" id="body" rows="6" placeholder="متن  نظر" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn p-2 rounded btn-primary">ثبت نظر</button>
                                </form>
                                <br>
                                <ul class="comment-list">
                                    @foreach ($post->activeComments() as $comment)
                                        <li class="comment">
                                            <div class="comment-body">
                                                <div class="comment-avatar">
                                                    <img alt=""
                                                        src="{{ asset($comment->author->profile_photo_path) }}">
                                                </div>
                                                <div class="comment-text">
                                                    <h6 class="comment-author">{{ $comment->author->username }}</h6>
                                                    <div class="comment-metadata">
                                                        <a href="#" class="comment-date">
                                                            {{ jalaliAgo($comment->created_at) }}</a>
                                                    </div>
                                                    <p>{{ $comment->body }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li> <!-- end 1-2 comment -->
                                    @endforeach

                                </ul>
                            </div> <!-- end comments -->

                        @endauth
                        @guest
                            <div class="alert alert-warning rounded-5 text-center fw-bold">
                                لطفا برای ثبت نظر خود وارد حساب کاربری شوید .
                                <a target="_blank" href="{{ route('auth.login-form') }}">ورود به حساب</a>
                            </div>
                        @endguest
                    @endif


                </div> <!-- end content box -->
            </div> <!-- end post content -->
        </div> <!-- end content -->
    </div>
@endsection
