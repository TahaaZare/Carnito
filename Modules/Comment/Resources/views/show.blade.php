@extends('admin.layouts.master')

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card text-black">
                        <i class="fa fa-commenting text-info fa-lg pt-3 pb-1 px-3"></i>
                        <div class="card-body">
                            <div class="text-center">
                                <h5 class="card-title">نویسنده : {{ $comment->author->fullName }}
                                </h5>
                                <p class="text-muted mb-4">{{ $comment->commentable->name }} (
                                    {{ convertEnglishToPersian($comment->commentable_id + 2000) }} )
                                </p>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between m-5 rounded-4 shadow shadow-box-soft border p-3">
                                    <p class="text-justify lead container">
                                        متن نظر :
                                        <span class="fw-bold">
                                            {{ $comment->body }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between total fw-bold mt-4">
                                @if ($comment->parent_id == null)
                                    <span>تاریخ :
                                        {{ jalaliDate(convertEnglishToPersian($comment->created_at)) }}</span><span></span>
                                @else
                                    <span>تاریخ :
                                        {{ jalaliDate($comment->created_at) }}</span><span></span>
                                @endif

                            </div>
                            <hr>
                            @if ($comment->parent_id == null)
                                <section>
                                    <div class="m-5">
                                        <form action="{{ route('admin.content.comment.post-answer', $comment->id) }}"
                                            method="post">
                                            @csrf
                                            <label for="answer">پاسخ ادمین</label>
                                            <textarea name="body" type="text" name="answer" rows="6" class="form-control p-2 border">{{ old('body') }}</textarea>
                                            <button type="submit" class="btn btn-block btn-success my-2">ثبت</button>
                                        </form>
                                    </div>
                                </section>
                            @endif


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('Modules\Comment\Http\Requests\CommentRequest') !!}
@endsection
