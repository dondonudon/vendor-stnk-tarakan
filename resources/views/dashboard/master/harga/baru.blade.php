@extends('dashboard.layout')

@section('title','Master Harga')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Harga Baru</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kode Kendaraan</label>
                                <select class="form-control" name="kode_kendaraan">
                                    @foreach($data as $d)
                                        <option value="{{ $d->kode }}">{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga Notice BBn</label>
                                <input name="harga" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>PNBP</label>
                                <input name="pnbp" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>PPH</label>
                                <input name="pph" type="text" class="form-control">
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
                    url: '{{ url('master/harga/submit') }}',
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
                                    window.location = '{{ url('master/harga') }}';
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
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'System Error',
                            text: 'Silahkan hubungi WAVE Solusi Indonesia',
                        });
                        console.log(response);
                    }
                })
            })
        });
    </script>
@endsection
