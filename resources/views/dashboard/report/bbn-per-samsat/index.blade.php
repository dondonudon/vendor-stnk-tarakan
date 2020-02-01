@extends('dashboard.layout')

@section('title','Laporan - BBN per SAMSAT')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan</h4>
                        <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Export</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Pilih Format</li>
                                <li><a id="dExcel" href="#" class="dropdown-item">Excel</a></li>
                                <li><a id="dPdf" href="#" class="dropdown-item">PDF</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-sm-12 col-lg-3">
                                <div class="form-group">
                                    <label for="iSamsat">SAMSAT</label>
                                    <select name="samsat" id="iSamsat" style="width: 100%" required></select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table id="tableReport" class="table table-sm table-striped table-borderless nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Samsat</th>
                                <th>Dealer</th>
                                <th>Belum BBN</th>
                                <th>Sudah BBN</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalBelumBbn">Total Belum BBN</label>
                                    <input type="text" class="form-control" id="vTotalBelumBbn" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalSudahBbn">Total Sudah BBN</label>
                                    <input type="text" class="form-control" id="vTotalSudahBbn" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vTotalBbn">Total BBN</label>
                                    <input type="text" class="form-control" id="vTotalBbn" readonly>
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
        let vTotalBelumBbn = $('#vTotalBelumBbn');
        let vTotalSudahBbn = $('#vTotalSudahBbn');
        let vTotalBbn = $('#vTotalBbn');
        let iSamsat = $('#iSamsat');
        let dExcel = $('#dExcel');
        let dPdf = $('#dPdf');
        let dataID;

        let tableReport = $('#tableReport').DataTable({
            scrollX: true,
            columns: [
                {data: 'samsat'},
                {data: 'dealer'},
                {data: 'belum_bbn'},
                {data: 'sudah_bbn'},
                {data: 'total'},
            ],
        });

        function reloadReport(samsat) {
            $.ajax({
                url: '{{ url('laporan/bbn-per-samsat/list') }}',
                method: 'post',
                data: {
                    samsat: samsat,
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
            reloadReport('all');

            iSamsat.select2({
                ajax: {
                    url: '{{ url('data/samsat') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });

            iSamsat.change(function () {
                // console.log(iSamsat.val());
                reloadReport(iSamsat.val());
            });

            tableReport.on('draw', function () {
                let belumBBN = 0;
                let dtBelumBBN = tableReport.columns(2).data()[0];
                dtBelumBBN.forEach(function (v,i) {
                    belumBBN += parseInt(v);
                });
                vTotalBelumBbn.val(belumBBN);

                let sudahBBN = 0;
                let dtSudahBBN = tableReport.columns(3).data()[0];
                dtSudahBBN.forEach(function (v,i) {
                    sudahBBN += parseInt(v);
                });
                vTotalSudahBbn.val(sudahBBN);

                let total = 0;
                let dtTotal = tableReport.columns(4).data()[0];
                dtTotal.forEach(function (v,i) {
                    total += parseInt(v);
                });
                vTotalBbn.val(total);
            });

            dExcel.click(function (e) {
                e.preventDefault();
                download.src = '{{ url('laporan/bbn-per-samsat/export/excel') }}';
                if (iSamsat.val() === null) {
                    window.open('{{ url('laporan/bbn-per-samsat/export/excel/all') }}');
                } else {
                    window.open('{{ url('laporan/bbn-per-samsat/export/excel') }}/'+iSamsat.val());
                }
            });

            dPdf.click(function (e) {
                e.preventDefault();
                if (iSamsat.val() === null) {
                    window.open('{{ url('laporan/bbn-per-samsat/export/pdf/all') }}');
                } else {
                    window.open('{{ url('laporan/bbn-per-samsat/export/pdf') }}/'+iSamsat.val());
                }
            });
        });
    </script>
@endsection