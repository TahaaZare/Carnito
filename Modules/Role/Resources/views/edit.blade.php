@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش نقش - {{ $role->name }}</title>
    <style>
        input {
            border: 1px solid dashed !important;
        }

        .form-control {
            border: 1px solid dashed !important;
        }
    </style>
@endsection
@section('content')
<div class="m-4">
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد نقش جدید
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.roles') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                </section>
                <section class="card border-0 rounded-4">
                    <section class="card-body bg-white">
                        <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                            @csrf
                            {{ method_field('put') }}
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="name">نام </label>
                                            <input type="text" name="name" value="{{ old('name', $role->name) }}"
                                                placeholder=" نام نقش" class="form-control border" />
                                            @error('name')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="description">توضیحات</label>
                                            <input type="text" name="description"
                                                value="{{ old('description', $role->description) }}"
                                                placeholder="توضیحات" class="form-control border" />
                                            @error('description')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="status" class="fw-bold">وضعیت</label>
                                        <div class="form-group mb-4">
                                            <select name="status" id="" class="form-control border"
                                                id="status">
                                                <option disabled selected>وضعیت </option>
                                                <option @if (old('status', $role->status) == 0) selected @endif
                                                    value="0">غیرفعال
                                                </option>
                                                <option @if (old('status', $role->status) == 1) selected @endif
                                                    value="1">فعال
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row ">
                                <button type="submit" class="btn btn-success fw-bold mt-5 btn-uppercase">
                                    <i class="ti-check-box m-r-5"></i> ثبت
                                </button>
                            </div>
                        </form>
                    </section>
                </section>

            </section>
        </section>
    </section>

</div>
         
@endsection
@section('scripts')
@endsection
