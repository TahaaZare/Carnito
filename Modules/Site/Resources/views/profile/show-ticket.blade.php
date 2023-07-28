@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت - {{ $ticket->subject }}</title>
@endsection

@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <main id="main-body" class="main-body col-md-12">
                    <section class="content-wrapper bg-white p-3 mb-2" style="border-radius: 1.5rem !important">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="text-dark font-weight-bolder">
                                    <span>تاریخچه تیکت </span>
                                </h2>
                                <section class="content-header-link m-2">
                                    <a href="{{ route('customer.profile.my-tickets') }}"
                                        class="btn btn-danger text-white">بازگشت</a>
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->
                        <section class="order-wrapper">

                            <section class="card my-2 text-dark border" style="border-radius: 1rem !important">
                                <section class="card-header  bg-info">
                                    @if ($ticket->user->first_name == null && $ticket->user->last_name == null)
                                        {{ $ticket->user->username }}
                                    @else
                                        {{ $ticket->user->first_name . ' ' . $ticket->user->last_name }}
                                    @endif

                                </section>
                                <section class="card-body">
                                    <h5 class="card-title">موضوع : {{ $ticket->subject }}
                                    </h5>
                                    <br>
                                    <p class="card-text lead ">
                                        <i class="fas fa-angle-left"></i> {{ $ticket->description }}
                                    </p>
                                    @if ($ticket->file()->count() > 0)
                                        <section class="card-footer">
                                            <a class="btn btn-success" href="{{ asset($ticket->file->file_path) }}"
                                                download>دانلود
                                                ضمیمه</a>
                                        </section>
                                    @endif
                                </section>
                            </section>
                            @foreach ($ticket->children as $child)
                                <section class="card my-2 w-50 shadow text-dark border" style="border-radius: 2rem">
                                    <section class="card-header bg-success font-weight-bolder">
                                        <div> {{ $child->user->first_name . ' ' . $child->user->last_name }} - پاسخ دهنده :
                                            {{ $child->admin ? $child->admin->user->first_name . ' ' . $child->admin->user->last_name : 'نامشخص' }}
                                        </div>
                                        <small class=" font-weight-bolder">{{ jalaliAgo($child->created_at) }} -
                                            {{ jalaliDate($child->created_at) }}</small>
                                    </section>
                                    <section class="card-body">
                                        <section class="card">
                                            <section class="card-body">
                                                <p class="card-text">
                                                    <i class="fas fa-angle-left"></i> {{ $child->description }}
                                                </p>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                            @endforeach

                            <hr>
                            <section>
                                <form action="{{ route('customer.profile.answer', $ticket->id) }}" method="post">
                                    @csrf
                                    <section class="row text-dark">
                                        <section class="col-12">
                                            <div class="form-group">
                                                <label for="">پاسخ تیکت </label>
                                                <textarea class="form-control form-control-sm" rows="10" name="description">{{ old('description') }}</textarea>
                                            </div>
                                            @error('description')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>
                                        <section class="col-12">
                                            <button class="btn btn-primary btn-block">ثبت</button>
                                        </section>
                                    </section>
                                </form>
                            </section>

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
