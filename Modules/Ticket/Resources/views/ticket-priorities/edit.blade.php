@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی تیکت - {{ $priorities->name }}</title>
@endsection

@section('content')
    <div class="m-4">

        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.ticket-priorities.index') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                    </section>
                    <section class="card border-0 rounded-4">
                        <section class="card-body">
                            <form id="form" action="{{ route('admin.ticket-priorities.update', $priorities->id) }}"
                                method="POST">
                                @csrf
                                {{ method_field('put') }}
                                <section class="row">
                                    <section class="col-lg-6 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="">نام اولویت</label>
                                            <input type="text" value="{{ old('name', $priorities->name) }}" name="name"
                                                class="form-control form-control-sm">
                                        </div>
                                        @error('name')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                    <section class="col-lg-6 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="status">وضعیت</label>
                                            <select name="status" id="" class="form-control form-control-sm"
                                                id="status">
                                                <option value="0" @if (old('status', $priorities->status) == 0) selected @endif>
                                                    غیرفعال</option>
                                                <option value="1" @if (old('status', $priorities->status) == 1) selected @endif>
                                                    فعال</option>
                                            </select>
                                        </div>
                                    </section>

                                    <section class="col-12">
                                        <button class="btn btn-success btn-block my-2">ثبت</button>
                                    </section>
                                </section>
                            </form>
                        </section>
                    </section>

                </section>
            </section>
        </section>

    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('Modules\Ticket\Http\Requests\TicketPriorities\TicketPrioritiesUpdate') !!}
    <script>
        $(document).ready(function() {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');


            $('#form').submit(function(event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
@endsection
