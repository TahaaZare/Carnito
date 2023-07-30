@extends('site.layouts.blogs.layouts.master')

@section('head-tag')
    <title>مقاله - {{ $project->name }}</title>
    <meta name=googlebot content=index,follow>
    <meta name=robots content=noodp,noydir>
    <meta name="description" content="{!! $project->summary !!}">

    <meta property=og:site_name value="تیم کارنیتو">
    <meta property=og:title content="{{ $project->name }}">
    <meta property=og:url content="{{ route('show-project', $project) }}" />
    <meta property=og:image content="{{ asset($project->image) }}">
    <meta property=og:image:url content="{{ asset($project->image) }}" />
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
            <!-- project content -->
            <div class="col-lg-12 blog__content mb-72">
                <div class="content-box">

                    <!-- standard project -->
                    <article class="entry mb-0">

                        <div class="single-project__entry-header entry__header">
                            <a href="categories.html"
                                class="entry__meta-category entry__meta-category--label entry__meta-category--green">
                                {{ $project->projectCategory->name }}
                            </a>
                            <h1 class="single-project__entry-title">
                                {{ $project->name }} </h1>

                        </div> <!-- end entry header -->

                        <div class="entry__img-holder">
                            <img src="{{ asset($project->image) }}" alt="{{ $project->slug }}" class="entry__img">
                        </div>

                        <div class="entry__article-wrap">
                            <div class="entry__article">
                                {!! $project->description !!}
                            </div> <!-- end entry article -->
                        </div> <!-- end entry article wrap -->
                    </article> <!-- end standard project -->
                </div> <!-- end content box -->
            </div> <!-- end project content -->
        </div> <!-- end content -->
    </div>
@endsection
