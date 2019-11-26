@extends('dashboard.layout')

@section('title','Master Harga')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Dealer</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="edit">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="iTipeKendaraan">Tipe Kendaraan</label>
                                <select id="iTipeKendaraan" class="form-control" name="kode_kendaraan">
                                    @foreach($kendaraan as $k)
                                        <option value="{{ $k->kode }}">{{ $k->kode.' - '.$k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="iHarga">Harga Notice BBn</label>
                                <input id="iHarga" name="harga" type="text" class="form-control" value="{{ $data->harga }}">
                            </div>
                            <div class="form-group">
                                <label for="iPnbp">PNBP</label>
                                <input id="iPnbp" name="pnbp" type="text" class="form-control" value="{{ $data->pnbp }}">
                            </div>
                            <div class="form-group">
                                <label for="iPph">PPH</label>
                                <input id="iPph" name="pph" type="text" class="form-control" value="{{ $data->pph }}">
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="button" class="btn btn-block btn-outline-danger" onclick="window.location = '{{ url('master/samsat') }}'">
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
        let iTipeKendaraan = $('#iTipeKendaraan');
        let iHargaNotice = new Cleave('#iHarga', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        let iPnbp = new Cleave('#iPnbp', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        let iPph = new Cleave('#iPph', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        $(document).ready(function () {
            iTipeKendaraan.val('{{ $data->kode_kendaraan }}');

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
                    }
                })
            })
        });
    </script>
@endsection
