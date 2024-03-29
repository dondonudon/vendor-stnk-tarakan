@extends('dashboard.layout')

@section('title','Master Samsat')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Samsat Baru</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Samsat</label>
                                <input name="nama" type="text" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select id="iProvinsi" name="provinsi" style="width: 100%" required></select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <select id="iKota" name="kota" style="width: 100%" required></select>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label>Provinsi</label>--}}
{{--                                <input name="provinsi" type="text" class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Kota</label>--}}
{{--                                <input name="kota" type="text" class="form-control">--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label>Alamat</label>
                                <input name="alamat" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="submit" class="btn btn-block btn-success"><i class="fas fa-check mr-2"></i>Simpan</button>
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
        let iProvinsi = $('#iProvinsi');
        let iKota = $('#iKota');

        $(document).ready(function () {
            iProvinsi.select2({
                ajax: {
                    url: '{{ url('data/wilayah-provinsi') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });
            iKota.select2({
                ajax: {
                    url: '{{ url('data/wilayah-kota') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            provinsi: iProvinsi.val(),
                            search: params.term,
                        }
                    }
                }
            });

            $('#listTable').DataTable({
                responsive: true
            });

            formData.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('master/samsat/submit') }}',
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
                                    window.location = '{{ url('master/samsat') }}';
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
