@extends('admin.layouts.master')

@section('head-tag')
    <title>افزودن نقش ادمین </title>
@endsection

@section('content')
    <section class="row">
        <section class="col-12 mt-5 mb-2 p-2">
            <div class="p-5 bg-white my-2 rounded-6 shadow" dir="rtl">
                <form action="{{ route('admin.user.admin-user.roles.store', $admin) }}" enctype="multipart/form-data"
                    id="form" method="POST">
                    @csrf
                    <div class="row">
                        <section class="col-12">
                            <div class="form-group">
                                <label for="tags">نقش ها</label>
                                <select multiple class="form-control border form-control-sm" id="select_roles" name="roles[]">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @foreach ($admin->roles as $user_role)
                                        @if ($user_role->id === $role->id)
                                        selected
                                        @endif @endforeach>
                                            {{ $role->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('tags')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn text-center btn-primary btn-block my-3">افزودن</button>
                </form>
            </div>
        </section>
    </section>
@endsection

@section('script')

<script>
    var select_roles = $('#select_roles');
    select_roles.select2({
        placeholder: 'لطفا نقش ها را وارد نمایید',
        multiple: true,
        tags : true
    })
</script>

@endsection
