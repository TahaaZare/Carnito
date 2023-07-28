@extends('admin.layouts.master')

@section('head-tag')
    <title>پیام ها</title>
@endsection

@section('content')
    @php
        $user = auth()->user();
    @endphp
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            پیام ها
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    </section>
                    <section class="table-responsive">
                        <div class="table-responsive-md">
                            <table class="table table-striped">
                                <thead class="bg-dark p-2 text-white rounded-3">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>اسم</th>
                                        <th>ایمیل</th>
                                        <th>موضوع</th>
                                        <th>تاریخ ثبت</th>
                                        @if ($user->can('show-messages'))
                                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($messages as $key => $message)
                                        <tr class="text-center text-dark">
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold">{{ $key += 1 }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold"> {{ $message->name }} </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold"> {{ $message->email }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold"> {{ $message->subject }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold"> {{ jalaliAgo($message->created_at) }} -
                                                    {{ jalaliDate($message->created_at) }}</span>
                                            </td>
                                            @if ($user->can('show-messages'))
                                                <td class="align-middle text-center text-sm">
                                                    <a href="{{ route('admin.contactus.show', $message->id) }}"
                                                        class="btn btn-warning rounded-5 fw-bold">
                                                        نمایش
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div style="margin: 40px !important;"
                            class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                            {!! $messages->links() !!}
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
