@extends('dashboard.layout')

@section('title','Transaction - Validasi Notice BBN')

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
                        <h4>Daftar Kendaraan yang akan divalidasi</h4>
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="noNotice">No Notice</label>
                                        <input type="text" class="form-control" id="noNotice" placeholder="Nomor Notice" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tglNotice">Tanggal Notice</label>
                                        <input type="text" class="form-control" id="tglNotice" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <table class="table table-sm table-striped table-bordered nowrap" id="validasi" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No Mesin</th>
                                    <th>Nama STNK</th>
                                    <th>Tipe Kendaraan</th>
                                    <th>No Pol</th>
                                    <th>Status Kelengkapan</th>
                                    <th>Info Kelengkapan</th>
                                    <th>Ukuran</th>
                                    <th>Warna Dasar</th>
                                    <th>Bulan Pajak</th>
                                    <th>Tahun</th>
                                    <th>Proses</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="button" class="btn btn-block btn-outline-danger" onclick="window.location = '{{ url('transaction/validasi-notice') }}'">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Daftar Kendaraan Belum Validasi</h5>
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
                            <label for="noPOL">No Pol</label>
                            <input type="text" class="form-control" name="noPOL" required>
                        </div>
                        <div class="form-group">
                            <label>Kelengkapan Berkas</label>
                            <select class="form-control" id="iStatusKelengkapan" name="status_kelengkapan">
                                <option value="0" selected>Belum Lengkap</option>
                                <option value="1">Lengkap</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="noPOL">Info Kelengkapan</label>
                            <input type="text" class="form-control" name="info_kelengkapan">
                        </div>
                        <div class="form-group">
                            <label for="noPOL">Ukuran</label>
                            <input type="text" class="form-control" name="ukuran">
                        </div>
                        <div class="form-group">
                            <label for="noPOL">Warna</label>
                            <input type="text" class="form-control" name="warna">
                        </div>
                        <div class="form-group">
                            <label for="noPOL">Bulan Pajak</label>
                            <input type="text" class="form-control" name="bulan_pajak">
                        </div>
                        <div class="form-group">
                            <label for="noPOL">Tahun</label>
                            <input type="text" class="form-control" name="tahun">
                        </div>
                        <div class="form-group">
                            <label for="noPOL">Proses</label>
                            <input type="text" class="form-control" name="proses">
                        </div>
                        <div class="form-group">
                            <label for="noPOL">Keterangan tambahan</label>
                            <input type="text" class="form-control" name="keterangan">
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
            if (saved.data().length === 0) {
                data = {no_po: noPO};
            } else {
                data = {no_po: noPO, saved: JSON.stringify(saved)};
            }
            // console.log(saved.data().length);
            $.ajax({
                url: '{{ url('transaction/validasi-notice/daftar-validasi') }}',
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
                url: '{{ url('transaction/validasi-notice/check-total-data') }}',
                method: 'get',
                data: {no_po: nomorPO},
                success: function (response) {
                    if (response !== 'success') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Seluruh Kendaraan telah divalidasi',
                            text: 'Kendaraan pada nomor PO '+noPO+' telah selesai divalidasi. Anda akan kembali ke halaman utama Validasi Notice',
                            onClose: function () {
                                window.location = '{{ url('transaction/validasi-notice') }}';
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
                    data: 'status_bbn_kelengkapan',
                    render: function (data) {
                        return (data === '1') ? 'Lengkap' : 'Belum lengkap';
                    }
                },
                {data: 'info_kelengkapan'},
                {data: 'ukuran'},
                {data: 'warna_dasar'},
                {data: 'bulan_pajak'},
                {data: 'tahun'},
                {data: 'proses'},
                {data: 'keterangan'},
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
                } else {
                    daftarKendaraan.$('tr.selected').removeClass('selected');
                    selected.addClass('selected');
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
                        'no_pol': data.noPOL,
                        'status_bbn_kelengkapan': data.status_kelengkapan,
                        'info_kelengkapan': data.info_kelengkapan,
                        'ukuran': (data.ukuran !== '') ? data.ukuran : '',
                        'warna_dasar': (data.warna_dasar !== '') ? data.warna : '',
                        'bulan_pajak': (data.bulan_pajak !== '') ? data.bulan_pajak : '',
                        'tahun': (data.tahun !== '') ? data.tahun : '',
                        'proses': (data.proses !== '') ? data.proses : '',
                        'keterangan': (data.keterangan !== '') ? data.keterangan : '',
                    }).draw();

                    $(this).find('input[type=text], textarea').val('');
                    $('#iStatusKelengkapan').val(0);
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
                if (validasi.rows().count() === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Anda belum memilih data untuk di validasi',
                    });
                } else {
                    let dataValidasi = validasi.rows().data().toArray();
                    let data = {
                        no_po: noPO,
                        no_notice: $('#noNotice').val(),
                        id_dealer: $('#idDealer').val(),
                        id_samsat: $('#idDamsat').val(),
                        tgl_notice: tglNotice.data('daterangepicker').startDate.format('YYYY-MM-DD'),
                        data: dataValidasi
                    };
                    console.log(data);
                    $.ajax({
                        url: '{{ url('transaction/validasi-notice/submit') }}',
                        method: 'post',
                        data: {data: JSON.stringify(data)},
                        success: function (response) {
                            if (response === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Tersimpan',
                                    onClose: function () {
                                        window.location = '{{ url('transaction/validasi-notice') }}'
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
