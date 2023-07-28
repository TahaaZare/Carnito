@if (session('swal-success') && session('swal-title'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: '{{ session('swal-title') }}',
                text: '{{ session('swal-success') }}',
                icon: 'success',
                confirmButtonText: 'باشه',
            });
        });
    </script>
@elseif (session('swal-success'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'عملیات با موفقیت انجام شد',
                text: '{{ session('swal-success') }}',
                icon: 'success',
                confirmButtonText: 'باشه',
            });
        });
    </script>
@endif
