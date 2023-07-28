@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی تیکت ها</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            دسته بندی
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.ticket-category.create') }}" class="btn btn-primary btn-sm">ایجاد دسته
                            بندی</a>
                      
                    </section>
                    <section class="table-responsive">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead class="bg-dark p-2 text-white rounded-3">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>نام دسته بندی</th>
                                        <th>وضعیت</th>
                                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ticketCategories as $key => $ticketCategory)
                                        <tr class="text-center">
                                            <th>{{ $key += 1 }}</th>
                                            <td>{{ $ticketCategory->name }}</td>
                                            <td>
                                                <label>
                                                    @if ($ticketCategory->status === 1)
                                                        <span class="badge bg-success rounded-4">فعال</span>
                                                    @endif
                                                    @if ($ticketCategory->status === 0)
                                                        <span class="badge bg-danger rounded-4">غیر فعال</span>
                                                    @endif
                                                </label>
                                            </td>
                                            <td class="width-16-rem text-center">
                                                <div class="d-inline-flex">
                                                    <a href="{{ route('admin.ticket-category.edit', $ticketCategory->id) }}"
                                                        class="btn btn-warning rounded-circle btn-sm m-1 "><i
                                                            class="fa fa-lg fa-edit"></i>
                                                    </a>
                                                    <form class="d-inline"
                                                        action="{{ route('admin.ticket-category.destroy', $ticketCategory->id) }}"
                                                        method="post">
                                                        @csrf
                                                        {{ method_field('delete') }}
                                                        <button class="btn btn-danger btn-sm delete rounded-circle m-1 "
                                                            type="submit"><i class="fa fa-trash-alt text-white fa-lg"></i>
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
                            {!! $ticketCategories->links() !!}
                        </div>
                    </section>

                </section>
            </section>
        </section>

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
