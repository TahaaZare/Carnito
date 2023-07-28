@extends('admin.layouts.master')

@section('head-tag')
    <title>درباره ما</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش درباره ما | {{ $about->question }}
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.about-us') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                    </section>

                    <section class="card border-0 rounded-4">
                        <section class="card-body">
                            <form id="form" action="{{ route('admin.about-us.update', $about->id) }}" method="POST">
                                @csrf
                                {{ method_field('put') }}
                                <section class="row">

                                    <section class="col-12 my-2">
                                        <div class="form-group">
                                            <label for="">
                                                <span class="fw-bold">*</span>
                                                متن
                                            </label>
                                            <textarea name="text" id="text" class="form-control rounded-4 form-control-sm text" rows="6">{{ old('text', $about->text) }}</textarea>
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
    <script src="{{ asset('admin-assets/ckeditor5/build/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.text'), {
                licenseKey: '',
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.log(error);
            });
    </script>
    {!! JsValidator::formRequest('Modules\Content\Http\Requests\AboutUsRequest') !!}
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
            });
        });
    </script>
@endsection
