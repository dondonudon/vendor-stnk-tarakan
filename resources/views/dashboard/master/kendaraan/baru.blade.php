@extends('dashboard.layout')

@section('title','Master Kendaraan')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kendaraan Baru</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tipe Kendaraan</label>
                                <input name="tipe_kendaraan" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kode Kendaraan</label>
                                <input name="kode" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Kendaraan</label>
                                <input name="nama" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input name="keterangan" type="text" class="form-control">
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

        $(document).ready(function () {
            $('#listTable').DataTable({
                responsive: true
            });

            formData.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('master/kendaraan/submit') }}',
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
                                    window.location = '{{ url('master/kendaraan') }}';
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
