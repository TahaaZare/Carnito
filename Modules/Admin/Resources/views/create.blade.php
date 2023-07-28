@extends('admin.layouts.master')

@section('head-tag')
    <title>
        افزودن ادمین جدید
    </title>
@endsection
@section('content')
    <div class="m-4">

        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h6>افزودن ادمین</h6>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.admin-users') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                    </section>

                    <section class="card border-0 rounded-4">
                        <section class="card-body">
                            <form id="form" enctype="multipart/form-data"
                                action="{{ route('admin.admin-user.store') }}" method="POST">
                                @csrf
                                <section class="row">
                                    <div class="my-3 d-flex justify-content-center">
                                        <img src="{{ asset('static-img/user-avatar.png') }}" alt="avatar" id="imageUp"
                                            class="my-2 rounded-circle border border-3 shadow" width="100" height="100"
                                            class="mt-3">
                                    </div>
                                    <section class="col-lg-6 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="">
                                                <span class="fw-bold">*</span>
                                                نام
                                            </label>
                                            <input type="text" value="{{ old('first_name') }}" name="first_name"
                                                class="form-control form-control-sm">
                                        </div>
                                        @error('first_name')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                    <section class="col-lg-6 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="">
                                                <span class="fw-bold">*</span>
                                                نام خانوادگی
                                            </label>
                                            <input type="text" value="{{ old('last_name') }}" name="last_name"
                                                class="form-control form-control-sm">
                                        </div>
                                        @error('last_name')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="email">
                                                <span class="fw-bold">*</span>
                                                ایمیل</label>
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                placeholder="ایمیل" class="form-control  form-control-sm" />
                                            @error('email')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="password">
                                                <span class="fw-bold">*</span>رمز عبور</label>
                                            <input type="password" name="password" value="{{ old('password') }}"
                                                class="form-control  form-control-sm" />
                                            @error('password')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                        <div class="mb-4">
                                            <label class="fw-bold"><span class="fw-bold">*</span>تکرار رمز عبور</label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control  form-control-sm" />
                                            @error('password_confirmation')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="mobile">
                                                <span class="fw-bold">*</span>موبایل</label>
                                            <input type="number" name="mobile" value="{{ old('mobile') }}"
                                                class="form-control  form-control-sm" />
                                            @error('mobile')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 my-2">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="code_meli">
                                                <span class="fw-bold">*</span>کد ملی</label>
                                            <input name="code_meli" value="{{ old('code_meli') }}" type="number"
                                                class="form-control  form-control-sm" />
                                            @error('code_meli')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12 my-2">
                                        <label for="activation" class="fw-bold">
                                            <span class="fw-bold">*</span>وضعیت فعالسازی</label>
                                        <div class="form-group mb-4">
                                            <select name="activation" id="" class="form-control  form-control-sm"
                                                id="activation">
                                                <option disabled selected>وضعیت </option>
                                                <option @if (old('activation') == 0) selected @endif value="0">
                                                    غیرفعال
                                                </option>
                                                <option @if (old('activation') == 1) selected @endif value="1">
                                                    فعال
                                                </option>
                                            </select>
                                            @error('activation')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="profile_photo_path">تصویر</label>
                                            <input name="profile_photo_path" id="profile_photo_path" type="file"
                                                class="form-control  form-control-sm" />
                                            @error('profile_photo_path')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>



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

@section('scripts')
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

        $("#profile_photo_path").change(function() {
            readURL(this);
        });
    </script>
    {!! JsValidator::formRequest('Modules\Admin\Http\Requests\AdminUserRequest') !!}
@endsection
