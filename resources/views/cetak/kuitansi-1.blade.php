<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Rekap Tagihan per PO</title>

    <style>
        /**
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
         **/
        @page {
            /*size: A5 landscape;*/
            margin-top: 80px;
            margin-right: 25px;
            margin-left: 25px;
            margin-bottom: 90px;
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 1.5cm;
            margin-bottom: 3.5cm;
            margin-left: 0.8cm;
            margin-right: 0.8cm;
            /*background-color: rgba(255, 93, 0, 0.45);*/
            /*margin-bottom: -10px*/
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: left;
            line-height: 20px;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 3cm;
            left: 0px;
            right: 0px;
            /*height: 40px;*/

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: center;
            width: 100%;
            margin-top: 5px;
            font-weight: bold;
            /*line-height: 35px;*/
        }

        .page-break {
            page-break-after: always;
        }

        .company-name {
            width: 50%;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 4px solid black;
        }

        .alamat {
            font-size: 13px;
        }

        .tipe {
            text-align: right;
            color: white;
            padding-right: 15px;
            font-size: 35px;
            font-weight: bold
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td, .table th {
            border: 1px solid #dddddd;
            /*text-align: left;*/
            padding: 1px;
        }

        .table-trn td, .table-trn th {
            /*border: 1px solid black;*/
            padding: 5px;
            vertical-align: top;
            font-size: 15px;
            margin-top: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        .color-gray {
            background-color: #e4e4e4;
        }
    </style>
</head>
<body>
<header>
    <table>
        <tr>
            <td>
                <img src="assets/img/kuitansi-1.png" style="width: 100%; height: 160%">
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top: -2.1cm; margin-left: 10px">
        <tr>
            <td class="company-name">
                CV. {{ strtoupper(config('app.name')) }}
            </td>
            <td class="tipe" rowspan="2">
                KUITANSI
            </td>
        </tr>
        <tr>
            <th>
                {{ $company['alamat']->value }}
            </th>
        </tr>
    </table>
</header>

<footer>
    <table style="width: 100%">
        <tr>
            <td rowspan="3" width="65%">
                <table style="font-size: 14px">
                    <tr>
                        <td>Transaksi Bank</td>
                        <td>:</td>
                        <td>{{ $company['bank']->value }}</td>
                    </tr>
                    <tr>
                        <td>No Rekening</td>
                        <td>:</td>
                        <td>{{ chunk_split($company['no_rekening']->value,4,' ') }}</td>
                    </tr>
                    <tr>
                        <td>Nama Rekening</td>
                        <td>:</td>
                        <td>{{ $company['nama_rekening']->value }}</td>
                    </tr>
                </table>
            </td>
            <td style="text-align: center; font-size: 16px">
                {{ $company['kota']->value.', '.date('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="text-align: center; color: darkgray; height: 100px">MATERAI</td>
        </tr>
        <tr>
            <td style="text-align: center; font-size: 14px; font-weight: bold;">
                <pre>(     {{ $company['pic_area']->value }}     )</pre>
            </td>
        </tr>
    </table>
</footer>

<main>
    <table class="table-trn">
        <tr>
            <td class="text-bold" style="width: 150px">No Bukti</td>
            <td style="width: 2px">:</td>
            <td>{{ request()->segment(3) }}</td>
        </tr>
        <tr>
            <td class="text-bold">Sudah diterima dari</td>
            <td>:</td>
            <td>{{ $transaksi->dealer }}</td>
        </tr>
        <tr>
            <td class="text-bold">Banyak Uang</td>
            <td>:</td>
            <td>Rp {{ number_format($transaksi->total) }}</td>
        </tr>
        <tr>
            <td class="text-bold">Terbilang</td>
            <td>:</td>
            <td>{{ strtoupper(Riskihajar\Terbilang\Facades\Terbilang::make($transaksi->total,' rupiah')) }}</td>
        </tr>
        <tr>
            <td class="text-bold">Untuk Pembayaran</td>
            <td>:</td>
            <td>NOTICE DAN JASA PENGURUSAN BBN {{ $transaksi->jumlah }} UNIT</td>
        </tr>
    </table>
</main>


</body>
</html>