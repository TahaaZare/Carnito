@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')
    <div class="m-4">

        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                           ویرایش دسته {{$category->name}}
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.project-category.index') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                    </section>

                    <section class="card border-0 rounded-4">
                        <section class="card-body">
                            <form id="form" action="{{ route('admin.project-category.update',$category->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <section class="row">
                                    <section class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-group">
                                            <label for="">نام دسته</label>
                                            <input type="text" value="{{ old('name',$category->name) }}" name="name"
                                                class="form-control form-control-sm">
                                        </div>
                                        @error('name')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                        
                                    <section class="col-12">
                                        <button class="btn btn-success btn-block my-2">ثبت</button>
                                    </section>
                                </section>
                            </form>
                        </section>
                    </section>

                </section>
            </section>
        </section>

    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('Modules\Content\Http\Requests\Project\ProjectCategoryRequest') !!}
@endsection
