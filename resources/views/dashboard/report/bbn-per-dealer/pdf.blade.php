<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan BBN per DEALER</title>

    <style>
        /**
             Set the margins of the page to 0, so the footer and the header
             can be of the full height and width !
          **/
        @page {
            margin-top: 100px;
            margin-right: 50px;
            margin-left: 50px;
            margin-bottom: 100px;
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 1.5cm;
            margin-bottom: 3.5cm;
            /*background-color: #0f6674;*/
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 2.5cm;
            /*background-color: #0b5885;*/

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: left;
            line-height: 20px;
            font-size: 12px;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 4.5cm;

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: center;
            line-height: 35px;
        }

        /*.header table, .header tr, .header td {*/
        /*    border: 1px red solid;*/
        /*}*/

        .title {
            font-size: 25px;
            font-weight: bold;
        }

        .sub-title {
            font-size: 20px;
            font-weight: bold;
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

        .table-sm td, .table-sm th {
            /*border: 1px solid black;*/
            /*padding: 1px 1px;*/
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
    <table class="header" style="width: 100%">
        <tr>
            <td style="width: 40%">
                <table style="width: 100%">
                    <tr>
                        <td class="title" colspan="3">CV. {{ config('app.name') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold" style="width: 15%">Dealer</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 80%">{{ $data[0]->dealer }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Status</td>
                        <td>:</td>
                        <td>{{ request()->segment(7) == 0 ? 'Belum BBN' : 'Sudah BBN' }}</td>
                    </tr>
                </table>
            </td>
            <td style="width: 25%"></td>
            <td style="width: 35%; vertical-align: top">
                <table style="width: 100%; text-align: right">
                    <tr>
                        <td class="sub-title" colspan="3">Laporan BBN per DEALER</td>
                    </tr>
                    <tr>
                        <td class="text-bold" style="width: 30%">Dibuat Pada</td>
                        <td style="width: 5%">:</td>
                        <td>{{ date('d F Y - H:i:s') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold" style="width: 30%">Dibuat Oleh</td>
                        <td style="width: 5%">:</td>
                        <td>{{ request()->session()->get('name') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr>
</header>

<footer style="font-size: 15px">
    <table style="width: 100%">
        <tr>
            <td rowspan="3" style="width: 65%"></td>
            <td style="text-align: center; font-size: 16px">
                {{ $company['kota']->value.', '.date('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="text-align: center; color: darkgray; height: 70px">MATERAI</td>
        </tr>
        <tr>
            <td style="text-align: center; font-size: 14px; font-weight: bold;">
                <pre>(     {{ $company['pic_area']->value }}     )</pre>
            </td>
        </tr>
    </table>
</footer>

<main>
    <table class="table" style="width: 100%">
        <thead>
        <tr class="text-center">
            <th>DEALER</th>
            <th>NOMOR PO</th>
            <th>JUMLAH</th>
            <th>BERKAS</th>
            <th>WILAYAH</th>
            <th>NOTICE</th>
            <th>TANGGAL</th>
        </tr>
        </thead>
        <tbody>
        @php
        $jumlah = 0;
        $notice = 0;
        @endphp
        @foreach($data as $t)
            <tr>
                <td>{{ $t->dealer }}</td>
                <td>{{ $t->no_po }}</td>
                <td class="text-center">{{ $t->total }}</td>
                <td>{{ $t->berkas }}</td>
                <td>{{ $t->wilayah }}</td>
                <td class="text-right">{{ number_format($t->notice) }}</td>
                <td>{{ date('d-m-Y',strtotime($t->tanggal)) }}</td>
            </tr>
            {{ $jumlah += $t->total }}
            {{ $notice += $t->notice }}
        @endforeach
        <tr class="color-gray">
            <th class="text-center" colspan="2">TOTAL</th>
            <th class="text-center">{{ $jumlah }}</th>
            <th class="text-center" colspan="2"></th>
            <th class="text-right">{{ number_format($notice) }}</th>
            <th></th>
        </tr>
        </tbody>

    </table>
</main>


</body>
</html>