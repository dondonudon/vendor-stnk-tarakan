@extends('dashboard.layout')

@section('title')
    {{ ucfirst(request()->segment(1)).' - '.ucfirst(request()->segment(2)) }}
@endsection

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
                                        <label for="iTanggalBBN">Tanggal BBN</label>
                                        <input type="text" class="form-control text-right" name="tgl_bbn" id="iTanggalBBN">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-7"></div>
                                <div class="col-sm-12 col-lg-2">
                                    <button type="submit" class="btn btn-block btn-primary">VIEW</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <table id="tableReport" class="table table-sm table-striped table-borderless nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>TGL PO</th>
                                <th>NAMA</th>
                                <th>DAERAH</th>
                                <th>JUMLAH</th>
                                <th>NOTICE</th>
                                <th>NO PO</th>
                                <th>JASA</th>
                                <th>PENCAIRAN</th>
                                <th>PNBP</th>
                                <th>LABA KOTOR</th>
                                <th>PPH</th>
                                <th>OMSET</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalPencairan">Total PENCAIRAN</label>
                                    <input type="text" class="form-control text-right" id="vTotalPencairan" readonly>
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
        let vTotalPencairan = $('#vTotalPencairan');
        let dExcel = $('#dExcel');
        let dPdf = $('#dPdf');
        let iTanggalBBN = $('#iTanggalBBN');
        let iStatus = $('#iStatus');
        let dataID;

        let tableReport = $('#tableReport').DataTable({
            scrollX: true,
            columns: [
                {data: 'tgl_po'},
                {data: 'nama'},
                {data: 'daerah'},
                {data: 'jumlah'},
                {data: 'notice'},
                {data: 'no_po'},
                {data: 'jasa',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return numeral(data).format('0,0.0');
                        }
                    }
                },
                {
                    data: 'pencairan',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return numeral(data).format('0,0.0');
                        }
                    }
                },
                {
                    data: 'pnbp',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return numeral(data).format('0,0.0');
                        }
                    }
                },
                {
                    data: 'laba_kotor',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return numeral(data).format('0,0.0');
                        }
                    }
                },
                {
                    data: 'pph',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return numeral(data).format('0,0.0');
                        }
                    }
                },
                {
                    data: 'omset',
                    render: function (data) {
                        if (data === null) {
                            return 0;
                        } else {
                            return numeral(data).format('0,0.0');
                        }
                    }
                },
            ],
        });

        function reloadReport(start,end) {
            $.ajax({
                url: '{{ url('laporan/transaksi/list') }}',
                method: 'post',
                data: {
                    start: start,
                    end: end
                },
                success: function (response) {
                    // console.log(noPO);
                    tableReport.clear().draw();
                    tableReport.rows.add(response).draw();
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }

        $(document).ready(function () {
            iTanggalBBN.daterangepicker();

            formFilter.submit(function (e) {
                e.preventDefault();
                let startDate = moment(iTanggalBBN.data('daterangepicker').startDate).format('YYYY-MM-DD');
                let endDate = moment(iTanggalBBN.data('daterangepicker').endDate).format('YYYY-MM-DD');
                reloadReport(startDate,endDate);
            });

            tableReport.on('draw', function () {
                let pencairan = 0;

                let dtPencairan = tableReport.columns(7).data()[0];

                dtPencairan.forEach(function (v,i) {
                    (v === null) ? pencairan += 0 : pencairan += parseInt(v);
                });

                vTotalPencairan.val(numeral(pencairan).format('0,0.0'));
            });

            dExcel.click(function (e) {
                e.preventDefault();
                bExport.addClass('d-none');
                loading.removeClass('d-none');
                let start = moment(iTanggalBBN.data('daterangepicker').startDate).format('YYYY-MM-DD');
                let end = moment(iTanggalBBN.data('daterangepicker').endDate).format('YYYY-MM-DD');
                download.src = '{{ url('laporan/transaksi/export/excel') }}/'+start+'/'+end;
            });

            dPdf.click(function (e) {
                e.preventDefault();
                let start = moment(iTanggalBBN.data('daterangepicker').startDate).format('YYYY-MM-DD');
                let end = moment(iTanggalBBN.data('daterangepicker').endDate).format('YYYY-MM-DD');
                window.open('{{ url('laporan/transaksi/export/pdf') }}/'+start+'/'+end);
            });

            window.onfocus = function () {
                loading.addClass('d-none');
                bExport.removeClass('d-none');
            }
        });
    </script>
@endsection