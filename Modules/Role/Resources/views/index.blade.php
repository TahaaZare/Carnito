@extends('admin.layouts.master')

@section('head-tag')
    <title>نقش های سایت</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            نقش ها
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-primary btn-sm">ایجاد نقش جدید
                        </a>
                    </section>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>نام نقش</th>
                                    <th>توضیحات</th>
                                    <th>وضعیت</th>
                                    <th>دسترسی ها</th>
                                    <th><i class="fa fa-cogs"></i> تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($roles as $key => $role)
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">{{ $key += 1 }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> {{ $role->name }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> {{ $role->description }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($role->status == 1)
                                            <span class="text-xs badge bg-success font-weight-bold">
                                                فعال
                                            </span>
                                        @else
                                            <span class="text-xs badge bg-danger text-white font-weight-bold">
                                                غیر فعال
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if (empty(
                                                $role->permissions()->get()->toArray()
                                            ))
                                            <span class="font-size-badage badge bg-danger d-inline-flex badge-pill">
                                                برای این نقش هیچ دسترسی در نظر نگرفته شده است !
                                            </span>
                                        @else
                                            {{-- @foreach ($role->permissions as $permission) --}}
                                            <span
                                                class="font-size-badage badge bg-success mx-1 my-2 d-inline-flex badge-pill">
                                                {{ $role->permissions->count() }} دسترسی به این نقش داده شده
                                            </span>
                                            <small></small>
                                            {{-- @endforeach --}}
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <a href="{{ route('admin.user.role.role-permission', $role->id) }}"
                                            class="btn btn-sm fw-bold btn-info">
                                            دسترسی ها
                                        </a>
                                        <a href="{{ route('admin.role.edit', $role->id) }}"
                                            class="btn btn-sm fw-bold btn-warning">
                                            ویرایش
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {!! $roles->links() !!}
                </section>
            </section>
        </section>

    </div>
@endsection
