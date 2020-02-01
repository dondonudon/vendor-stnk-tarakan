@extends('dashboard.layout')

@section('title','Laporan - BBN per PERIODE')

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
                                        <label for="iPeriode">PERIODE</label>
                                        <input type="text" class="form-control" id="iPeriode" name="periode">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="iStatus">Status</label>
                                        <select class="form-control" id="iStatus" name="status">
                                            <option value="0">Belum BBN</option>
                                            <option value="1">Sudah BBN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <table id="tableReport" class="table table-sm table-striped table-borderless nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>DEALER</th>
                                <th>NO PO</th>
                                <th>JUMLAH</th>
                                <th>BERKAS</th>
                                <th>WILAYAH</th>
                                <th>NOTICE</th>
                                <th>TANGGAL</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalBelumBbn">Total Belum BBN</label>
                                    <input type="text" class="form-control" id="vTotalBelumBbn" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalNotice">Total NOTICE</label>
                                    <input type="text" class="form-control text-right" id="vTotalNotice" readonly>
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
        let vTotalBelumBbn = $('#vTotalBelumBbn');
        let vTotalNotice = $('#vTotalNotice');
        let dExcel = $('#dExcel');
        let dPdf = $('#dPdf');
        let iPeriode = $('#iPeriode');
        let iStatus = $('#iStatus');
        let dataID;

        let tableReport = $('#tableReport').DataTable({
            scrollX: true,
            columns: [
                {data: 'dealer'},
                {data: 'no_po'},
                {data: 'total'},
                {data: 'berkas'},
                {data: 'wilayah'},
                {data: 'notice'},
                {
                    data: 'tanggal',
                    render: function (data) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
            ],
        });

        function reloadReport(start,end,status) {
            $.ajax({
                url: '{{ url('laporan/bbn-per-periode/list') }}',
                method: 'post',
                data: {
                    start: start,
                    end: end,
                    status: status
                },
                success: function (response) {
                    // console.log(response);
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
                moment().endOf('month').format('YYYY-MM-DD'),
                iStatus.val()
            );

            iPeriode.daterangepicker({
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            tableReport.on('draw', function () {
                let belumBBN = 0;
                let dtBelumBBN = tableReport.columns(2).data()[0];
                dtBelumBBN.forEach(function (v,i) {
                    belumBBN += parseInt(v);
                });
                vTotalBelumBbn.val(belumBBN);

                let totalNotice = 0;
                let dtTotalNotice = tableReport.columns(5).data()[0];
                dtTotalNotice.forEach(function (v,i) {
                    totalNotice += parseInt(v);
                });
                vTotalNotice.val(
                    numeral(totalNotice).format('0,0.0')
                );
            });

            dExcel.click(function (e) {
                e.preventDefault();
                bExport.addClass('d-none');
                loading.removeClass('d-none');
                let startDate = moment(iPeriode.data('daterangepicker').startDate).format('YYYY-MM-DD');
                let endDate = moment(iPeriode.data('daterangepicker').endDate).format('YYYY-MM-DD');
                let status = iStatus.val();
                download.src = '{{ url('laporan/bbn-per-periode/export/excel') }}/'+startDate+'/'+endDate+'/'+status;
            });

            dPdf.click(function (e) {
                e.preventDefault();
                let startDate = moment(iPeriode.data('daterangepicker').startDate).format('YYYY-MM-DD');
                let endDate = moment(iPeriode.data('daterangepicker').endDate).format('YYYY-MM-DD');
                let status = iStatus.val();
                window.open('{{ url('laporan/bbn-per-periode/export/pdf') }}/'+startDate+'/'+endDate+'/'+status);
            });

            window.onfocus = function () {
                loading.addClass('d-none');
                bExport.removeClass('d-none');
            }
        });
    </script>
@endsection