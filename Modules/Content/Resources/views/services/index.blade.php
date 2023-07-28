@extends('admin.layouts.master')

@section('head-tag')
    <title>سرویس ها</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            سرویس ها
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        @php
                            $user = auth()->user();
                        @endphp
                        @if ($user->can('create-service'))
                            <a href="{{ route('admin.service.create') }}" class="btn btn-primary text-center rounded">
                                افزودن
                            </a>
                        @endif
                    </section>
                    <section class="table-responsive">
                        <div class="table-responsive-md">
                            <table class="table table-striped">
                                <thead class="bg-dark p-2 text-white rounded-3">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>آیکون</th>
                                        <th>اسم سرویس</th>
                                        <th>توضیحات</th>
                                        <th>وضعیت</th>
                                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($services as $key => $service)
                                        <tr class="text-center text-dark">
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold">{{ $key += 1 }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold">
                                                    <img src="{{ asset($service->image) }}" alt="icon"
                                                        class="rounded-3 shadow" width="90" height="90"
                                                        class="mt-3">
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold">
                                                    {{ $service->name }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold">
                                                    {!! Str::limit($service->description, 30, ' ( . . . ) ') !!}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold">
                                                    @if ($service->status === 1)
                                                        <span
                                                            class="badge bg-success text-white fw-bold text-center rounded-4">فعال</span>
                                                    @endif
                                                    @if ($service->status === 0)
                                                        <span
                                                            class="badge bg-danger text-white fw-bold text-center rounded-4">غیر
                                                            فعال</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('admin.service.edit', $service->id) }}"
                                                    class="btn btn-warning rounded-5 fw-bold">
                                                    ویرایش
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div style="margin: 40px !important;"
                            class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                            {{ $services->links() }}
                        </div>
                    </section>

                </section>
            </section>
        </section>

    </div>
@endsection

@section('scripts')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
