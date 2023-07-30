@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد پست جدید</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/DateTimePicker/jalalidatepicker.min.css') }}">
@endsection

@section('content')
    <div class="m-4">

        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            ایجاد پست جدید
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.content.post.index') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                    </section>

                    <section class="card border-0 rounded-4">
                        <section class="card-body">
                            <form id="form" action="{{ route('admin.content.post.store') }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <section class="row">
                                    <section class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="">نام پست</label>
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

                                    <section class="col-lg-6 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="author_id">نویسنده</label>
                                            <select name="author_id" class="form-control form-control-sm" id="author_id">
                                                @foreach ($author as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if (old('author_id') == $user->id) seleted @endif>
                                                        {{ $user->first_name }} {{ $user->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </section>

                                    <section class="col-lg-6  col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="category_id">دسته بندی</label>
                                            <select name="category_id" id="" class="form-control form-control-sm"
                                                id="category_id">
                                                @foreach ($post_categories as $category)
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
                                            <select name="status" id="" class="form-control form-control-sm"
                                                id="status">
                                                <option value="0" @if (old('status') == 0) selected @endif>
                                                    غیرفعال</option>
                                                <option value="1" @if (old('status') == 1) selected @endif>
                                                    فعال</option>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col-lg-4 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="comment_able">کامنت گذاشتن</label>
                                            <select name="comment_able" id="" class="form-control form-control-sm"
                                                id="comment_able">
                                                <option value="0" @if (old('comment_able') == 0) selected @endif>
                                                    غیرفعال</option>
                                                <option value="1" @if (old('comment_able') == 1) selected @endif>
                                                    فعال</option>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col-lg-4 col-md-12 col-sm-12 my-3">
                                        <div class="form-group">
                                            <label for="published_at">تاریخ انتشار پست</label>
                                            <input data-jdp value="{{ old('published_at') }}" data-jdp-only-date
                                                class="form-control form-control-sm" placeholder="تاریخ انتشار پست"
                                                name="published_at" id="published_at" autocomplete="off">
                                            @error('published_at')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </section>



                                    <section class="col-12 my-2">
                                        <div class="form-group">
                                            <label for="">خلاصه</label>
                                            <textarea name="summary" id="summary" class="form-control summary rounded-4 form-control-sm" rows="4">{{ old('summary') }}</textarea>
                                        </div>
                                        @error('summary')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
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



                                    <section class="col-lg-6 col-md-12 col-sm-12  my-2">
                                        <div class="form-group">
                                            <label for="select_tags">تگ ها</label>
                                            <input type="hidden" value="{{ old('tags') }}"
                                                class="form-control form-control-sm" name="tags" id="tags">
                                            <select class="select2 form-control form-control-sm" name="select_tags"
                                                id="select_tags" multiple>
                                            </select>
                                            @error('tags')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>
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
      const watchdog = new CKSource.EditorWatchdog();
			window.watchdog = watchdog;
			watchdog.setCreator( ( element, config ) => {
				return CKSource.Editor
					.create( element, config )
					.then( editor => {
						return editor;
					} )
			} );
			
			watchdog.setDestructor( editor => {
				return editor.destroy();
			} );
			
			watchdog.on( 'error', handleError );
			
			watchdog
				.create( document.querySelector( '.description' ), {
					licenseKey: '',
				} )
				.catch( handleError );
			
			function handleError( error ) {
				console.error( error );
			}
    </script>


    {!! JsValidator::formRequest('Modules\Content\Http\Requests\PostRequest') !!}
    <script type="text/javascript" src="{{ asset('admin-assets/DateTimePicker/jalalidatepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            jalaliDatepicker.startWatch({
                date: false,
                time: true
            })
        });
    </script>

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
