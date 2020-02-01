@extends('dashboard.layout')

@section('title','Laporan - Rekap Tagihan per PO')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan</h4>
                        <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" id="bExport">Export</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Pilih Format</li>
                                <li><a id="dExcel" href="#" class="dropdown-item">Excel</a></li>
                                <li><a id="dPdf" href="#" class="dropdown-item">PDF</a></li>
                            </ul>
                            <div class="spinner-border text-danger d-none" role="status" id="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="formFilter">
                            <div class="row align-items-end">
                                <div class="col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="iNoPO">NO Purchase Order</label>
                                        <select name="no_po" id="iNoPO" style="width: 100%" required></select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <table id="tableReport" class="table table-sm table-striped table-borderless nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>NAMA STNK</th>
                                <th>NO POLISI</th>
                                <th>TYPE</th>
                                <th>NOMOR MESIN</th>
                                <th>HARGA NOTICE</th>
                                <th>PNBP</th>
                                <th>JASA</th>
                                <th>PPN</th>
                                <th>SUBTOTAL</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalNotice">Total NOTICE</label>
                                    <input type="text" class="form-control text-right" id="vTotalNotice" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalPNBP">Total PNBP</label>
                                    <input type="text" class="form-control text-right" id="vTotalPNBP" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalJasa">Total JASA</label>
                                    <input type="text" class="form-control text-right" id="vTotalJasa" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalPPN">Total PPN</label>
                                    <input type="text" class="form-control text-right" id="vTotalPPN" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalHarga">Total HARGA</label>
                                    <input type="text" class="form-control text-right" id="vTotalHarga" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe id="download" style="display: none"></iframe>
@endsection

@section('script')
    <script type="text/javascript">
        let download = document.getElementById('download');
        let loading = $('#loading');
        let bExport = $('#bExport');
        let formFilter = $('#formFilter');
        let vTotalNotice = $('#vTotalNotice');
        let vTotalPNBP = $('#vTotalPNBP');
        let vTotalJasa = $('#vTotalJasa');
        let vTotalPPN = $('#vTotalPPN');
        let vTotalHarga = $('#vTotalHarga');
        let dExcel = $('#dExcel');
        let dPdf = $('#dPdf');
        let iNoPO = $('#iNoPO');
        let iStatus = $('#iStatus');
        let dataID;

        let tableReport = $('#tableReport').DataTable({
            scrollX: true,
            columns: [
                {data: 'nama_stnk'},
                {data: 'no_pol'},
                {data: 'kode_kendaraan'},
                {data: 'no_mesin'},
                {
                    data: 'harga_notice_bbn',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'pnbp',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'harga_jasa',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'pph',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'subtotal',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return data;
                        }
                    }
                },
            ],
        });

        function WarningPORequired() {
            Swal.fire({
                icon: 'warning',
                title: 'No Purchase Order wajib diisi',
            });
        }

        function reloadReport(noPO,status) {
            $.ajax({
                url: '{{ url('laporan/rekap-tagihan-per-po/list') }}',
                method: 'post',
                data: {
                    no_po: noPO,
                    status: status
                },
                success: function (response) {
                    // console.log(response);
                    tableReport.clear().draw();
                    tableReport.rows.add(response).draw();
                    Loading('end');
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }

        $(document).ready(function () {
            iNoPO.select2({
                ajax: {
                    url: '{{ url('laporan/rekap-tagihan-per-po/po') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });

            iNoPO.change(function () {
                Loading('start');
                let noPO = iNoPO.val();
                let status = iStatus.val();
                reloadReport(noPO,status);
            });

            tableReport.on('draw', function () {
                let notice = 0;
                let pnbp = 0;
                let jasa = 0;
                let ppn = 0;
                let total = 0;

                let dtNotice = tableReport.columns(4).data()[0];
                let dtPnbp = tableReport.columns(5).data()[0];
                let dtJasa = tableReport.columns(6).data()[0];
                let dtPpn = tableReport.columns(7).data()[0];
                let dtTotal = tableReport.columns(8).data()[0];

                dtNotice.forEach(function (v,i) {
                    (v === null) ? notice += 0 : notice += parseInt(v);
                });

                dtPnbp.forEach(function (v,i) {
                    (v === null) ? pnbp += 0 : pnbp += parseInt(v);
                });

                dtJasa.forEach(function (v,i) {
                    (v === null) ? jasa += 0 : jasa += parseInt(v);
                });

                dtPpn.forEach(function (v,i) {
                    (v === null) ? ppn += 0 : ppn += parseInt(v);
                });

                dtTotal.forEach(function (v,i) {
                    (v === null) ? total += 0 : total += parseInt(v);
                });

                vTotalNotice.val(notice);
                vTotalPNBP.val(pnbp);
                vTotalJasa.val(jasa);
                vTotalPPN.val(ppn);
                vTotalHarga.val(total);
            });

            dExcel.click(function (e) {
                e.preventDefault();
                let dealer = iNoPO.val();
                let status = iStatus.val();
                // console.log(dealer);
                if (dealer === null) {
                    WarningPORequired();
                } else {
                    bExport.addClass('d-none');
                    loading.removeClass('d-none');
                    download.src = '{{ url('laporan/rekap-tagihan-per-po/export/excel') }}/'+dealer;
                }
            });

            dPdf.click(function (e) {
                e.preventDefault();
                let dealer = iNoPO.val();
                let status = iStatus.val();
                // console.log(dealer);
                if (dealer === null) {
                    WarningPORequired();
                } else {
                    window.open('{{ url('laporan/rekap-tagihan-per-po/export/pdf') }}/' + dealer);
                }
            });

            window.onfocus = function () {
                loading.addClass('d-none');
                bExport.removeClass('d-none');
            }
        });
    </script>
@endsection