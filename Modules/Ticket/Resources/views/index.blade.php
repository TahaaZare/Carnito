@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ها </title>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row my-4">
            <div class="col-lg-12 col-md-12">
                <div class="bg-white p-2 rounded-3">
                    <div class=" p-0 pb-2">
                        <div class="table-responsive-md">
                            <table class="table align-items-center mb-0">
                                <thead class="bg-light rounded-3">
                                    <tr>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            نویسنده تیکت
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            عنوان تیکت
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            دسته تیکت
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            اولویت تیکت
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            ارجاع شده از
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            مرجوعی از
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            وضعیت تیکت
                                        </th>
                                        <th
                                            class="text-center text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            تنظیمات </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $key => $ticket)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-xs text-center font-weight-bold">{{ $key += 1 }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">{{ $ticket->user->fullName }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">{{ $ticket->subject }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">
                                                    {{ $ticket->category->name }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">

                                                <span class="fw-bold">
                                                    {{ $ticket->priority->name }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="fw-bold">
                                                    {{ $ticket->parent->subject ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">
                                                    {{ $ticket->admin ? $ticket->admin->user->fullName : 'نامشخص' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($ticket->status == 1)
                                                    <span
                                                        class="shadow p-2 border badge bg-danger rounded-5  text-white border font-weight-bold">
                                                        بسته شده
                                                    </span>
                                                @else
                                                    <span
                                                        class="shadow p-2 border badge bg-info fw-bold rounded-5  text-white border font-weight-bold">
                                                        باز
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        بیشتر
                                                    </button>
                                                    <div class="dropdown-menu p-5">
                                                        <a href="{{ route('admin.ticket.show', $ticket->id) }}"
                                                            class="btn fw-bold shadow border text-white btn-info btn-sm text-center my-1 rounded-4">نمایش</a>
                                                        @if ($ticket->status == 1)
                                                            <span
                                                                class="text-xs badge bg-warning text-white border font-weight-bold">
                                                                باز کردن تیکت
                                                            </span>
                                                        @else
                                                            <span
                                                                class="text-xs badge bg-danger text-white border font-weight-bold">
                                                                بستن تیکت
                                                            </span>
                                                        @endif
                                                        <label>
                                                            <input id="{{ $ticket->id }}"
                                                                onchange="changeStatus({{ $ticket->id }})"
                                                                data-url="{{ route('admin.ticket.change', $ticket->id) }}"
                                                                type="checkbox" class="form-check-input">
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function changeStatus(id) {
            var element = $("#" + id)
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('تیکت  با موفقیت بسته شد');
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            element.prop('checked', false);
                            successToast('تیکت  با موفقیت باز شد');
                            setTimeout(() => window.location.reload(), 1000);
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است')
                    }
                },
                error: function() {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });

            function successToast(message) {

                var successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                })
            }

            function errorToast(message) {

                var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                })
            }
        }
    </script>
@endsection
