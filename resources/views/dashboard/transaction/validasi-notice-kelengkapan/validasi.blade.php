@extends('dashboard.layout')

@section('title','Transaction - Validasi Kelengkapan BBn')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Validasi Notice Kelengkapan BBn</h4>
                    </div>
                    <form id="formData">
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
                            <hr>
                            <table class="table table-sm table-striped table-bordered nowrap" id="daftarValidasi" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No Pol</th>
                                    <th>No Mesin</th>
                                    <th>Nama STNK</th>
                                    <th>Kode Kendaraan</th>
                                    <th>Harga Notice BBN</th>
                                    <th>Harga Jasa</th>
                                    <th>PPH</th>
                                    <th>PNBP</th>
                                    <th>Subtotal</th>
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
                                <div class="col-sm-12 col-lg-3 mt-2 mb-lg-0">
                                    <button type="button" id="btnLengkap" class="btn btn-block btn-primary" disabled>
                                        <i class="fas fa-pencil-alt mr-2"></i>Update Kelengkapan
                                    </button>
                                </div>
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="submit" id="btnValidasi" class="btn btn-block btn-success" disabled>
                                        <i class="fas fa-check mr-2"></i>Lengkap
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
        function reloadDaftar() {
            daftarValidasi.clear().draw();
            $.ajax({
                url: '{{ url('transaction/validasi-kelengkapan-bbn/daftar-validasi') }}',
                method: 'post',
                data: {no_po: noPO},
                success: function (response) {
                    if (response.length === 0) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Seluruh data telah tervalidasi',
                            html: 'Tidak ada data kendaraan yang perlu divalidasi pada nomor PO "'+noPO+'".<br> Anda akan kembali ke halaman awal Validasi Notice. <br>Informasi mengenai Nomor PO ini, dapat anda lihat pada halaman "Transaction/Purchase Order".',
                            onClose: function () {
                                window.location = '{{ url('transaction/validasi-notice') }}';
                            }
                        });
                    } else {
                        daftarValidasi.rows.add(response).draw();
                    }
                }
            })
        }

        let btnValidasi = $('#btnValidasi');
        let btnLengkap = $('#btnLengkap');

        let daftarValidasi = $('#daftarValidasi').DataTable({
            scrollX: true,
            columns: [
                {data: 'id'},
                {data: 'no_pol'},
                {data: 'no_mesin'},
                {data: 'nama_stnk'},
                {data: 'kode_kendaraan'},
                {
                    data: 'harga_notice_bbn',
                    render: function (data) {
                        return '<div class="text-right">'+numeral(data).format('0,0.0')+'</div>';
                    }
                },
                {
                    data: 'harga_jasa',
                    render: function (data) {
                        return '<div class="text-right">'+numeral(data).format('0,0.0')+'</div>';
                    }
                },
                {
                    data: 'pph',
                    render: function (data) {
                        return '<div class="text-right">'+numeral(data).format('0,0.0')+'</div>';
                    }
                },
                {
                    data: 'pnbp',
                    render: function (data) {
                        return '<div class="text-right">'+numeral(data).format('0,0.0')+'</div>';
                    }
                },
                {
                    data: 'subtotal',
                    render: function (data) {
                        return '<div class="text-right">'+numeral(data).format('0,0.0')+'</div>';
                    }
                },
            ],
        });

        let noPO = '{{ $data['mst']->no_po }}';

        $(document).ready(function () {
            reloadDaftar();

            /*
            Event Daftar Validasi
             */
            $('#daftarValidasi tbody').on('click','tr',function () {
                let length = daftarValidasi.rows('.selected').data().length;
                $(this).toggleClass('selected');
                if (length > 0) {
                    if (length === 1) {
                        btnLengkap.removeAttr('disabled');
                        btnValidasi.removeAttr('disabled');
                    } else {
                        btnLengkap.attr('disabled',true);
                        btnValidasi.removeAttr('disabled');
                    }
                } else {
                    btnValidasi.attr('disabled',true);
                }
            });

            /*
            Update Kelengkapan
            */
            btnLengkap.click(function () {
                
            });

            /*
            Validasi Notice BBN
             */
            btnValidasi.click(function (e) {
                e.preventDefault();
                let dataValidasi = daftarValidasi.rows('.selected').data().toArray();
                $.ajax({
                    url: '{{ url('transaction/validasi-notice/submit') }}',
                    method: 'post',
                    data: {
                        no_po: noPO,
                        data: dataValidasi
                    },
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Tersimpan',
                                onClose: function () {
                                    reloadDaftar();
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
                });
            });
        });
    </script>
@endsection
