@extends('admin.layouts.master')

@section('head-tag')
    <title>تیم کارنیتو </title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table overflow-auto" tabindex="8">
                <table class="table table-striped">
                    <a href="{{ route('admin.team.create') }}"
                        class="btn btn-outline-primary my-2 rounded text-center">
                        افزودن عضو جدید
                    </a>
                    <thead class="thead-light">
                        <tr class="">
                        
                            <th class="fw-bold text-center align-middle text-dark" scope="col">#</th>
                            <th class="fw-bold text-center align-middle text-dark" scope="col">تصویر</th>
                            <th class="fw-bold text-center align-middle text-dark" scope="col">نام و نام خانوادگی</th>
                            <th class="fw-bold text-center align-middle text-dark" scope="col">نقش عضو </th>
                            <th class="fw-bold text-center align-middle text-dark" scope="col">لینک اینستاگرام</th>
                            <th class="fw-bold text-center align-middle text-dark" scope="col">لینک تلگرام</th>
                            <th class="fw-bold text-center align-middle text-dark" scope="col">وضعیت</th>
                            <th class="fw-bold text-center align-middle text-dark" scope="col">تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $key => $team)
                        <tr class="fw-bold text-center">
                            <th scope="row text-center align-middle text-dark">{{ $key + 1 }}</th>
                            <td class="fw-bold text-center align-middle text-dark">
                                @if ($team->image != null)
                                    <img src="{{ asset($team->image) }}" alt="avatar"
                                        class="rounded-3 shadow" width="100" height="100" class="mt-3">
                                @else
                                    <p class="text-center font-size-badage badge badge-warning fw-bold">
                                        کاربر تصویری ندارد !
                                    </p>
                                @endif
                            </td>
                            <td>{{ $team->first_name }} {{ $team->last_name }}</td>
                            <td class="fw-bold text-center align-middle text-dark">
                                <span class="font-size-badage badge badge-danger d-inline-flex badge-pill">
                                    {{ $team->team_role }}
                                </span>
                            </td>
                            <td class="fw-bold text-center align-middle text-dark">
                                @if ($team->instagram_link == null)
                                    <a disabled target="_blank">
                                        <i style="font-size: 3rem" class="fab fa-instagram"></i>
                                    </a>
                                @else
                                    <a href="{{ $team->instagram_link }}" target="_blank">
                                        <i style="font-size: 3rem" class="fab fa-instagram"></i>
                                    </a>
                                @endif

                            </td>
                            <td class="fw-bold text-center align-middle text-dark">
                                @if ($team->telegram_link == null)
                                    <a disabled target="_blank">
                                        <i style="font-size: 3rem" class="fab fa-telegram"></i>
                                    </a>
                                @else
                                    <a href="{{ $team->telegram_link }}" target="_blank">
                                        <i style="font-size: 3rem" class="fab fa-telegram"></i>
                                    </a>
                                @endif

                            </td>
                            <td class="fw-bold text-center align-middle text-dark">
                                @if ($team->status == 0)
                                    <span class="font-size-badage badge badge-secondary d-inline-flex badge-pill">غیر
                                        فعال</span>
                                @else
                                    <span class="font-size-badage badge badge-success d-inline-flex badge-pill">
                                        فعال</span>
                                @endif
                            </td>
                            <td class="fw-bold text-center align-middle text-dark">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('admin.team.edit', $team->id) }}"
                                            class="btn btn-warning fw-bold btn-block text-center rounded-4 my-1">ویرایش</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                <div style="margin: 40px !important;"
                    class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                    {!! $teams->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function ChangeStatus(id) {
            var element = $('#' + id)
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');


            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            location.reload();
                        } else {
                            element.prop('checked', false);
                            location.reload();
                        }
                    } else {
                        element.prop('checked', elementValue);
                        location.reload();
                    }
                }
            })
        }
    </script>

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
