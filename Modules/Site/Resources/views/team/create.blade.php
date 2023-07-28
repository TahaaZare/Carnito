@extends('admin.layouts.master')

@section('head-tag')
    <title>افزودن عضو جدید</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
           
            <form action="{{ route('admin.team.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="mb-4">
                                <label class="fw-bold" for="first_name">نام</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder=" نام عضو جدید"
                                    class="form-control" />
                                @error('first_name')
                                    <div class="alert alert-warning text-center rounded-6 my-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="mb-4">
                                <label class="fw-bold" for="last_name">نام خوانوادگی</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder=" نام خوانوادگی عضو جدید"
                                    class="form-control" />
                                @error('last_name')
                                    <div class="alert alert-warning text-center rounded-6 my-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="mb-4">
                                <label class="fw-bold" for="team_role">نقش عضو در تیم</label>
                                <input type="text" name="team_role" value="{{ old('team_role') }}" placeholder=" نام خوانوادگی عضو جدید"
                                    class="form-control" />
                                @error('team_role')
                                    <div class="alert alert-warning text-center rounded-6 my-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-4">
                                <label class="fw-bold" for="instagram_link">لینک اینستاگرام</label>
                                <input type="text" name="instagram_link" value="{{ old('instagram_link') }}"
                                    placeholder="لینک اینستاگرام" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-4">
                                <label class="fw-bold" for="telegram_link">لینک تلگرام</label>
                                <input type="text" name="telegram_link" value="{{ old('telegram_link') }}"
                                    placeholder="لینک تلگرام" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="mb-4">
                                <label class="fw-bold" for="image">تصویر</label>
                                <input name="image" type="file" class="form-control" />
                                @error('image')
                                    <div class="alert alert-warning text-center rounded-6 my-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <label for="status" class="fw-bold">وضعیت</label>
                            <div class="form-group mb-4">
                                <select name="status" id="" class="form-control" id="status">
                                    <option disabled selected>وضعیت</option>
                                    <option @if (old('status') == 0) selected @endif value="0">غیرفعال
                                    </option>
                                    <option @if (old('status') == 1) selected @endif value="1">فعال</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-warning text-center rounded-6 my-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="status" class="fw-bold">بیو</label>
                            <div class="form-group mb-4">
                                <textarea name="bio" id="bio" cols="6" rows="6">{{old('bio')}}</textarea>
                                @error('bio')
                                    <div class="alert alert-warning text-center rounded-6 my-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row ">
                    <button type="submit" class="btn btn-success mt-5 btn-uppercase">
                        <i class="ti-check-box m-r-5"></i> ذخیره
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('admin-assets/ckeditor4/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('bio');
</script>
@endsection
