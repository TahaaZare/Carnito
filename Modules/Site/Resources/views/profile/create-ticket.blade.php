@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت جدید </title>
@endsection

@section('content')
    <!-- start body -->
    <section class="text-dark">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <main id="main-body" class="main-body col-md-12">
                    <section class="content-wrapper bg-white p-3 text-dark rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>افزودن تیکت </span>
                                </h2>
                                <section class="content-header-link m-2">
                                    <a href="{{ route('customer.profile.my-tickets') }}"
                                        class="btn btn-danger text-white">بازگشت</a>
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->
                        <section class="order-wrapper">
                            <hr>
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        @endif
                            <section class="my-3 text-dark">
                                <form enctype="multipart/form-data" action="{{ route('customer.profile.my-tickets.store') }}" method="post">
                                    @csrf
                                    <section class="row">
                                        <section class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="" class="">عنوان</label>
                                                ‍<input class="form-control form-control-sm" rows="4" name="subject"
                                                    value="{{ old('subject') }}" />
                                            </div>
                                            @error('description')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>
                                        <section class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="">انتخاب دسته</label>
                                                <select name="category_id" id=""
                                                    class="form-control form-control-sm">
                                                    <option value="">دسته را انتخاب کنید</option>
                                                    @foreach ($ticketCategories as $ticketCategory)
                                                        <option value="{{ $ticketCategory->id }}"
                                                            @if (old('category_id') == $ticketCategory->id) selected @endif>
                                                            {{ $ticketCategory->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('category_id')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>

                                        <section class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="">انتخاب اولویت</label>
                                                <select name="priority_id" id=""
                                                    class="form-control form-control-sm">
                                                    <option value="">دسته را انتخاب کنید</option>
                                                    @foreach ($ticketPriorities as $ticketPriority)
                                                        <option value="{{ $ticketPriority->id }}"
                                                            @if (old('priority_id') == $ticketPriority->id) selected @endif>
                                                            {{ $ticketPriority->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('category_id')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>



                                        <section class="col-12">
                                            <div class="form-group">
                                                <label for="" class="my-2">متن</label>
                                                <textarea class="form-control form-control-sm" rows="6" name="description">{{ old('description') }}</textarea>
                                            </div>
                                            @error('description')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>

                                        <section class="col-12 my-2">
                                            <div class="form-group">
                                                <label for="file">فایل</label>
                                                <input type="file" class="form-control form-control-sm" name="file"
                                                    id="file">
                                            </div>
                                            @error('file')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>


                                        <section class="col-12 my-3">
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
