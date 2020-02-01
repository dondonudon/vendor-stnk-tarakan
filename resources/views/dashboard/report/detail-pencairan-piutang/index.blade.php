@extends('dashboard.layout')

@section('title','Laporan - Detail Pencairan Piutang')

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
                            </div>
                        </form>
                        <hr>
                        <table id="tableReport" class="table table-sm table-striped table-bordered nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>TGL PO</th>
                                <th>NO PO</th>
                                <th>NAMA</th>
                                <th>DAERAH</th>
                                <th>JUMLAH</th>
                                <th>PENCAIRAN</th>
                                <th>TGL TAGIHAN</th>
                                <th>SERAH STNK</th>
                                <th>TGL PROSES CABANG</th>
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
                {
                    data: 'tgl_po',
                    render: function (data) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {data: 'no_po'},
                {data: 'nama'},
                {data: 'daerah'},
                {data: 'jumlah'},
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
                {data: 'tgl_tagihan'},
                {data: 'serah_stnk'},
                {data: 'tgl_proses_cabang'}
            ],
        });

        function reloadReport(start,end) {
            $.ajax({
                url: '{{ url('laporan/detail-pencairan-piutang/list') }}',
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
            reloadReport(
                moment().startOf('month').format('YYYY-MM-DD'),
                moment().endOf('month').format('YYYY-MM-DD')
            );

            iTanggalBBN.daterangepicker({
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: {
                    format: 'DD/MM/YYYY'
                }
            }, function(start, end, label) {
                reloadReport(start,end);
            });

            tableReport.on('draw', function () {
                let pencairan = 0;

                let dtPencairan = tableReport.columns(5).data()[0];

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
                download.src = '{{ url('laporan/detail-pencairan-piutang/export/excel') }}/'+start+'/'+end;
            });

            dPdf.click(function (e) {
                e.preventDefault();
                let start = moment(iTanggalBBN.data('daterangepicker').startDate).format('YYYY-MM-DD');
                let end = moment(iTanggalBBN.data('daterangepicker').endDate).format('YYYY-MM-DD');
                window.open('{{ url('laporan/detail-pencairan-piutang/export/pdf') }}/'+start+'/'+end);
            });

            window.onfocus = function () {
                loading.addClass('d-none');
                bExport.removeClass('d-none');
            }
        });
    </script>
@endsection