@extends('dashboard.layout')

@section('title','Transaction - Detail Purchase Order')

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
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-between">
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <a href="{{ url()->previous() }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>KEMBALI
                                </a>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnCetak" class="btn btn-block btn-success">
                                    <i class="fas fa-print mr-2"></i>KUITANSI
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered nowrap" id="daftarKendaraan" style="width: 100%">
                            <thead>
                            <tr>
                                <th>No Pol</th>
                                <th>No Mesin</th>
                                <th>Nama STNK</th>
                                <th>Kode Kendaraan</th>
                                <th>Harga Notice BBN</th>
                                <th>Harga Jasa</th>
                                <th>PPH</th>
                                <th>PNBP</th>
                                <th>Subtotal</th>
                                <th>Status Validasi Notice</th>
                                <th>Kelengkapan Validasi Notice</th>
                                <th>STNK dari SAMSAT</th>
                                <th>STNK ke Dealer</th>
                                <th>BPKB dari SAMSAT</th>
                                <th>BPKB ke Dealer</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let noPO = '{{ $data['mst']->no_po }}';
        let filterStatus = $('#filterStatus');
        let btnCetak = $('#btnCetak');

        function reloadDaftar() {
            daftarKendaraan.clear().draw();
            $.ajax({
                url: '{{ url('transaction/purchase-order/daftar-kendaraan') }}',
                method: 'post',
                data: {no_po: noPO},
                success: function (response) {
                    daftarKendaraan.rows.add(response).draw();
                }
            })
        }

        let daftarKendaraan = $('#daftarKendaraan').DataTable({
            scrollX: true,
            rowCallback: function(row,data,index) {

            },
            columns: [
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
                {
                    data: 'status_bbn_proses',
                    render: function (data,type,row,meta) {
                        return data === 1 ? 'Sudah Diproses' : 'Belum Diproses';
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData === 1) {
                            $(td).css('background-color', 'green');
                            $(td).css('color', 'white');
                        } else {
                            $(td).css('background-color', 'red');
                            $(td).css('color', 'white');
                        }
                    }
                },
                {
                    data: 'status_bbn_kelengkapan',
                    render: function (data) {
                        return data === 1 ? 'Sudah Lengkap' : 'Belum Lengkap';
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData === 1) {
                            $(td).css('background-color', 'green');
                            $(td).css('color', 'white');
                        } else {
                            $(td).css('background-color', 'red');
                            $(td).css('color', 'white');
                        }
                    }

                },
                {
                    data: 'status_stnk_samsat',
                    render: function (data) {
                        return data === 1 ? 'Sudah diterima dari SAMSAT' : 'Belum diterima dari SAMSAT';
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData === 1) {
                            $(td).css('background-color', 'green');
                            $(td).css('color', 'white');
                        } else {
                            $(td).css('background-color', 'red');
                            $(td).css('color', 'white');
                        }
                    }

                },
                {
                    data: 'status_stnk_dealer',
                    render: function (data) {
                        return data === 1 ? 'Sudah diterima Dealer' : 'Belum diterima Dealer';
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData === 1) {
                            $(td).css('background-color', 'green');
                            $(td).css('color', 'white');
                        } else {
                            $(td).css('background-color', 'red');
                            $(td).css('color', 'white');
                        }
                    }

                },
                {
                    data: 'status_bpkb_samsat',
                    render: function (data) {
                        return data === 1 ? 'Sudah diterima dari SAMSAT' : 'Belum diterima dari SAMSAT';
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData === 1) {
                            $(td).css('background-color', 'green');
                            $(td).css('color', 'white');
                        } else {
                            $(td).css('background-color', 'red');
                            $(td).css('color', 'white');
                        }
                    }

                },
                {
                    data: 'status_bpkb_dealer',
                    render: function (data) {
                        return data === 1 ? 'Sudah diterima Dealer' : 'Belum diterima Dealer';
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData === 1) {
                            $(td).css('background-color', 'green');
                            $(td).css('color', 'white');
                        } else {
                            $(td).css('background-color', 'red');
                            $(td).css('color', 'white');
                        }
                    }

                },
            ],
        });

        $(document).ready(function () {
            reloadDaftar();

            btnCetak.click(function (e) {
                e.preventDefault();
                window.open('{{ url('cetak/purchase-order/'.$data['mst']->no_po) }}');
            });
        });
    </script>
@endsection
