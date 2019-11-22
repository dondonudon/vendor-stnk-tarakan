@extends('dashboard.layout')

@section('title','Master Harga')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Harga</h4>
                    </div>
                    <div class="card-body">
                        <table id="listTable" class="table table-striped table-bordered display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Tipe Kendaraan</th>
                                <th>Harga Notice BBN</th>
                                <th>PNBP</th>
                                <th>PPH</th>
                                <th>Tgl Simpan</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnEdit" class="btn btn-block btn-outline-info" disabled>
                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <a href="{{ url('master/harga/baru') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-plus mr-2"></i>Tambah
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
        let btnEdit = $('#btnEdit');

        let dataID;

        $(document).ready(function () {
            let listTable = $('#listTable').DataTable({
                scrollX: true,
                ajax: {
                    url: '{{ url('master/harga/list') }}'
                },
                columns: [
                    {data: 'kode_kendaraan'},
                    {
                        data: 'harga',
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
                        data: 'pph',
                        render: function (data) {
                            return '<div class="text-right">'+numeral(data).format('0,0.0')+'</div>';
                        }
                    },
                    {data: 'created_at'},
                ],
            });
            $('#listTable tbody').on('click','tr',function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    btnEdit.attr('disabled',true);

                    dataID = null;
                } else {
                    listTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    btnEdit.removeAttr('disabled');

                    let data = listTable.row('.selected').data();
                    dataID = data.id;
                }
            });

            btnEdit.click(function (e) {
                e.preventDefault();
                window.location = '{{ url('master/harga/edit') }}/'+dataID;
            })
        });
    </script>
@endsection