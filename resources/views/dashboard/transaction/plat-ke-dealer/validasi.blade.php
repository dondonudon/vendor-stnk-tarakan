@extends('dashboard.layout')

@section('title','Transaction - PLAT No ke Dealer')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Info PO</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <address>
                                    <strong>No Purchase Order</strong>
                                    <br>{{ $data['mst']->no_po }}
                                </address>
                                <address>
                                    <strong>Tanggal Purchase Order</strong>
                                    <br>{{ $data['mst']->tgl_po }}
                                </address>
                                <address>
                                    <strong>Total Purchase Order</strong>
                                    <br>Rp {{ number_format($data['mst']->total,2) }}
                                </address>
                            </div>
                            <div class="col-md-4">
                                <address>
                                    <strong>Dealer</strong>
                                    <br>{{ $data['mst']->dealer }}
                                </address>
                                <address>
                                    <strong>Samsat</strong>
                                    <br>{{ $data['mst']->samsat }}
                                </address>
                            </div>
                            <div class="col-md-4">
                                <address>
                                    <strong>Provinsi</strong>
                                    <br>{{ $data['mst']->provinsi }}
                                </address>
                                <address>
                                    <strong>Kota</strong>
                                    <br>{{ $data['mst']->kota }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Validasi Terima PLAT No ke SAMSAT</h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#infoTambahan">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <form id="formData">
                        <input type="hidden" id="idDealer" value="{{ $data['mst']->id_dealer }}">
                        <input type="hidden" id="idDamsat" value="{{ $data['mst']->id_samsat }}">
                        <div class="card-body">
                            <table class="table table-sm table-striped table-bordered nowrap" id="validasi" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No Mesin</th>
                                    <th>Nama STNK</th>
                                    <th>Tipe Kendaraan</th>
                                    <th>No Pol</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="button" class="btn btn-block btn-outline-danger" onclick="window.location = '{{ url('transaction/plat-ke-dealer') }}'">
                                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                                    </button>
                                </div>
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="button" id="btnHapusValidasi" class="btn btn-block btn-danger" disabled>
                                        <i class="fas fa-times-circle mr-2"></i>Hapus
                                    </button>
                                </div>
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="submit" id="btnValidasi" class="btn btn-block btn-success">
                                        <i class="fas fa-check mr-2"></i>Validasi
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

@section('modal')
    <div class="modal fade" id="infoTambahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Daftar Kendaraan Belum Validasi Kelengkapan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="tambahKendaraan">
                    <div class="modal-body">
                        <table class="table table-sm table-striped table-bordered nowrap" id="daftarKendaraan" style="width: 100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>No Mesin</th>
                                <th>Nama STNK</th>
                                <th>Kode Kendaraan</th>
                            </tr>
                            </thead>
                        </table>
                        <hr>
                        <div class="form-group">
                            <label for="statusKelengkapan">Validasi PLAT No ke DEALER</label>
                            <select class="form-control" name="status_kelengkapan" id="statusKelengkapan">
                                <option value="1">Sudah diterima</option>
                                <option value="0" selected>Belum Diterima</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="infoKelengkapan">Keterangan</label>
                            <input type="text" class="form-control" name="info_kelengkapan" id="infoKelengkapan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">TAMBAHKAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let noPO = '{{ $data['mst']->no_po }}';

        function reloadDaftar(saved) {
            daftarKendaraan.clear().draw();
            let data;
            if (saved.length === 0) {
                data = {no_po: noPO};
            } else {
                data = {no_po: noPO, saved: saved[0]};
            }
            $.ajax({
                url: '{{ url('transaction/plat-ke-dealer/daftar-validasi') }}',
                method: 'post',
                data: data,
                success: function (response) {
                    daftarKendaraan.rows.add(response).draw();
                },
                error: function (response) {
                    console.log(response);
                }
            })
        }

        function checkTotalData(nomorPO) {
            $.ajax({
                url: '{{ url('transaction/plat-ke-dealer/check-total-data') }}',
                method: 'get',
                data: {no_po: nomorPO},
                success: function (response) {
                    if (response !== 'success') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Seluruh Kendaraan telah divalidasi',
                            text: 'Kendaraan pada nomor PO '+noPO+' telah selesai divalidasi. Anda akan kembali ke halaman utama Validasi Notice',
                            onClose: function () {
                                window.location = '{{ url('transaction/plat-ke-dealer') }}';
                            }
                        });
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            })
        }

        let btnValidasi = $('#btnValidasi');
        let btnHapusValidasi = $('#btnHapusValidasi');
        let modalInfoTambahan = $('#infoTambahan');
        let tambahKendaraan = $('#tambahKendaraan');
        let infoKelengkapan = $('#infoKelengkapan');
        let tglNotice = $('#tglNotice').daterangepicker({
            singleDatePicker: true,
        });

        let daftarKendaraan = $('#daftarKendaraan').DataTable({
            scrollX: true,
            columns: [
                {data: 'id'},
                {data: 'no_mesin'},
                {data: 'nama_stnk'},
                {data: 'kode_kendaraan'},
            ],
        });

        let validasi = $('#validasi').DataTable({
            scrollX: true,
            columns: [
                {data: 'id'},
                {data: 'no_mesin'},
                {data: 'nama_stnk'},
                {data: 'tipe_kendaraan'},
                {data: 'no_pol'},
                {
                    data: 'status',
                    render: function (data) {
                        return (data === '1') ? 'Lengkap' : 'Belum lengkap';
                    }
                },
                {data: 'catatan'},
            ]
        });

        $(document).ready(function () {
            checkTotalData(noPO);
            /*
            1. Event Daftar Validasi
            2. Event Modal Open
            3. Event Modal Submited
            4. Event Selected Validasi Data
            5. Event Hapus Validasi Data
             */
            $('#daftarKendaraan tbody').on('click','tr',function () {
                let selected = $(this);
                // selected.toggleClass('selected');

                if ( selected.hasClass('selected') ) {
                    selected.removeClass('selected');
                    infoKelengkapan.val('');
                } else {
                    daftarKendaraan.$('tr.selected').removeClass('selected');
                    selected.addClass('selected');

                    let data = daftarKendaraan.row('.selected').data();
                    infoKelengkapan.val(data.catatan);
                }
            });
            modalInfoTambahan.on('shown.bs.modal',function () {
                let saved = validasi.columns(0).data();
                // console.log(saved);
                reloadDaftar(saved);
            });
            tambahKendaraan.submit(function (e) {
                e.preventDefault();
                if (daftarKendaraan.rows('.selected').any()) {
                    let kendaraan = daftarKendaraan.row('.selected').data();
                    let data = {};
                    $(this).serializeArray().forEach(function (v) {
                        data[v.name] = v.value;
                    });
                    // console.log(data);
                    // console.log(kendaraan);

                    validasi.row.add({
                        'id': kendaraan.id,
                        'no_mesin': kendaraan.no_mesin,
                        'nama_stnk': kendaraan.nama_stnk,
                        'tipe_kendaraan': kendaraan.kode_kendaraan,
                        'no_pol': kendaraan.no_pol,
                        'status': data.status_kelengkapan,
                        'catatan': data.info_kelengkapan,
                    }).draw();

                    $(this).find('input[type=text], textarea').val('');
                    $(this).find('select').prop('selected',0);
                    modalInfoTambahan.modal('hide');
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Silahkan pilih kendaraan',
                    });
                }
            });
            $('#validasi tbody').on('click','tr',function () {
                let selected = $(this);
                selected.toggleClass('selected');

                if (validasi.rows('.selected').data().length > 0) {
                    btnHapusValidasi.removeAttr('disabled');
                } else {
                    btnHapusValidasi.attr('disabled',true);
                }
            });
            btnHapusValidasi.click(function (e) {
                e.preventDefault();
                validasi.rows('.selected').remove().draw();
            });

            /*
            SUBMIT Validasi Notice BBN
             */
            $('#formData').submit(function (e) {
                e.preventDefault();
                Loading('start');
                if (validasi.rows().count() === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Anda belum memilih data untuk di validasi',
                    });
                } else {
                    let dataValidasi = validasi.rows().data().toArray();
                    let data = {
                        no_po: noPO,
                        data: dataValidasi
                    };
                    console.log(data);
                    $.ajax({
                        url: '{{ url('transaction/plat-ke-dealer/submit') }}',
                        method: 'post',
                        data: {data: JSON.stringify(data)},
                        success: function (response) {
                            if (response['status'] === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Kode Validasi: '+response['kode_validasi'],
                                    // showCloseButton: true,
                                    // showCancelButton: true,
                                    // confirmButtonText: '<i class="fas fa-print"></i> Cetak Kuitansi',
                                    onClose: function () {
                                        {{--window.open('{{ url('transaction/plat-ke-dealer/kuitansi/') }}');--}}
                                        window.location = '{{ url('transaction/plat-ke-dealer') }}';
                                    }
                                });
                            } else {
                                console.log(response);
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal tersimpan! Cek koneksi anda dan ulangi lagi atau hubungi WAVE Solusi Indonesia',
                                });
                            }
                        },
                        error: function (response) {
                            console.log(response);
                            Swal.fire({
                                icon: 'error',
                                title: 'System Error! Silahkan hubungi WAVE Solusi Indonesia',
                            });
                        }
                    })
                }
            })
        });
    </script>
@endsection
