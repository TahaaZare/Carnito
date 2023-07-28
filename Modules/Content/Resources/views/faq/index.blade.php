@extends('admin.layouts.master')

@section('head-tag')
    <title>سوالات متداول</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            سوالات متداول
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.content.faq.create') }}" class="btn btn-primary btn-sm">ایجاد سوال
                            </a>
                        <div class="max-width-16-rem">
                            <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                        </div>
                    </section>
                    <section class="table-responsive">
                        <div class="table-responsive-md">
                            <table class="table table-striped">
                                <thead class="bg-dark p-2 text-white rounded-3">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th> سوال </th>
                                        <th>جواب</th>
                                        <th>تگ ها</th>
                                        <th>وضعیت</th>
                                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($faqs as $key => $faq)
                                        <tr class="text-center text-dark">
                                            <th>{{ $key += 1 }}</th>
                                            <td>{{ $faq->question }}</td>
                                            <td>
                                                {!! Str::limit($faq->awnser, 20, ' ( . . . ) ') !!}
                                            </td>
                                            <td>{{ $faq->tags }}</td>
                                            <td>
                                                <label>
                                                    @if ($faq->status === 1)
                                                        <span class="badge bg-success rounded-4">فعال</span>
                                                    @endif
                                                    @if ($faq->status === 0)
                                                        <span class="badge bg-danger text-white rounded-4">غیر فعال</span>
                                                    @endif
                                                </label>
                                            </td>
                                            <td class="width-16-rem text-center">
                                                <div class="d-inline-flex">
                                                    <a href="{{ route('admin.content.faq.edit', $faq->id) }}"
                                                        class="btn btn-warning rounded-4 btn-sm m-1 ">ویرایش
                                                    </a>
                                                    <form class="d-inline"
                                                        action="{{ route('admin.content.faq.destroy', $faq->id) }}"
                                                        method="post">
                                                        @csrf
                                                        {{ method_field('delete') }}
                                                        <button class="btn btn-danger btn-sm delete rounded-4  m-1 "
                                                            type="submit">حذفـ
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div style="margin: 40px !important;"
                            class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                            {!! $faqs->links() !!}
                        </div>
                    </section>

                </section>
            </section>
        </section>

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
                        if (response.checked)
                            element.prop('checked', true);
                        else
                            element.prop('checked', false);
                    }
                    else {
                        element.prop('checked', elementValue);
                    }
                }
            })
        }
    </script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
