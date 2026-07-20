<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Home') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('dist-frontend/images/favicon.png') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('dist-frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist-frontend/css/spacing.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist-frontend/css/style.css') }}" />
</head>

<body>
    <!-- Top Bar -->
    @include('frontend.layouts.partials.top-bar')

    <!-- Navigation -->
    @include('frontend.layouts.partials.navbar')

    @yield('content')

    <!-- Newsletter Section -->
    @include('frontend.layouts.partials.newsletter')

    <!-- Footer -->
    @include('frontend.layouts.partials.footer')

    <!-- jQuery -->
    <script src="{{ asset('dist-frontend/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('dist-frontend/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('dist-frontend/js/script.js') }}"></script>
</body>

</html>