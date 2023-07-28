@extends('admin.layouts.master')

@section('head-tag')
    <title>افزودن سطح دسترسی ادمین </title>
@endsection

@section('content')

    <section class="row">
        <section class="col-12 mt-5 mb-2 p-2">
            <div class="p-5 bg-white my-2 rounded-6 shadow" dir="rtl">
                <form action="{{ route('admin.user.admin-user.permissions.store', $admin) }}" enctype="multipart/form-data"
                    id="form" method="POST">
                    @csrf
                    <div class="row">
                        <section class="col-12">
                            <div class="form-group">
                                <label for="tags">دسترسی ها</label>
                                <select multiple class="form-control border rounded form-control-sm" id="select_permissions" name="permissions[]">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}"
                                            @foreach ($admin->permissions as $user_permission)
                                        @if ($user_permission->id === $permission->id)
                                        selected
                                        @endif @endforeach>
                                            {{ $permission->description }}</option>
                                    @endforeach
                                </select>
                            </div>
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
    var select_permissions = $('#select_permissions');
    select_permissions.select2({
        placeholder: 'لطفا سطوح دسترسی ها را وارد نمایید',
        multiple: true,
        tags : true
    })
</script>

@endsection
