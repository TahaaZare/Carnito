@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات پست ها</title>
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
                                            کد کاربر
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            نویسنده نظر
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            نظر
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            کد پست
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            پست
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            وضعیت تایید
                                        </th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            وضعیت نظر
                                        </th>
                                        <th
                                            class="text-center text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            تنظیمات </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $key => $comment)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-xs text-center font-weight-bold">{{ $key += 1 }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-xs font-weight-bold">{{ $comment->author_id + 2000 }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-xs font-weight-bold">{{ $comment->author->fullName }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">{!! Str::limit($comment->body, 10, ' ( . . . ) ') !!}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">

                                                <span class="text-xs font-weight-bold">
                                                    {{ $comment->commentable_id + 2000 }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $comment->commentable->name }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($comment->approved == 1)
                                                    <span class="text-xs badge bg-success font-weight-bold">
                                                        تایید شده
                                                    </span>
                                                @else
                                                    <span class="text-xs badge bg-info font-weight-bold">
                                                        در انتظار تایید
                                                    </span>
                                                @endif

                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($comment->status == 1)
                                                    <span class="text-xs badge bg-success font-weight-bold">
                                                        فعال
                                                    </span>
                                                @else
                                                    <span class="text-xs badge bg-danger font-weight-bold">
                                                        غیر فعال
                                                    </span>
                                                @endif
                                                <label>
                                                    <input id="{{ $comment->id }}"
                                                        onchange="changeStatus({{ $comment->id }})"
                                                        data-url="{{ route('admin.content.comment.post-comment.status', $comment->id) }}"
                                                        type="checkbox" @if ($comment->status === 1) checked @endif>
                                                </label>

                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="btn-group">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                        data-coreui-toggle="dropdown" aria-expanded="false">
                                                        بیشتر </button>
                                                    <ul class="dropdown-menu text-center">
                                                        <a href="{{ route('admin.content.product-comment.show', $comment->id) }}"
                                                            class="btn fw-bold btn-info btn-sm text-center my-1 rounded-4">نمایش</a>
                                                            
                                                        @if ($comment->approved == 1)
                                                            <a href="{{ route('content.comment.product-comment.approved', $comment->id) }} "class="btn btn-warning btn-sm"
                                                                type="submit"><i class="fa fa-clock"></i> عدم تایید</a>
                                                        @else
                                                            <a href="{{ route('content.comment.product-comment.approved', $comment->id) }}"
                                                                class="btn btn-success btn-sm text-white" type="submit"><i
                                                                    class="fa fa-check"></i>تایید</a>
                                                        @endif
                                                    </ul>
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

@section('scripts')
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
                            successToast('نظر  با موفقیت فعال شد');
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            element.prop('checked', false);
                            successToast('نظر  با موفقیت غیر فعال شد');
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
