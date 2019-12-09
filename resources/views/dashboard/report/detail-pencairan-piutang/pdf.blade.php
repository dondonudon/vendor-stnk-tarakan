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
            margin: 70px 25px;
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin: 2.5cm 0.5cm 0.5cm ;
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
            line-height: 35px;
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
            padding: 3px;
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
            <td style="width: 60%; font-size: 15px; font-weight: bold; text-align: right">
                Laporan Transaksi
            </td>
        </tr>
{{--        <tr>--}}
{{--            <td style="width: 70px; font-size: 15px; font-weight: bold;">--}}
{{--                Tanggal--}}
{{--            </td>--}}
{{--            <td style="width: 2px">:</td>--}}
{{--            <td style="width: 100%; font-size: 15px">--}}
{{--                {{ date('d F Y',strtotime($data[0]->tanggal)) }}--}}
{{--            </td>--}}
{{--            <td style="text-align: right">--}}
{{--                Dibuat Pada:--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td style="font-size: 15px; font-weight: bold;">--}}
{{--                No PO--}}
{{--            </td>--}}
{{--            <td>:</td>--}}
{{--            <td style="font-size: 15px">--}}
{{--                {{ $data[0]->no_po }}--}}
{{--            </td>--}}
{{--            <td style="text-align: right">--}}
{{--                {{ date('d F Y - H:i:s') }}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td style="font-size: 15px; font-weight: bold;">--}}
{{--                Wilayah--}}
{{--            </td>--}}
{{--            <td>:</td>--}}
{{--            <td style="font-size: 15px">--}}
{{--                {{ $data[0]->wilayah }}--}}
{{--            </td>--}}
{{--        </tr>--}}
    </table>
</header>

<footer style="font-size: 15px">
    <table style="width: 100%; margin: 10px">
        <tr>
            <td style="text-align: left">
                &copy; <?php echo date("Y");?> {{ config('app.name') }}
            </td>
        </tr>
    </table>
</footer>

<main style="margin-top: 40px">
    <table class="table" style="width: 100%">
        <thead>
        <tr class="text-center">
            <th width="7%">TGL PO</th>
            <th>NAMA</th>
            <th>DAERAH</th>
            <th>JML</th>
            <th>NOTICE</th>
            <th>NO PO</th>
            <th>PENCAIRAN</th>
            <th>TGL TAGIHAN</th>
            <th>SERAH STNK</th>
            <th>TGL PROSES CABANG</th>
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
                <td>{{ $t->no_po }}</td>
                <td class="text-right">{{ number_format($t->pencairan) }}</td>
                <td>{{ $t->no_po }}</td>
                <td>{{ $t->tgl_tagihan }}</td>
                <td>{{ $t->serah_stnk }}</td>
                <td>{{ $t->tgl_proses_cabang }}</td>
            </tr>
            {{ $pencairan += $t->pencairan }}
        @endforeach
        <tr class="color-gray">
            <th class="text-center" colspan="5">TOTAL</th>
            <th class="text-center">{{ number_format($pencairan) }}</th>
            <th class="text-center" colspan="4"></th>
        </tr>
        </tbody>

    </table>
</main>


</body>
</html>