@extends('site.layouts.master')

@section('head-tag')
    <title>تیم کارنیتو</title>
    <link rel="stylesheet" href="{{ asset('site-assets/css/team.css') }}">
@endsection

@section('content')
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-5 col-12">
                    <h2 class="text-white">تیم کارنیتو</h2>
                </div>

            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane m-2 fade show active " tabindex="0">
                        <div class="row" dir="rtl">
                            @foreach ($teams as $team)
                            <div class="col-lg-4 col-md-4 my-4">
                                <div class="card shadow" style="border-radius: 1.8rem;">
                                    <div class="card-body text-center">
                                        <div class="mt-3 mb-4">
                                            @if ($team->image == null)
                                                <img src="{{ asset('static-img/user-avatar.png') }}"
                                                    class="rounded-circle img-fluid" style="width: 100px;" />
                                            @else
                                                <img src="{{ asset($team->image) }}" class="rounded-circle img-fluid"
                                                    style="width: 100px;" />
                                            @endif
        
                                        </div>
                                        <h4 class="mb-2">{{ $team->first_name }} {{$team->last_name}}</h4>
                                        <p class="text-muted mb-4">{{ $team->team_role }} <a href="#!">
                                            </a>
                                        <p>
                                            {!! $team->bio !!}
                                        </p>
                                        </p>
                                        <div class="mb-4 pb-2">
                                            @if ($team->instagram_link != null)
                                                <a href="{{ $team->instagram_link }}"
                                                    class="btn rounded-circle btn-outline-primary btn-floating">
                                                    <i class="fab fa-instagram fa-lg"></i>
                                                </a>
                                            @endif
                                            @if ($team->telegram_link != null)
                                                <a href="{{ $team->telegram_link }}"
                                                    class="btn  rounded-circle btn-outline-primary btn-floating">
                                                    <i class="fab fa-telegram-plane fa-lg"></i>
                                                </a>
                                            @endif
                                        </div>
        
                                    </div>
                                </div>
        
                            </div>
                        @endforeach

                        </div> <!-- end row -->

                    </div>
                </div>
            </div>
        </div>
    </div>
 
    </section>
@endsection
