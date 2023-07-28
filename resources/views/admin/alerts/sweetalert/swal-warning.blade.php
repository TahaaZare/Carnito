@if(session('swal-warning'))

    <script>
        $(document).ready(function (){
            Swal.fire({
                title: 'هشدار !',
                 text: '{{ session('swal-warning') }}',
                 icon: 'warning',
                 confirmButtonText: 'باشه',
      });
        });
    </script>

@endif
