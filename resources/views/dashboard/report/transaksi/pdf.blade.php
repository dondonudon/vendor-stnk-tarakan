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
            margin-top: 100px;
            margin-right: 50px;
            margin-left: 50px;
            margin-bottom: 100px;
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 1cm;
            margin-bottom: 0.5cm;
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
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: center;
            line-height: 35px;
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

        .color-gray {
            background-color: #e4e4e4;
        }
    </style>
</head>
<body>
<header>
    <table style="width: 100%">
        <tr>
            <td colspan="3" style="width: 40%; font-size: 15px; font-weight: bold;">
                CV. {{ config('app.name') }}
            </td>
        </tr>
    </table>
    <table class="table-sm" style="font-size: 15px; border-collapse: collapse;">
        <tr>
            <td>Laporan</td>
            <td>:</td>
            <td>{{ ucfirst(request()->segment(2)) }}</td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td>{{ date('d F Y',strtotime(request()->segment(5))).' - '.date('d F Y',strtotime(request()->segment(6))) }}</td>
        </tr>
        <tr>
            <td>Dibuat Pada</td>
            <td>:</td>
            <td>{{ date('d F Y H:i:s') }}</td>
        </tr>
    </table>
</header>

<footer style="font-size: 15px">
    <table style="width: 100%; margin: 10px">
        <tr>
            <td style="text-align: left">
                &copy; <?php echo date("Y");?> {{ request()->getHttpHost() }}
            </td>
        </tr>
    </table>
</footer>

<main style="margin-top: 30px">
    <table class="table" style="width: 100%">
        <thead>
        <tr class="text-center">
            <th style="width: 6%">TGL PO</th>
            <th>NAMA</th>
            <th>DAERAH</th>
            <th style="width: 2%">JML</th>
            <th>NOTICE</th>
            <th>NO PO</th>
            <th>JASA</th>
            <th>PENCAIRAN</th>
            <th>PNBP</th>
            <th>LABA KOTOR</th>
            <th>PPH</th>
            <th>OMSET</th>
        </tr>
        </thead>
        <tbody>
        @php
        $pencairan = 0;
        @endphp
        @foreach($data as $t)
            <tr>
                <td>{{ date('d-m-Y',strtotime($t->tgl_po)) }}</td>
                <td>{{ $t->nama }}</td>
                <td>{{ $t->daerah }}</td>
                <td class="text-center">{{ $t->jumlah }}</td>
                <td class="text-right">{{ number_format($t->notice) }}</td>
                <td>{{ $t->no_po }}</td>
                <td class="text-right">{{ number_format($t->jasa) }}</td>
                <td class="text-right">{{ number_format($t->pencairan) }}</td>
                <td class="text-right">{{ number_format($t->pnbp) }}</td>
                <td class="text-right">{{ number_format($t->laba_kotor) }}</td>
                <td class="text-right">{{ number_format($t->pph) }}</td>
                <td class="text-right">{{ number_format($t->omset) }}</td>
            </tr>
            {{ $pencairan += $t->pencairan }}
        @endforeach
        <tr class="color-gray">
            <th class="text-center" colspan="7">TOTAL</th>
            <th class="text-center">{{ number_format($pencairan) }}</th>
            <th class="text-center" colspan="4"></th>
        </tr>
        </tbody>

    </table>
</main>


</body>
</html>