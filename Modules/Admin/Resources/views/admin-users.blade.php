@extends('admin.layouts.master')

@section('head-tag')
    <title>ادمین های سایت</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        @if ($dNone == false)
                            <a href="{{ route('admin.admin-user.create') }}" class="btn btn-primary btn-sm">ایجاد ادمین جدید
                            </a>
                        @endif
                        <div class="max-width-16-rem">
                            <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                        </div>
                    </section>
                    <section class="table-responsive">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead class="bg-dark text-center p-2 text-white rounded-3">
                                    <tr class="text-center">
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            تصویر
                                        </th>
                                        <th>
                                            نام و نام خوانوادگی
                                        </th>

                                        <th>
                                            ایمیل
                                        </th>
                                        <th>
                                            شماره تماس </th>
                                            <th>
                                                وضعیت کاربر </th>
                                        <th>
                                            وضعیت </th>
                                        <th>
                                            نقش ها </th>
                                        <th>
                                            سطوح دسترسی کاربر
                                        </th>
                                        <th>
                                            تنظیمات </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody class="bg-info">
                                    @foreach ($admins as $key => $admin)
                                        <tr class="text-center">
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">{{ $key += 1 }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if ($admin->profile_photo_path == null)
                                                            <img src="{{ asset('static-img/user-avatar.png') }}"
                                                                class="avatar ms-3" width="100" height="100">
                                                        @else
                                                            <img src="{{ asset($admin->profile_photo_path) }}"
                                                                class="avatar ms-3" width="100" height="100">
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $admin->fullName }} </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $admin->email }} </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $admin->mobile }} </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('admin.user.is-author', $admin->id) }}"
                                                    class="btn row btn-sm btn-primary">
                                                    @if ($admin->is_author == 1)
                                                        تغییر وضعیت به کاربر
                                                    @else
                                                        تغییر وضعیت به نویسنده
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($admin->status == 1)
                                                    <span class="text-xs badge bg-success font-weight-bold">
                                                        فعال
                                                    </span>
                                                @else
                                                    <span class="text-xs text-white badge bg-danger font-weight-bold">
                                                        غیر فعال
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">
                                                    @forelse($admin->roles as $role)
                                                        <div>
                                                            <span
                                                                class="badge bg-info font-size-badage border rounded-6 text-center fw-bold">
                                                                {{ $role->name }}
                                                            </span>

                                                        </div>
                                                    @empty
                                                        <div class="text-danger">
                                                            نقشی یافت نشد
                                                        </div>
                                                    @endforelse
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @forelse($admin->permissions as $permission)
                                                    <span
                                                        class="badge bg-info font-size-badage my-1 border rounded-6 text-center fw-bold">
                                                        {{ $permission->description }}
                                                    </span>
                                                @empty
                                                    <div class="text-danger">
                                                        دسترسی یافت نشد
                                                    </div>
                                                @endforelse
                                            </td>
                                            <td class="align-middle text-center text-sm">

                                                <a href="{{ route('admin.admin-user.edit', $admin->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    ویرایش
                                                </a>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        بیشتر
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('admin.user.admin-user.roles', $admin->id) }}"
                                                            class="fw-bold dropdown-item text-center  rounded-4">نقش</a>
                                                        <a href="{{ route('admin.user.admin-user.permissions', $admin->id) }}"
                                                            class="fw-bold dropdown-item  text-center  rounded-4">سطوح
                                                            دسترسی</a>
                                                    </div>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div style="margin: 40px !important;"
                            class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                            {!! $admins->links() !!}
                        </div>
                    </section>

                </section>
            </section>
        </section>

    </div>
@endsection
