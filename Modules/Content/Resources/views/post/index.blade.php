@extends('admin.layouts.master')

@section('head-tag')
    <title>پست ها</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            پست ها
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.content.post.create') }}" class="btn btn-primary btn-sm">ایجاد پست
                            </a>
                    </section>
                    <section class="table-responsive">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead class="bg-dark p-2 text-white rounded-3">
                                    <tr class="text-center"> 
                                        <th>#</th>
                                        <th>تصویر</th>
                                        <th>نام پست </th>
                                        <th>نویسنده</th>
                                        <th>دسته بندی</th>
                                        <th>اسلاگ</th>
                                        <th>تگ ها</th>
                                        <th>تاریخ انتشار</th>
                                        <th>وضعیت</th>
                                        <th>امکان گذاشتن کامنت</th>
                                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($posts as $key => $post)
                                        <tr class="text-center">
                                            <th>{{ $key += 1 }}</th>
                                            <td>
                                                <img src="{{ asset($post->image) }}" alt="avatar" class="rounded-3 shadow"
                                                width="90" height="90" class="mt-3">
                                            </td>
                                            <td>{{ $post->name }}</td>
                                            <td>{{ $post->author->first_name }} {{$post->author->last_name}}</td>
                                            <td>{{ $post->postCategory->name }}</td>
                                            <td>{{ $post->slug }}</td>
                                            <td>{{ $post->tags }}</td>
                                            <td class="fw-bold">{{ $post->published_at }}</td>
                                            <td class=" text-center">
                                                <label>
                                                    @if ($post->status === 1)
                                                        <span class="badge bg-success text-white fw-bold text-center rounded-4">فعال</span>
                                                    @endif
                                                    @if ($post->status === 0)
                                                        <span class="badge bg-danger text-white fw-bold text-center rounded-4">غیر فعال</span>
                                                    @endif
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label>
                                                    @if ($post->comment_able === 1)
                                                        <span class="badge bg-success text-white fw-bold text-center rounded-4">فعال</span>
                                                    @endif
                                                    @if ($post->comment_able === 0)
                                                        <span class="badge bg-danger text-white fw-bold text-center rounded-4">غیر فعال</span>
                                                    @endif
                                                </label>
                                            </td>
                                            <td class="width-16-rem text-center">
                                                <div class="d-inline-flex">
                                                    <a href="{{ route('show.blog', $post) }}"
                                                        class="btn btn-info rounded-circle btn-sm m-1 ">
                                                        نمایش
                                                    </a>
                                                    <a href="{{ route('admin.content.post.edit', $post->id) }}"
                                                        class="btn btn-warning rounded-circle btn-sm m-1 "><i
                                                            class="fa fa-lg fa-edit"></i>
                                                    </a>
                                                    <form class="d-inline"
                                                        action="{{ route('admin.content.post.destroy', $post->id) }}"
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
                            {!! $posts->links() !!}
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
