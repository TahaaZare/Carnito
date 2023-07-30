@extends('site.layouts.blogs.layouts.master')

@section('head-tag')
    <title>کارنیتو - پروژه هـا</title>
@endsection

@section('content')
    <div class="main-container container pt-24" id="main-container">
        <!-- Content -->
        <div class="row">
            <!-- projects -->
            <div class="col-lg-8 project__content">
                <!-- Latest News -->
                <section class="section tab-post mb-16">
                    <!-- tab content -->
                    <div class="tabs__content tabs__content-trigger tab-post__tabs-content">
                        <div class="tabs__content-pane tabs__content-pane--active" id="tab-all">
                            <div class="row card-row">
                                @foreach ($projects as $project)
                                    <div class="col-md-6">
                                        <article class="entry card">
                                            <div class="entry__img-holder card__img-holder">
                                                <a href="{{ route('show-project', $project) }}">
                                                    <div class="thumb-container thumb-70">
                                                        <img data-src="{{ asset($project->image) }}"
                                                            src="{{ asset($project->image) }}" class="entry__img lazyload"
                                                            alt="{{ $project->name }}" />
                                                    </div>
                                                </a>
                                                <a href="#"
                                                    class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">
                                                    {{ $project->projectCategory->name }}
                                                </a>
                                            </div>

                                            <div class="entry__body card__body">
                                                <div class="entry__header">

                                                    <h2 class="entry__title">
                                                        <a href="{{ route('show-project', $project) }}">
                                                            {{ $project->name }}
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach

                            </div>
                        </div> <!-- end pane 1 -->
                    </div> <!-- end tab content -->
                </section> <!-- end latest news -->

            </div> <!-- end projects -->




        </div> <!-- end content -->

       
    </div> <!-- end main container -->
     <!-- Pagination -->
     <ul class="pagination pagination-primary mt-4">
        {!! $projects->links('pagination::tailwind') !!}
    </ul>
    <!-- Footer -->
    <div id="back-to-top">
        <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
    </div>
@endsection
