@extends('admin.layouts.master')

@section('head-tag')
    <title>پروژه ها</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            پروژه ها
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.project.create') }}" class="btn btn-primary btn-sm">ایجاد پست
                            </a>
                    </section>
                    <section class="table-responsive">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead class="bg-dark p-2 text-white rounded-3">
                                    <tr class="text-center"> 
                                        <th>#</th>
                                        <th>تصویر</th>
                                        <th>پروژه</th>
                                        <th>دسته بندی</th>
                                        <th>اسلاگ</th>
                                        <th>وضعیت</th>
                                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($projects as $key => $project)
                                        <tr class="text-center">
                                            <th>{{ $key += 1 }}</th>
                                            <td>
                                                <img src="{{ asset($project->image) }}" alt="avatar" class="rounded-3 shadow"
                                                width="90" height="90" class="mt-3">
                                            </td>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->projectCategory->name }}</td>
                                            <td>{{ $project->slug }}</td>
                                            <td class=" text-center">
                                                <label>
                                                    @if ($project->status ==  1)
                                                        <span class="badge bg-success text-white fw-bold text-center rounded-4">فعال</span>
                                                    @endif
                                                    @if ($project->status == 0)
                                                        <span class="badge bg-danger text-white fw-bold text-center rounded-4">غیر فعال</span>
                                                    @endif
                                                </label>
                                            </td>
                                            <td class="width-16-rem text-center">
                                                <div class="d-inline-flex">
                                                    <a href="{{ route('admin.project.edit', $project->id) }}"
                                                        class="btn btn-warning rounded-circle btn-sm m-1 "><i
                                                            class="fa fa-lg fa-edit"></i>
                                                    </a>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div style="margin: 40px !important;"
                            class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                            {!! $projects->links() !!}
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
