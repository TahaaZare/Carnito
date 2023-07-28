@extends('admin.layouts.master')

@section('head-tag')
    <title>درباره ما</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            درباره ما
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
                                        <th>متن</th>
                                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($messages as $key => $message)
                                        <tr class="text-center text-dark">
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold">{{ $key += 1 }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs fw-bold">
                                                    {!! Str::limit($message->text, 30, ' ( . . . ) ') !!}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('admin.about-us.edit', $message->id) }}"
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
