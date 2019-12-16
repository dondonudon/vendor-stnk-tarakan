@extends('dashboard.layout')

@section('title','Transaction - Purchase Order')

@section('content')
    <div class="section-body">
        <form id="formData">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Purchase Order Baru</h4>
                        </div>
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nomor PO</label>
                                        <input name="no_po" id="noPO" type="text" class="form-control" autocomplete="off" required>
                                        <small id="noPoFeedback" class=""></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Tanggal PO</label>
                                        <input name="tgl_po" id="tgl_po" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Dealer</label>
                                        <select name="dealer" id="iDealer" style="width: 100%" required></select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Samsat</label>
                                        <select name="samsat" id="iSamsat" style="width: 100%" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select id="iProvinsi" name="provinsi" style="width: 100%" required></select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <select id="iKota" name="kota" style="width: 100%" required></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <table id="daftarKendaraan" class="table table-sm table-bordered table-striped nowrap" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Kode Kendaraan</th>
                                    <th>No Mesin</th>
                                    <th>Nama STNK</th>
                                    <th>Harga Jasa</th>
                                    <th>Harga Notice</th>
                                    <th>PNBP</th>
                                    <th>PPH</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-3 mt-2 mt-lg-0">
                                    <button class="btn btn-sm btn-block btn-outline-danger d-none" id="btnHapusKendaraan">
                                        <i class="fas fa-times mr-2"></i> Hapus Kendaraan
                                    </button>
                                </div>
                                <div class="col-sm-12 col-lg-3 mt-2 mt-lg-0">
                                    <button class="btn btn-sm btn-block btn-success" id="btnTambahKendaraan">
                                        <i class="fas fa-plus mr-2"></i> Tambah Kendaraan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input id="iTotal" name="total" type="text" class="form-control text-right" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-sm-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input id="iKeterangan" name="keterangan" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-secondary">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-3 mt-2 mb-lg-0">
                                    <button type="submit" id="btnBaru" class="btn btn-block btn-success"><i class="fas fa-check mr-2"></i>Simpan Transaksi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="formKendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Form Kendaraan</h5>
                </div>
                <form id="dataFormKendaraan">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label for="iKodeKendaraan">Kode Kendaraan</label>
                                    <select id="iKodeKendaraan" name="kode_kendaraan" style="width: 100%">
                                        <option value="default" selected>- pilih kode kendaraan -</option>
                                        @foreach($data['kendaraan'] as $kendaraan)
                                            <option value="{{ $kendaraan['tipe'] }}">{{ $kendaraan['tipe'].' - '.$kendaraan['nama'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>No Mesin</label>
                                    <input name="no_mesin" id="iNoMesin" type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="form-group">
                                    <label>Nama STNK</label>
                                    <input name="nama_stnk" id="iNamaStnk" type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="iHargaJasa">Harga Jasa</label>
                                    <input name="harga_jasa" id="iHargaJasa" type="text" class="form-control text-right" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="iHargaNoticeBbn">Harga Notice</label>
                                    <input name="harga_notice" id="iHargaNoticeBbn" type="text" class="form-control text-right" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="iPNBP">PNBP</label>
                                    <input name="harga_pnbp" id="iPNBP" type="text" class="form-control text-right" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="iPPH">PPH</label>
                                    <input name="harga_pph" id="iPPH" type="text" class="form-control text-right" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label for="iPPH">SubTotal</label>
                                    <input name="subtotal" id="iSubtotal" type="text" class="form-control text-right" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Kendaraan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        const dataDealer = JSON.parse('@json($data['dealer'])');
        const dataSamsat = JSON.parse('@json($data['samsat'])');
        const dataKendaraan = JSON.parse('@json($data['kendaraan'])');
        const dataHarga = JSON.parse('@json($data['harga'])');

        let formData = $('#formData');
        let formKendaraan = $('#formKendaraan');
        let dataFormKendaraan = $('#dataFormKendaraan');
        let feedbackNoPO = $('#noPoFeedback');

        let iTglPO = $('#tgl_po');
        let iNoPO = $('#noPO');
        let iDealer = $('#iDealer');
        let iSamsat = $('#iSamsat');
        let iProvinsi = $('#iProvinsi');
        let iKota = $('#iKota');
        let iTotal = $('#iTotal');

        let iKodeKendaraan = $('#iKodeKendaraan');
        let iNoMesin = $('#iNoMesin');
        let iNamaStnk = $('#iNamaStnk');
        let iHargaJasa = $('#iHargaJasa');
        let iHargaNoticeBbn = $('#iHargaNoticeBbn');
        let iPNBP = $('#iPNBP');
        let iPPH = $('#iPPH');
        let iSubtotal = $('#iSubtotal');

        let vHargaJasa;

        let btnTambahKendaraan = $('#btnTambahKendaraan');
        let btnHapusKendaraan = $('#btnHapusKendaraan');

        $(document).ready(function () {
            /*
            VALIDASI NO PO
             */
            iNoPO.keyup(function (e) {
                e.preventDefault();
                setTimeout(function () {
                    if ( iNoPO.val().length > 0 ) {
                        $.ajax({
                            url: '{{ url('transaction/purchase-order/validasi') }}',
                            method: 'post',
                            data: {
                                area:'no_po',
                                text: iNoPO.val(),
                            },
                            success: function (response) {
                                // console.log(response);
                                if (response === 'available') {
                                    iNoPO.removeClass('is-invalid');
                                    iNoPO.addClass('is-valid');
                                    feedbackNoPO.html('No Purchase Order Tersedia');
                                    feedbackNoPO.addClass('text-success');
                                    feedbackNoPO.removeClass('text-danger');
                                } else {
                                    iNoPO.removeClass('is-valid');
                                    iNoPO.addClass('is-invalid');
                                    feedbackNoPO.html('No Purchase Order Tidak Tersedia');
                                    feedbackNoPO.removeClass('text-success');
                                    feedbackNoPO.addClass('text-danger');
                                }
                            }
                        })
                    } else {
                        iNoPO.removeClass('is-invalid');
                        iNoPO.removeClass('is-valid');
                        feedbackNoPO.html('');
                    }
                }, 1000);
            });

            /*
            INISIALISASI SELECT2
            1. PROVINSI
            2. KOTA MUNCUL SETELAH PROVINSI TERPILIH
            */
            iDealer.select2({
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
            iProvinsi.select2({
                ajax: {
                    url: '{{ url('data/wilayah-provinsi') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });
            iKota.select2({
                ajax: {
                    url: '{{ url('data/wilayah-kota') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            provinsi: iProvinsi.val(),
                            search: params.term,
                        }
                    }
                }
            });

            /*
            1. INISIALISASI TABEL DAFTAR KENDARAAN
            2. ROW TABLE CLICKABLE - AGAR DAPAT DIPROSES UNTUK HAPUS
            3. FUNCTION UNTUK HAPUS DATA
             */
            let daftarKendaraan = $('#daftarKendaraan').DataTable({
                scrollX: true,
                columns: [
                    {data: 'kode_kendaraan'},
                    {data: 'no_mesin'},
                    {data: 'nama_stnk'},
                    {data: 'jasa'},
                    {data: 'notice'},
                    {data: 'pnbp'},
                    {data: 'pph'},
                    {data: 'subtotal'},
                ],
            });
            $('#daftarKendaraan tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
                if (daftarKendaraan.rows('.selected').data().length > 0) {
                    btnHapusKendaraan.removeClass('d-none');
                } else {
                    btnHapusKendaraan.addClass('d-none');
                }
            });
            btnHapusKendaraan.click(function (e) {
                e.preventDefault();
                btnHapusKendaraan.addClass('d-none');
                daftarKendaraan.rows('.selected').remove().draw(false);
            });
            daftarKendaraan.on('draw',function () {
                let daftarSubtotal = daftarKendaraan.columns(7).data()[0];
                let total = 0;
                daftarSubtotal.forEach(function (v,i) {
                    total += parseFloat(numeral(v).format('0.0'));
                });
                iTotal.val(numeral(total).format('0,0.0'));
            });

            /*
            INPUT TANGGAL
             */
            iTglPO.daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'D-M-Y'
                }
            });

            /*
            AREA MODAL TAMBAH KENDARAAN
            1. INISIALISASI SELECT2 DAN AMBIL NILAI HARGA
             */
            iKodeKendaraan.select2();
            iKodeKendaraan.change(function () {
                let notice,pnbp,pph;
                if (iKodeKendaraan.val() === 'default') {
                    iHargaNoticeBbn.val(0);
                    notice = parseFloat('0');
                    pnbp = parseFloat('0');
                    pph = parseFloat('0');
                } else {
                    notice = parseFloat(dataHarga[iKodeKendaraan.val()]['harga']);
                    pnbp = parseFloat(dataHarga[iKodeKendaraan.val()]['pnbp']);
                    pph = parseFloat(dataHarga[iKodeKendaraan.val()]['pph']);
                }
                let jasa = parseFloat(dataDealer[iDealer.val()]['harga_jasa']);
                let subtotal = (notice+pnbp+jasa)-pph;
                // console.log(subtotal);

                iHargaNoticeBbn.val(numeral(notice).format('0,0.0'));
                iPNBP.val(numeral(pnbp).format('0,0.0'));
                iHargaJasa.val(numeral(jasa).format('0,0.0'));
                iPPH.val(numeral(pph).format('0,0.0'));
                iSubtotal.val(numeral(subtotal).format('0,0.0'));
            });

            btnTambahKendaraan.click(function (e) {
                e.preventDefault();
                if (iDealer.val() === null) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Dealer wajib diisi',
                    })
                } else {
                    formKendaraan.modal('show');
                }
            });
            formKendaraan.on('hidden.bs.modal',function () {
                iKodeKendaraan.val('default').trigger('change');
                iNoMesin.val('');
                iNamaStnk.val('');
                iHargaJasa.val('');
                iHargaNoticeBbn.val('');
                iPNBP.val('');
                iPPH.val('');
                iSubtotal.val('');
            });

            /*
            PROSES SUBMIT FORM TAMBAH KENDARAAN
             */
            dataFormKendaraan.submit(function (e) {
                e.preventDefault();
                let daftarNoMesin = daftarKendaraan.columns(1).data()[0];
                let total = 0;
                let noMesin = iNoMesin.val();

                if (iKodeKendaraan.val() === 'default') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kode Kendaraan Wajib Diisi',
                    })
                } else if (daftarNoMesin.indexOf(noMesin) > -1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Nomor Mesin sudah terdata pada PO ini',
                    })
                } else {
                    formKendaraan.modal('hide');
                    let data = $(this).serializeArray();

                    daftarKendaraan.row.add({
                        'kode_kendaraan': data[0].value,
                        'no_mesin': data[1].value,
                        'nama_stnk': data[2].value,
                        'jasa': data[3].value,
                        'notice': data[4].value,
                        'pnbp': data[5].value,
                        'pph': data[6].value,
                        'subtotal': data[7].value,
                    }).draw();
                }
            });

            /*
            PROSES PENYIMPANAN DATA PURCHASE ORDER
             */
            formData.submit(function (e) {
                e.preventDefault();
                let mstForm = $(this).serializeArray();
                let mst = {};
                mstForm.forEach(function(v,i) {
                    mst[v.name] = v.value;
                });

                let trnForm = daftarKendaraan.data().toArray();
                let trn = [];
                let num = 0;
                trnForm.forEach(function(v,i) {
                    trn[num] = {
                        'kode_kendaraan': v['kode_kendaraan'],
                        'no_mesin': v['no_mesin'],
                        'nama_stnk': v['nama_stnk'],
                        'jasa': numeral(v['jasa']).format('0.0'),
                        'notice': numeral(v['notice']).format('0.0'),
                        'pnbp': numeral(v['pnbp']).format('0.0'),
                        'pph': numeral(v['pph']).format('0.0'),
                        'subtotal': numeral(v['subtotal']).format('0.0'),
                    };
                    num++;
                });

                let data = JSON.stringify({
                    'mst': mst,
                    'trn': trn,
                });
                console.log(mst);
                console.log(trn);
                console.log(data);
                $.ajax({
                    url: '{{ url('transaction/purchase-order/submit') }}',
                    method: 'post',
                    data: {data:data},
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Tersimpan',
                                showConfirmButton: false,
                                timer: 1000,
                                onClose: function () {
                                    window.location = '{{ url('transaction/purchase-order') }}';
                                }
                            });
                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Gagal Tersimpan',
                                text: 'Silahkan periksa ulang data anda dan coba lagi atau hubungi WAVE Solusi Indonesia',
                            });
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Gagal Tersimpan',
                            text: 'Silahkan hubungi WAVE Solusi Indonesia',
                        });
                    }
                })
            });
        });
    </script>
@endsection
