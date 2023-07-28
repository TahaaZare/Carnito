@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ها</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <a href="{{route('customer.profile.my-tickets.create')}}"
                 class="btn btn-sm btn-primary rounded">
                    ایجاد تیکت جدید
                </a>
                <table class="table table-hover c_table theme-color">
                    <thead>
                        <tr class="text-center">
                            <th>
                                #
                            </th>
                            <th>
                                عنوان تیکت
                            </th>
                            <th>
                                دسته تیکت
                            </th>
                            <th>
                                اولویت تیکت
                            </th>
                            <th>
                                ارجاع شده از
                            </th>
                           
                            <th>
                                وضعیت تیکت
                            </th>
                            <th>
                                تنظیمات
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach  ($tickets as $key => $ticket)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs text-center font-weight-bold">{{ $key += 1 }}</span>
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
                                    <a href="{{ route('customer.profile.show-ticket', $ticket->id) }}"
                                        class="btn fw-bold shadow border text-white btn-info btn-sm  text-center my-1 rounded-4">نمایش</a>
                                    @if ($ticket->status == 0)
                                        <a href="{{ route('customer.profile.change', $ticket->id) }}"
                                            class="btn  {{ $ticket->status == 1 ? 'btn-warning' : 'btn-danger' }}  btn-sm">
                                            <i class="fa {{ $ticket->status == 1 ? 'fa-check' : 'fa-times' }}"></i>
                                            {{ $ticket->status == 1 ? 'باز کردن' : 'بستن' }}</a>
                                    @endif
                                </td>
                            </tr>
                         
                        @endforeach

                    </tbody>
                </table>
                <ul class="pagination pagination-primary mt-4">
                    {{-- {!! $tickets->links('pagination::bootstrap-5') !!} --}}
                </ul>
            </div>
        </div>
    </div>
@endsection
