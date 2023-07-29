@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد پروژه جدید</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/DateTimePicker/jalalidatepicker.min.css') }}">
@endsection

@section('content')
    <div class="m-4">

        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            ایجاد پروژه جدید
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.project.index') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                    </section>

                    <section class="card border-0 rounded-4">
                        <section class="card-body">
                            <form id="form" action="{{ route('admin.project.store') }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <section class="row">
                                    <section class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="">نام پروژه</label>
                                            <input type="text" value="{{ old('name') }}" name="name"
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

                                    <section class="col-lg-6  col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="category_id">دسته بندی</label>
                                            <select name="category_id" id="" class="form-control"
                                                id="category_id">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if (old('category_id') == $category->id) seleted @endif>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </section>
                                    <section class="col-lg-4 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="status">وضعیت</label>
                                            <select name="status" id="" class="form-control"
                                                id="status">
                                                <option value="0" @if (old('status') == 0) selected @endif>
                                                    غیرفعال</option>
                                                <option value="1" @if (old('status') == 1) selected @endif>
                                                    فعال</option>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col-12 my-2">
                                        <div class="form-group">
                                            <label for="">توضیحات</label>
                                            <textarea name="description" id="description" class="form-control  description rounded-4 form-control-sm"
                                                rows="6">{{ old('description') }}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="col-lg-6 col-md-12 col-sm-12  my-3">
                                        <div class="form-group">
                                            <label for="slug">اسلاگـ</label>
                                            <input type="text" value="{{ old('slug') }}"
                                                class="form-control form-control-sm" name="slug" id="slug">
                                            @error('slug')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </section>

                                    <section class="col-lg-12 col-md-12 col-sm-12  my-2">
                                        <div class="form-group">
                                            <label for="tags">تصویر</label>
                                            <input type="file" required id="image" value="{{ old('image') }}"
                                                class="form-control form-control-sm" name="image" id="image">
                                        </div>
                                        <div class="my-3 d-flex justify-content-center">
                                            <img src="" alt="avatar" id="imageUp" class="my-2 rounded-5"
                                                width="50%" height="100%" class="mt-3">
                                        </div>
                                        @error('image')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                    <br>
                                    <hr>

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
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageUp').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
    <script src="{{ asset('admin-assets/ckeditor5/build/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.description'), {
                licenseKey: '',
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.log(error);
            });
        ClassicEditor
            .create(document.querySelector('.summary'), {
                licenseKey: '',
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.log(error);
            });
    </script>

    {!! JsValidator::formRequest('Modules\Content\Http\Requests\Project\StoreProjectRequest') !!}
@endsection
