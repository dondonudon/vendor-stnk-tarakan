@extends('dashboard.layout')

@section('title','Master Dealer')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Dealer Baru</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Dealer</label>
                                <input name="nama" type="text" class="form-control">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label>Provinsi</label>--}}
{{--                                <input name="provinsi" type="text" class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Kota</label>--}}
{{--                                <input name="kota" type="text" class="form-control">--}}
{{--                            </div>--}}
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
                            <div class="form-group">
                                <label>Alamat</label>
                                <input name="alamat" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Telp</label>
                                <input name="telp" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>PIC Dealer</label>
                                <input name="pic" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Jatuh Tempo (Hari)</label>
                                <input name="jatuh_tempo" type="text" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Harga Jasa</label>
                                        <input id="iHargaJasa" name="harga_jasa" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="iKuitansi">Kuitansi Cetak</label>
                                        <select class="form-control" id="iKuitansi" name="kuitansi">
                                            <option value="1">1 Lembar</option>
                                            <option value="2">2 Lembar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input name="keterangan" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="submit" id="btnBaru" class="btn btn-block btn-success"><i class="fas fa-check mr-2"></i>Simpan</button>
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
        let iHargaJasa = new Cleave('#iHargaJasa', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        $(document).ready(function () {
            $('#listTable').DataTable({
                responsive: true
            });

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

            formData.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('master/dealer/submit') }}',
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
                                    window.location = '{{ url('master/dealer') }}';
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
