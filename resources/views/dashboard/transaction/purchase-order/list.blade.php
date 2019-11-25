@extends('dashboard.layout')

@section('title','Transaction - Purchase Order')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Purchase Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-end">
                            <div class="col-sm-12 col-lg-4 mt-lg-0">
                                <form method="get">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="search" placeholder="pencarian nomor PO">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                            <tbody>
                            @foreach($purchaseorder as $po)
                                <tr>
                                    <td>{{ $po->no_po }}</td>
                                    <td>{{ $po->tgl_po }}</td>
                                    <td>{{ $po->dealer }}</td>
                                    <td>{{ $po->samsat }}</td>
                                    <td>{{ $po->provinsi }}</td>
                                    <td>{{ $po->kota }}</td>
                                    <td>{{ $po->total }}</td>
                                    <td>{{ $po->user }}</td>
                                    <td>{{ $po->keterangan }}</td>
                                    <td>{{ $po->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-3 justify-content-between">
                            <div class="col-sm-12 col-lg-4 mt-lg-0">
                                <p>
                                    Halaman ke: {{ $purchaseorder->currentPage() }} dari {{ $purchaseorder->lastPage() }}
                                    <br>Total data: {{ $purchaseorder->total() }}
                                </p>
                            </div>
                            <div class="col-sm-12 col-lg-4 mt-lg-0">
                                <div class="d-flex justify-content-end">
{{--                                    {{ $purchaseorder->links() }}--}}
                                    {{ $purchaseorder->appends(['search' => $search])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnDetail" class="btn btn-block btn-outline-info" disabled>
                                    <i class="fas fa-print mr-2"></i>CETAK
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnDetail" class="btn btn-block btn-outline-info" disabled>
                                    <i class="fas fa-file-alt mr-2"></i>DETAIL
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <a href="{{ url('transaction/purchase-order/baru') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-plus mr-2"></i>PO BARU
                                </a>
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
        let btnDetail = $('#btnDetail');

        let dataID;

        $(document).ready(function () {
            let listTable = $('#listTable').DataTable({
                scrollX: true,
                paginate: false,
                searching: false,
                info: false,
                {{--ajax: {--}}
                {{--    url: '{{ url('transaction/purchase-order/list') }}'--}}
                {{--},--}}
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
                order: [
                    [9,'desc']
                ]
            });
            $('#listTable tbody').on('click','tr',function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    btnDetail.attr('disabled',true);

                    dataID = null;
                } else {
                    listTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    btnDetail.removeAttr('disabled');


                    let data = listTable.row('.selected').data();
                    dataID = data.no_po;
                }
            });

            btnDetail.click(function (e) {
                e.preventDefault();
                window.location = '{{ url('transaction/purchase-order/detail') }}/'+dataID;
            })
        });
    </script>
@endsection
