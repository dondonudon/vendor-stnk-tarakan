@extends('dashboard.layout')

@section('title','Laporan - Pengiriman BPKB')

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
{{--                                    <div class="form-group">--}}
{{--                                        <label for="iNoPO">NO Purchase Order</label>--}}
{{--                                        <select name="no_po" id="iNoPO" style="width: 100%" required></select>--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="fTanggal">Tanggal</label>
                                        <input type="text" class="form-control text-right" id="fTanggal">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="fDealer">Dealer</label>
                                        <select name="dealer" id="fDealer" style="width: 100%" required></select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-7"></div>
{{--                                <div class="col-sm-12 col-lg-2">--}}
{{--                                    <button type="submit" class="btn btn-block btn-primary">VIEW</button>--}}
{{--                                </div>--}}
                            </div>
                        </form>
                        <hr>
                        <table id="tableReport" class="table table-sm table-striped table-borderless nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>NAMA STNK</th>
                                <th>NO POLISI</th>
                                <th>NOMOR MESIN</th>
                                <th>DEALER</th>
                            </tr>
                            </thead>
                        </table>
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
        let dExcel = $('#dExcel');
        let dPdf = $('#dPdf');
        let iNoPO = $('#iNoPO');
        let iStatus = $('#iStatus');
        const fTanggal = $('#fTanggal');
        const fDealer = $('#fDealer');
        let dataID;

        let tableReport = $('#tableReport').DataTable({
            scrollX: true,
            columns: [
                {data: 'nama_stnk'},
                {data: 'no_pol'},
                {data: 'no_mesin'},
                {data: 'dealer'},
            ],
        });

        function reloadReport(tanggal,dealer) {
            $.ajax({
                url: '{{ url('laporan/pengiriman-bpkb/list') }}',
                method: 'post',
                data: {
                    start: tanggal.data('daterangepicker').startDate.format('YYYY-MM-DD'),
                    end: tanggal.data('daterangepicker').endDate.format('YYYY-MM-DD'),
                    dealer: dealer.val() == null ? 'all' : dealer.val()
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
            fTanggal.daterangepicker({
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: {
                    format: 'DD/MM/YYYY'
                },
            });

            fDealer.select2({
                ajax: {
                    url: '{{ url('data/dealer') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });

            reloadReport(fTanggal,fDealer);

            fTanggal.on('apply.daterangepicker',function (ev,picker) {
                reloadReport(fTanggal,fDealer);
            });
            fDealer.change(function (e) {
                reloadReport(fTanggal,$(this));
            });

            dExcel.click(function (e) {
                e.preventDefault();
                let data = [
                    fTanggal.data('daterangepicker').startDate.format('YYYY-MM-DD'),
                    fTanggal.data('daterangepicker').endDate.format('YYYY-MM-DD'),
                    fDealer.val() == null ? 'all' : fDealer.val(),
                ];
                bExport.addClass('d-none');
                loading.removeClass('d-none');
                download.src = '{{ url('laporan/pengiriman-bpkb/export/excel') }}/'+data.join('/');
            });

            dPdf.click(function (e) {
                e.preventDefault();
                let data = [
                    fTanggal.data('daterangepicker').startDate.format('YYYY-MM-DD'),
                    fTanggal.data('daterangepicker').endDate.format('YYYY-MM-DD'),
                    fDealer.val() == null ? 'all' : fDealer.val(),
                ];
                window.open('{{ url('laporan/pengiriman-bpkb/export/pdf') }}/'+data.join('/'));
            });

            window.onfocus = function () {
                loading.addClass('d-none');
                bExport.removeClass('d-none');
            }
        });
    </script>
@endsection