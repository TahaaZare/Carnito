@extends('admin.layouts.master')


@section('head-tag')
    @php
        $user = auth()->user();
    @endphp
    <title>
        پروفایل - {{ $user->username }}
    </title>
    <style>
        input,
        textarea {
            border-radius: 2rem !important;
        }
    </style>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card mcard_3">
                <div class="header l-cyan">
                </div>
                <div class="body">
                    <div class="member-img">
                        @if ($user->profile_photo_path == null)
                            <a><img src="{{ asset('static-img/user-avatar.png') }}" width="100" height="100"
                                    class="rounded-circle img-raised" alt="نمایه-تصویر"></a>
                        @else
                            <a><img src="{{ asset($user->profile_photo_path) }}" width="100" height="100"
                                    class="rounded-circle img-raised" alt="نمایه-تصویر"></a>
                        @endif

                    </div>
                    <br>
                    <p class="text-muted">
                        @if ($user->first_name != null || $user->last_name != null)
                            {{ $user->full_name }} خوش آمدید
                            <br>
                            <small class="text-muted fw-bolder font-weight-bold">
                                تاریخ ثبت نام : {{ convertEnglishToPersian(jalaliAgo($user->created_at)) }} -
                                {{ convertEnglishToPersian(jalaliDate($user->created_at)) }}
                            </small>
                        @else
                            خوش آمدید
                            <br>

                            <small class="text-muted fw-bolder font-weight-bold">
                                تاریخ ثبت نام : {{ convertEnglishToPersian(jalaliAgo($user->created_at)) }} -
                                {{ convertEnglishToPersian(jalaliDate($user->created_at)) }}
                            </small>
                        @endif
                    </p>
                    <hr>
                    @if ($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif
                </div>

            </div>

        </div>
        <!-- /Orders List -->
    </div>
    <!-- /Container -->
    </div>
    <!-- /Main section -->
    </div>
    <!-- /Main wrapper -->
    </div>
    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <form class="row" enctype="multipart/form-data" method="post"
                action="{{ route('customer.profile.profile.update') }}">
                @csrf
                {{ method_field('put') }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="editProfileLabel">ویرایش حساب</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if ($user->profile_photo_path == null)
                                <div class="col-12">
                                    <div class="member-img">
                                        <a><img id="imageUp" src="{{ asset('static-img/user-avatar.png') }}"
                                                width="100" height="100" class="rounded-circle img-raised"
                                                alt="نمایه-تصویر"></a>
                                    </div>
                                </div>
                            @else
                                <div class="col-12">
                                    <div class="member-img">
                                        <a><img id="imageUp" src="{{ asset($user->profile_photo_path) }}" width="100"
                                                height="100" class="rounded-circle img-raised" alt="نمایه-تصویر"></a>
                                    </div>
                                </div>
                            @endif
                            <div class="col-6">
                                <label for="first_name">نام</label>
                                <input type="text" class="form-control rounded-5" name="first_name"
                                    value="{{ old('first_name', $user->first_name) }}">
                            </div>
                            <div class="col-6">
                                <label for="last_name">نام خانوادگی</label>
                                <input type="text" class="form-control rounded-5" name="last_name"
                                    value="{{ old('last_name', $user->last_name) }}">
                            </div>
                            <div class="col-6">
                                <label for="code_meli">کد ملی</label>
                                <input type="text" class="form-control rounded-5" name="code_meli"
                                    value="{{ old('code_meli', $user->code_meli) }}">
                            </div>
                            <div class="col-6">
                                <label for="job">شغل</label>
                                <input type="text" class="form-control rounded-5" name="job"
                                    value="{{ old('job', $user->job) }}">
                            </div>
                            <div class="col-12">
                                <label for="profile_photo_path">تصویر پروفایل</label>
                                <input type="file" name="profile_photo_path" class="form-control rounded-5"
                                    id="profile_photo_path">
                            </div>
                            <div class="col-12">
                                <label for="adderss">آدرس</label>
                                <textarea type="text" rows="6" class="form-control rounded-5" name="adderss">{{ old('adderss', $user->adderss) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-round waves-effect">ثبت
                            تغییرات
                        </button>
                        <button type="button" class="btn btn-danger btn-round  waves-effect"
                            data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageUp').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profile_photo_path").change(function() {
            readURL(this);
        });
    </script>
    {!! JsValidator::formRequest('Modules\Site\Http\Requests\User\UpdateProfileRequest') !!}
@endsection
