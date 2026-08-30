<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    @include('admin.layouts.partials.style')
    @include('admin.layouts.partials.script')

</head>

<body>
    <div id="app">
        <div class="main-wrapper">

        @yield('childContent')

        </div>
    </div>

    <!-- Axios -->
    <script src="{{ asset('dist-frontend/js/axios.min.js') }}"></script>
    <script>
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>

    <script src="{{ asset('dist-admin/js/scripts.js') }}"></script>
    <script src="{{ asset('dist-admin/js/custom.js') }}"></script>

    @stack('scripts')

    <!-- Tost Notification -->
     @if (session('success'))
        <script>
            iziToast.success({
                message: "{{ session('success') }}",
                position: 'topRight',
                timeout: 5000,
                progressBarColor: '#00FF00'
            })
        </script>
     @endif

     @if (session('error'))
        <script>
            iziToast.error({
                message: "{{ session('error') }}",
                position: 'topRight',
                timeout: 5000,
                progressBarColor: '#FF0000'
            })
        </script>
     @endif
</body>
</html>