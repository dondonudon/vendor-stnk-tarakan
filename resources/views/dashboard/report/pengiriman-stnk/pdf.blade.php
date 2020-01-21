<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Penerimaan STNK Oleh Dealer</title>
    <link rel="stylesheet" href="{{ public_path('assets/pdf/laporan-pengiriman.css') }}">
</head>
<body>
<header>
    <table>
        <tr>
            <td class="header-company">CV. {{ config('app.name') }}</td>
        </tr>
        <tr>
            <td>SERAH TERIMA STNK {{ join(', ',$dealer) }}</td>
        </tr>
        <tr>
            <td>WILAYAH {{ join(', ',$wilayah) }}</td>
        </tr>
        <tr>
            <td>TANGGAL {{ date('d F Y',strtotime($start)).' - '.date('d F Y',strtotime($end)) }}</td>
        </tr>
    </table>
    <hr>
</header>

<footer>
    {{--    <table style="width: 100%">--}}
    {{--        <tr>--}}
    {{--            <td rowspan="3" style="width: 65%"></td>--}}
    {{--            <td style="text-align: center; font-size: 16px">--}}
    {{--                {{ $company['kota']->value.', '.date('d F Y') }}--}}
    {{--            </td>--}}
    {{--        </tr>--}}
    {{--        <tr>--}}
    {{--            <td style="text-align: center; color: darkgray; height: 70px">MATERAI</td>--}}
    {{--        </tr>--}}
    {{--        <tr>--}}
    {{--            <td style="text-align: center; font-size: 14px; font-weight: bold;">--}}
    {{--                <pre>(     {{ $company['pic_area']->value }}     )</pre>--}}
    {{--            </td>--}}
    {{--        </tr>--}}
    {{--    </table>--}}
</footer>

<main>
    <table class="table-transaksi">
        <thead>
        <tr class="text-center">
            <th>NO</th>
            <th>NAMA</th>
            <th>NOMOR MESIN</th>
            <th>NO. PLAT</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($data as $d)
            <tr>
                <td class="text-center" style="width: 5%">{{ $i }}</td>
                <td>{{ $d->nama_stnk }}</td>
                <td>{{ $d->no_mesin }}</td>
                <td style="width: 13%">{{ $d->no_pol }}</td>
            </tr>
            @php($i++)
        @endforeach
        </tbody>
    </table>
</main>


</body>
</html>