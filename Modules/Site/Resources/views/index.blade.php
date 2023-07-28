@extends('site.layouts.master')

@section('head-tag')
    <title>صفحه اصلی</title>

@endsection

@section('content')
    @include('site.layouts.hero')
    <!-- feature -->
    @include('site.layouts.featured')
    <!-- explore -->
    @include('site.layouts.explore')
    <!-- faq -->
    @include('site.layouts.faq')
    @include('site.layouts.blogs.new-blogs')
    <!-- contact -->
@endsection

@section('script')

@endsection
