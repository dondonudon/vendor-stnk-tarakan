<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Rekap Tagihan per PO</title>
    <link rel="stylesheet" href="{{ public_path('assets/pdf/kuitansi-validasi.css') }}">
</head>
<body>
<header>
    <table>
        <tr>
            <td colspan="3" class="header-company">
                CV. {{ config('app.name') }}
            </td>
        </tr>
        <tr>
            <td style="width: 12%">Tanggal STNK</td>
            <td class="text-right" style="width: 1%">:</td>
            <td>{{ date('d F Y',strtotime($mst['tgl'])) }}</td>
        </tr>
        <tr>
            <td>Nomor PO</td>
            <td class="text-right">:</td>
            <td>{{ implode(', ',$no_po) }}</td>
        </tr>
        <tr>
            <td>Wilayah</td>
            <td class="text-right">:</td>
            <td>{!! $mst['wilayah'] !!}</td>
        </tr>
    </table>
    <hr>
</header>

<footer>
    <table style="width: 100%">
        <tr>
            <td class="text-center" style="width: 30%;vertical-align: bottom">DISERAHKAN OLEH</td>
            <td style="width: 40%;"></td>
            <td class="text-center" style="width: 30%">{!! $company['kota']->value !!}, {{ date('d F Y') }},<br>DITERIMA OLEH</td>
        </tr>
        <tr>
            <td style="height: 80px"></td>
            <td style="height: 80px"></td>
            <td style="height: 80px"></td>
        </tr>
        <tr>
            <td class="text-center" style="background-color: #e1e1e1;">{{ strtoupper($company['pic_area']->value) }}</td>
            <td></td>
            <td class="text-center" style="background-color: #e1e1e1; height: 30px"></td>
        </tr>
    </table>

</footer>

<main>
    <span class="text-bold">REKAP SERAH TERIMA {{ strtoupper($area) }} ASLI KE {!! $mst['dealer'] !!}</span>
    <table class="table-transaksi">
        <thead>
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">NAMA</th>
            <th class="text-center">NO POLISI</th>
            <th class="text-center">TYPE</th>
            <th class="text-center">NO MESIN</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($trn as $t)
            <tr>
                <td class="text-center" style="width: 5%">{{ $i }}</td>
                <td>{{ (strlen($t->nama_stnk) > 30) ? substr($t->nama_stnk,0,25).' ...' : $t->nama_stnk }}</td>
                <td style="width: 17%">{{ $t->no_pol }}</td>
                <td style="width: 20%">{{ $t->kode_kendaraan }}</td>
                <td style="width: 20%">{{ $t->no_mesin }}</td>
            </tr>
            @php($i++)
        @endforeach
        </tbody>
    </table>
</main>


</body>
</html>