@extends('admin.layouts.master')
@section('head-tag')
    <title>پنل ادمین</title>
@endsection
@section('content')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon account">
            <div class="body">
                <h5 class="text-center">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">کاربران سایت</font>
                    </font>
                </h5>
                <hr>
                <div class="row text-center">
                    <div class="col-6">
                        <h6>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{ convertEnglishToPersian($user_list->count()) }} کاربر
                                </font>
                            </font><small class="info">
                            </small>
                        </h6>
                    </div>
                   
                    <div class="col-6">
                        <h6>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{ convertEnglishToPersian($admin_user_list->count()) }} ادمین</font>
                            </font><small class="info">
                            </small>
                        </h6>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
