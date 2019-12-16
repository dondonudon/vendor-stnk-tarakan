@extends('dashboard.layout')

@section('title','Master Dealer')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Dealer</h4>
                    </div>
                    <div class="card-body">
                        <table id="listTable" class="table table-sm table-striped table-bordered display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Nama</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>PIC</th>
                                <th>Jatuh Tempo</th>
                                <th>Harga Jasa</th>
                                <th>Kuitansi</th>
                                <th>Keterangan</th>
                                <th>Tgl Input</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnStatus" class="btn btn-block btn-outline-danger" disabled>
                                    <i class="fas fa-exchange-alt mr-2"></i>Ubah Status
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnEdit" class="btn btn-block btn-outline-info" disabled>
                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <a href="{{ url('master/dealer/baru') }}" class="btn btn-block btn-primary">
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
        let btnStatus = $('#btnStatus');

        let dataID,dataStatus;

        function changeStatus(id,status,table) {
            $.ajax({
                url: '{{ url('master/dealer/update-status') }}',
                method: 'post',
                data: {
                    id: id,
                    status: status
                },
                success: function (response) {
                    if (response === 'success') {
                        table.ajax.reload();
                    } else {
                        console.log(response);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal update status',
                            text: 'Silahkan coba lagi atau hubungi WAVE Solusi Indonesia',
                        });
                    }
                },
                error: function (response) {
                    console.log(response);
                    Swal.fire({
                        icon: 'error',
                        title: 'System error',
                        text: 'Silahkan  hubungi WAVE Solusi Indonesia',
                    });
                }
            })
        }

        $(document).ready(function () {
            let listTable = $('#listTable').DataTable({
                scrollX: true,
                ajax: {
                    url: '{{ url('master/dealer/list') }}'
                },
                columns: [
                    {
                        data: 'status',
                        render: function (data) {
                            if (data === 1) {
                                return 'Aktif';
                            } else {
                                return 'Nonaktif';
                            }
                        },
                        createdCell: function (td, cellData, rowData, row, col) {
                            if (cellData === 1) {
                                $(td).css('background-color', 'green');
                                $(td).css('color', 'white');
                            } else {
                                $(td).css('background-color', 'maroon');
                                $(td).css('color', 'white');
                            }
                        }
                    },
                    {data: 'nama'},
                    {data: 'provinsi'},
                    {data: 'kota'},
                    {data: 'alamat'},
                    {data: 'telp'},
                    {data: 'pic'},
                    {
                        data: 'jatuh_tempo',
                        render: function (data) {
                            return data+' hari';
                        }
                    },
                    {
                        data: 'harga_jasa',
                        render: function (data) {
                            return '<div class="text-right">'+numeral(data).format('0,0.0')+'</div>';
                        }
                    },
                    {
                        data: 'kuitansi',
                        render: function (data) {
                            return (data === 1) ? '1 Lembar' : '2 Lembar';
                        }
                    },
                    {data: 'keterangan'},
                    {data: 'created_at'},
                ],
            });
            $('#listTable tbody').on('click','tr',function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    btnEdit.attr('disabled',true);
                    btnStatus.attr('disabled',true);

                    dataID = null;
                    dataStatus = null;
                } else {
                    listTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    btnEdit.removeAttr('disabled');
                    btnStatus.removeAttr('disabled');

                    let data = listTable.row('.selected').data();
                    dataID = data.id;
                    dataStatus = data.status;
                }
            });

            btnStatus.click(function (e) {
                e.preventDefault();
                changeStatus(
                    dataID,
                    (dataStatus === 1) ? '0' : '1',
                    listTable
                );
            });

            btnEdit.click(function (e) {
                e.preventDefault();
                window.location = '{{ url('master/dealer/edit') }}/'+dataID;
            })
        });
    </script>
@endsection
