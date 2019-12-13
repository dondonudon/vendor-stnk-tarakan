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
    <title>{{ config('app.name') }} &mdash; {{ request()->segment(1) }}</title>

    @include('dashboard._partials.head')
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-3">
            <div class="row justify-content-center">
{{--                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">--}}
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-5">
                    <div class="login-brand">
                        <img src="{{ asset('assets/img/logo-lg.png') }}" alt="logo" width="100">
                        <p class="mt-3">{{ config('app.name') }}</p>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header"><h4>Login</h4></div>

                        <div class="card-body">
                            <form id="formLogin" class="needs-validation" novalidate="">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        Please fill in your username
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                    <div class="invalid-feedback">
                                        please fill in your password
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button id="btnSubmit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                    <div id="loading" class="spinner-border text-primary d-none" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </form>
{{--                            <hr>--}}
{{--                            <div class="text-center mt-4 mb-3">--}}
{{--                                <div class="text-job text-muted">Login With Social</div>--}}
{{--                            </div>--}}
{{--                            <div class="row justify-content-center">--}}
{{--                                <div class="col-lg-6 col-sm-12">--}}
{{--                                    <button class="btn btn-danger btn-block">--}}
{{--                                        <i class="fab fa-google mr-3"></i> Google--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </div>
                    <div class="simple-footer">
                        <i class="fas fa-copyright"></i> {{ date('Y') }} {{ config('app.name') }}
                        <p>
                            Developed by <a href="http://waveitsolution.com">{{ config('app.developer') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('dashboard._partials.footer-script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    let formLogin = $('#formLogin');
    let btnSubmit = $('#btnSubmit');
    let loading = $('#loading');

    $(document).ready(function () {
        formLogin.submit(function (e) {
            btnSubmit.addClass('d-none');
            loading.removeClass('d-none');
            e.preventDefault();
            $.ajax({
                url: '{{ url('login/submit') }}',
                method: 'post',
                data: $(this).serialize(),
                success: function (response) {
                    if (response === 'success') {
                        btnSubmit.removeClass('d-none');
                        loading.addClass('d-none');
                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 800,
                            onClose: function () {
                                window.location = '{{ url('/') }}';
                            }
                        });
                    } else {
                        btnSubmit.removeClass('d-none');
                        loading.addClass('d-none');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Login Failed',
                        });
                        console.log(response);
                    }
                },
                error: function (response) {
                    console.log(response);
                    btnSubmit.removeClass('d-none');
                    loading.addClass('d-none');
                    Swal.fire({
                        icon: 'error',
                        title: 'System error',
                        text: 'Silahkan coba lagi atau hubungi WAVE Solusi Indonesia',
                    });
                }
            });
        });
    });
</script>
</body>
</html>
