@extends('dashboard.layout')

@php($sesi = request()->session())

@section('title','Profile')

@section('content')
    <div class="section-body">
        <h2 class="section-title">Hi, {{ ucfirst( $data->name )  }}!</h2>
        <p class="section-lead">
            Change information about yourself on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Terdaftar sejak</div>
                                <div class="profile-widget-item-value">{{ date('d F Y', strtotime( $data->created_at )) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <dl class="row">
                            <dt class="col-sm-3">Username</dt>
                            <dd class="col-sm-9">{{ $data->username }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">Nama</dt>
                            <dd class="col-sm-9">{{ $data->name }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9">{{ $data->email }}</dd>
                        </dl>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ url('reset-password') }}" class="btn btn-warning">
                            <i class="fas fa-lock mr-2"></i> Ganti Password
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form id="formEdit">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="{{ $data->username }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $data->name }}" required="">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $data->email }}">
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let formEdit = $('#formEdit');

        $(document).ready(function () {
            formEdit.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('profile/submit') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Tersimpan',
                                showConfirmButton: false,
                                timer: 1000,
                                onClose: function () {
                                    window.location.reload();
                                }
                            });
                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal Tersimpan',
                                text: 'Pastikan koneksi internet anda tidak bermasalah dan coba kembali. Hubungi WAVE Solusi Indonesia jika tetap bermasalah.',
                            });
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: 'System Error',
                            text: 'Screenshot atau foto halaman ini dan hubungi WAVE Solusi Indonesia',
                        });
                    }
                })
            })
        });
    </script>
@endsection