<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} &mdash; @yield('title')</title>

    @include('dashboard._partials.head')
    @yield('style')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        @include('dashboard._partials.navbar')
        @include('dashboard._partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                @include('dashboard._partials.section-header')
                @yield('content')
            </section>
        </div>
        @include('dashboard._partials.footer')
    </div>
    @yield('modal')
</div>

@include('dashboard._partials.footer-script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function Loading(status) {
        switch (status) {
            case 'start':
                Swal.fire({
                    title: 'Loading',
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                break;

            case 'end':
                Swal.close();
                break;
        }
    }
</script>

@yield('script')
</body>
</html>
