@extends('dashboard.layout')

@section('title','Master User')

@php
    $menu = \App\Http\Controllers\c_Dashboard::sidebar();
@endphp

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit User</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="edit">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input name="username" type="text" class="form-control" value="{{ $data->username }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input name="name" type="text" class="form-control" value="{{ $data->name }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control" value="{{ $data->email }}">
                                <small>
                                    Anda tidak harus mengisi email.
                                    <br>Email dengan akhiran gmail.com dapat digunakan untuk login menggunakan google akun. User dapat menambah email secara mandiri melalui menu User Profile.
                                </small>
                            </div>
                            <hr>
                            <h5>Permission</h5>
                            @foreach($menu as $g)
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h6 class="ml-5">{{ $g['group']['name'] }}</h6>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            @foreach($g['menu'] as $m)
                                                <div class="col-lg-4">
                                                    <div class="custom-control custom-checkbox">
                                                        @if(in_array($m['id'],$check))
                                                            <input type="checkbox" name="permission[]" class="custom-control-input" id="permission_{{ $m['id'] }}" value="{{ $m['id'] }}" checked>
                                                        @else
                                                            <input type="checkbox" name="permission[]" class="custom-control-input" id="permission_{{ $m['id'] }}" value="{{ $m['id'] }}">
                                                        @endif
                                                        <label class="custom-control-label" for="permission_{{ $m['id'] }}">{{ $m['name'] }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="button" class="btn btn-block btn-outline-danger" onclick="window.location = '{{ url('master/user-management') }}'">
                                        <i class="fas fa-times mr-2"></i>Cancel
                                    </button>
                                </div>
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="submit" id="btnBaru" class="btn btn-block btn-success">
                                        <i class="fas fa-check mr-2"></i>Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let formData = $('#formData');

        $(document).ready(function () {
            $('#listTable').DataTable({
                responsive: true
            });

            formData.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('master/user-management/submit') }}',
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
                                    window.location = '{{ url('master/user-management') }}';
                                }
                            });
                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Gagal Tersimpan',
                                text: 'Silahkan coba lagi atau hubungi WAVE Solusi Indonesia',
                            });
                        }
                    }
                })
            })
        });
    </script>
@endsection
