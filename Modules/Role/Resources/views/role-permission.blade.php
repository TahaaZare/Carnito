@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسترسی نقش</title>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('admin.user.role.updateRolePermission', $role->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <hr>
                    <section class="col-12">
                        <section class="row border-top mt-3 py-3  bg-light p-3 rounded-2 shadow">
                            <h6 class="fw-bold my-2 text-secondary">دسترسی های نقش : <span class="mx-2 text-primary">
                                    {{ $role->name }}</span></h6>
                            @php
                                $rolePermissionArray = $role->permissions->pluck('id')->toArray();
                            @endphp
                            @foreach ($permissions as $key => $permission)
                                <section class="col-md-3 fw-bold p-3">
                                    <div class="form-check rounded-2 p-1">
                                        <label for="{{ $permission->id }}" class="form-check-label">
                                            {{ $key += 1 }} - {{ $permission->description }}
                                        </label>
                                        <input type="checkbox"  class="justify-content-center mx-3 form-check-input"
                                            name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->id }}"
                                            @if (in_array($permission->id, $rolePermissionArray)) checked @endif>
                                    </div>
                                    <div class="mt-2">
                                        @error('permissions.' . $key)
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </div>
                                </section>
                            @endforeach
                        </section>
                        <hr>

                    </section>
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
@endsection
