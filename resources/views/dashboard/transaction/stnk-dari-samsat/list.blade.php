@extends('dashboard.layout')

@section('title','Transaction - STNK dari SAMSAT')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>STNK belum terima dari SAMSAT</h4>
                    </div>
                    <div class="card-body">
                        <table id="listTable" class="table table-striped table-bordered display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>No PO</th>
                                <th>Tanggal PO</th>
                                <th>Dealer</th>
                                <th>Samsat</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Total</th>
                                <th>User Input</th>
                                <th>Info</th>
                                <th>Tanggal Input</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnValidasi" class="btn btn-block btn-success" disabled>
                                    <i class="fas fa-check mr-2"></i>Validasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let btnValidasi = $('#btnValidasi');

        let dataID;

        $(document).ready(function () {
            let listTable = $('#listTable').DataTable({
                scrollX: true,
                ajax: {
                    url: '{{ url('transaction/stnk-dari-samsat/list') }}'
                },
                columns: [
                    {data: 'no_po'},
                    {
                        data: 'tgl_po',
                        render: function (data) {
                            return moment(data,'YYYY-MM-DD').format('DD-MM-YYYY');
                        }
                    },
                    {data: 'dealer'},
                    {data: 'samsat'},
                    {data: 'provinsi'},
                    {data: 'kota'},
                    {
                        data: 'total',
                        render: function (data) {
                            return '<div class="text-right">'+numeral(data).format('0,0.0')+'</div>';
                        }
                    },
                    {data: 'user'},
                    {data: 'keterangan'},
                    {
                        data: 'created_at',
                        render: function (data) {
                            return moment(data,'YYYY-MM-DD HH:mm:ss').format('DD-MM-YYYY HH:mm');
                        }
                    },
                ],
            });
            $('#listTable tbody').on('click','tr',function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    btnValidasi.attr('disabled',true);

                    dataID = null;
                } else {
                    listTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    btnValidasi.removeAttr('disabled');


                    let data = listTable.row('.selected').data();
                    dataID = data['no_po'];
                }
            });

            btnValidasi.click(function (e) {
                e.preventDefault();
                window.location = '{{ url('transaction/stnk-dari-samsat/validasi') }}/'+dataID;
            })
        });
    </script>
@endsection
