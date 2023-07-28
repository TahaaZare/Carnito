@extends('admin.layouts.master')

@section('head-tag')
    <title>
        تیکت - {{ $ticket->subject }}
    </title>
@endsection

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card text-black">
                        <i class="fa fa-ticket text-info fa-lg pt-3 pb-1 px-3"></i>
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="card-title">
                                    عنوان تیکت : {{ $ticket->subject }}
                                </h4>
                                <h6 class="card-title">نویسنده : {{ $ticket->user->fullName }}
                                </h6>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between m-5 rounded-4 shadow shadow-box-soft border p-3">
                                    <p class="text-justify lead container">
                                        متن تیکت :
                                        <span class="fw-bold">
                                            {{ $ticket->description }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between total fw-bold mt-4">
                                <span>تاریخ :
                                    {{ convertEnglishToPersian(jalaliDate($ticket->created_at)) }}</span><span></span>

                            </div>
                            <hr>
                            <div class="d-flex justify-content-between m-5 bg-white rounded shadow shadow-box-soft border p-3">
                                <p class="text-justify lead ">
                                    @foreach ($ticket->children as $child)
                                    <section class="card ">
                                        <section class="card-header bg-dark d-flex justify-content-between">
                                            <div> {{ $child->user->first_name . ' ' . $child->user->last_name }} - پاسخ دهنده :
                                                {{ $child->admin ? $child->admin->user->first_name . ' ' .
                                                $child->admin->user->last_name : 'نامشخص' }}</div>
                                            <small>{{ jalaliAgo($child->created_at) }} -
                                                {{ jalaliDate($child->created_at) }}</small>
                                        </section>
                                        <section class="card-body">
                                            <p class="card-text  text-dark">
                                                {{ $child->description }}
                                            </p>
                                        </section>
            
                                    </section>
                                    @endforeach
                                </p>
                            </div>
                            @if ($ticket->ticket_id == null)
                                <section>
                                    <div class="m-5">
                                        <form action="{{ route('admin.ticket.answer', $ticket->id) }}" method="post">
                                            @csrf
                                            <label for="answer">پاسخ ادمین</label>
                                            <textarea name="description" type="text" name="description" rows="6" class=" form-control p-2 border">{{ old('description') }}</textarea>
                                            <button type="submit" class="btn btn-block btn-success my-2">ثبت</button>
                                        </form>
                                    </div>
                                </section>
                            @endif


                        </div>
                    </div>
                    
                  

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    {!! JsValidator::formRequest('Modules\Ticket\Http\Requests\TicketRequest') !!}
@endsection
