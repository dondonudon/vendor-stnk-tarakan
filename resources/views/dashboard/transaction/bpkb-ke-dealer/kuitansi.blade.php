@extends('dashboard.layout')

@section('title','Transaction - BPKB ke Dealer')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>History Kuitansi</h4>
                    </div>
                    <div class="card-body p-0">
{{--                        {{ implode("_",['2001PD0001','2001PD0002','2001PD0003','2001PD0004']) }}--}}
                        <div class="thead-dark table-sm table-striped table-bordered" id="listTable" style="width: 100%"></div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnCetakBeberapa" class="btn btn-block btn-info" disabled>
                                    <i class="fas fa-print mr-2"></i>CETAK Beberapa PO
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnCetak" class="btn btn-block btn-success" disabled>
                                    <i class="fas fa-print mr-2"></i>CETAK
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
        let btnCetak = $('#btnCetak');
        const btnCetakBeberapa = $('#btnCetakBeberapa');

        let dataID;

        $(document).ready(function () {
            let listTable = new Tabulator("#listTable", {
                resizableColumns: false,
                layout: "fitData",
                selectable: true,
                placeholder: 'No Data Available',
                pagination: "remote",
                ajaxFiltering: true,
                ajaxURL: "{{ url('transaction/bpkb-ke-dealer/history-kuitansi/data') }}",
                ajaxConfig: {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    }
                },
                ajaxURLGenerator:function(url, config, params){
                    return url + "?page=" + params.page;
                },
                ajaxResponse:function(url, params, response){
                    // console.log(response);
                    return response;
                },
                columns: [
                    {formatter:"rownum",align:"center"},
                    {title:"Kode Validasi",field:"kode_validasi"},
                    {title:"Tgl Validasi",field:"tgl_validasi"},
                    {title:"No PO",field:"no_po"},
                    {title:"Dealer",field:"dealer"},
                ],
                rowSelectionChanged:function (data,rows) {
                    if (data.length == 1) {
                        btnCetak.removeAttr('disabled');
                        btnCetakBeberapa.attr('disabled',true);
                    } else if (data.length > 1) {
                        btnCetak.attr('disabled',true);
                        btnCetakBeberapa.removeAttr('disabled');
                    } else {
                        btnCetak.attr('disabled',true);
                        btnCetakBeberapa.attr('disabled',true);
                    }
                },
                selectableCheck:function(row){
                    let rowData = row.getData();
                    let data =  this.getSelectedData();

                    if (data.length > 0) {
                        if (rowData.dealer == data[0].dealer && rowData.tgl_validasi == data[0].tgl_validasi) {
                            return row;
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Data',
                                text: 'Untuk mencetak beberapa kuitansi PO, Tanggal Validasi dan Dealer harus sama!'
                            });
                        }
                    } else {
                        return row;
                    }
                    // return row.getData().age > 18;
                },
            });

            btnCetak.click(function (e) {
                e.preventDefault();
                let PO = listTable.getSelectedData()[0].kode_validasi;
                window.open('{{ url('cetak/bpkb-dealer') }}/'+PO);
            });

            btnCetakBeberapa.click(function (e) {
                let PO = new Array();
                listTable.getSelectedData().forEach(function (v,i) {
                    PO.push(v.kode_validasi);
                });
                window.open('{{ url('cetak/bpkb-dealer') }}/'+PO.join('_'));
            });
        });
    </script>
@endsection
