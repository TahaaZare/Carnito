@extends('admin.layouts.master')

@section('head-tag')
    <title>نقش جدید</title>
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
                        <section class="card-body">
                            <form id="form" action="{{ route('admin.role.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="name">نام </label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                placeholder=" نام نقش" class="form-control border" />
                                            @error('name')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-4">
                                            <label class="fw-bold" for="description">توضیحات</label>
                                            <input type="text" name="description" value="{{ old('description') }}"
                                                placeholder="توضیحات" class="form-control border" />
                                            @error('description')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <label for="status" class="fw-bold">وضعیت</label>
                                        <div class="form-group mb-4">
                                            <select name="status" id="" class="form-control border"
                                                id="status">
                                                <option disabled selected>وضعیت </option>
                                                <option @if (old('status') == 0) selected @endif value="0">
                                                    غیرفعال
                                                </option>
                                                <option @if (old('status') == 1) selected @endif value="1">
                                                    فعال
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="badage bg-warning text-center text-white rounded">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <section class="col-12">
                                        <section class="row border-top mt-3 py-3  bg-light p-3 rounded-2 shadow">
                                            <h6 class="fw-bold my-2 text-secondary">دسترسی های نقش</h6>
                                            @foreach ($permissions as $key => $permission)
                                                <section class="col-md-3 fw-bold p-3">
                                                    <div class="form-check">
                                                            <label for="{{ $permission->id }}"
                                                                class="form-check-label mx-3 mt-1">
                                                                {{ $key += 1 }} - {{ $permission->description }}
                                                            </label>
                                                        <input type="checkbox"
                                                            class="justify-content-center  form-check-input"
                                                            name="permissions[]" value="{{ $permission->id }}"
                                                            id="{{ $permission->id }}">
                                                    </div>
                                                    <div class="mt-2">
                                                        @error('permissions.' . $key)
                                                            <span class="alert_required bg-danger text-white p-1 rounded"
                                                                role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </section>
                                            @endforeach
                                        </section>
                                        <section class="col-12 my-5">
                                            <button class="btn btn-success btn-block my-2">ثبت</button>
                                        </section>
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
