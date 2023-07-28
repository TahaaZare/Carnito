@extends('admin.layouts.master')

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card text-black">
                        <i class="fa fa-commenting text-dark fa-lg pt-3 pb-1 px-3"></i>
                        <div class="card-body rounded-4 bg-white text-dark">
                            <div class="text-center">
                                <h5 class="card-title">نویسنده : {{ $contact->name }}
                                </h5>
                                <span>
                                    موضوع : {{$contact->subject}}
                                </span>
                                <p class="text-muted mb-4">
                                    {{jalaliAgo($contact->created_at)}} - {{ jalaliDate($contact->created_at) }}
                                </p>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between m-5 rounded-4 shadow shadow-box-soft border p-3">

                                    <p class="text-justify lead container">
                                        متن پیام :
                                        <span class="fw-bold">
                                            {{ $contact->text }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


