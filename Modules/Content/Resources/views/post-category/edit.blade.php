@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')
    <div class="m-4">

        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.content.category.index') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                    </section>
                    <section class="card border-0 rounded-4">
                        <section class="card-body">
                            <form id="form" action="{{ route('admin.content.category.update', $postCategory->id) }}"
                                method="POST">
                                @csrf
                                {{ method_field('put') }}
                                <section class="row">
                                    <section class="col-lg-4 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="">نام دسته</label>
                                            <input type="text" value="{{ old('name', $postCategory->name) }}"
                                                name="name" class="form-control form-control-sm">
                                        </div>
                                        @error('name')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="col-lg-4 col-md-12 col-sm-12  my-2">
                                        <div class="form-group">
                                            <label for="tags">تگ ها</label>
                                            <input type="hidden" class="form-control form-control-sm" name="tags"
                                                id="tags" value="{{ old('tags', $postCategory->tags) }}">
                                            <select class="select2 form-control form-control-sm" id="select_tags" multiple>
                                            </select>

                                        </div>
                                        @error('tags')
                                            <span class="alert_required bg-danger text-white p-1 my-2 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="col-lg-4 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="status">وضعیت</label>
                                            <select name="status" id="" class="form-control form-control-sm"
                                                id="status">
                                                <option value="0" @if (old('status', $postCategory->status) == 0) selected @endif>
                                                    غیرفعال</option>
                                                <option value="1" @if (old('status', $postCategory->status) == 1) selected @endif>
                                                    فعال</option>
                                            </select>
                                        </div>
                                    </section>



                                    <section class="col-12 my-2">
                                        <div class="form-group">
                                            <label for="">توضیحات</label>
                                            <textarea name="description" id="description" class="form-control rounded-4 form-control-sm" rows="6">{{ old('description', $postCategory->description) }}</textarea>
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
    {!! JsValidator::formRequest('Modules\Content\Http\Requests\PostCategoryRequest') !!}
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
