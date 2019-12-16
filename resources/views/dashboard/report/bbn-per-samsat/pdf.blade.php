<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan BBN per SAMSAT</title>

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
            <td style="width: 10%">
{{--                <img src="{{ asset('assets/img/logo-lg.png') }}" alt="logo">--}}
                <img src="{{ public_path('assets/img/logo-lg.png') }}" class="img-fluid mt-3" style="height: 100%" alt="Logo">
            </td>
            <td>
                <table class="table-sm" style="width: 40%">
                    <tr>
                        <td style="width: 25%"></td>
                        <td style="width: 5%"></td>
                        <td style="width: 70%"></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-size: 15px; font-weight: bold;">
                            CV. {{ config('app.name') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Laporan</td>
                        <td>:</td>
                        <td>{{ str_replace('-',' ',strtoupper(request()->segment(2))) }}</td>
                    </tr>
                    <tr>
                        <td>Dibuat Pada</td>
                        <td>:</td>
                        <td>{{ date('d F Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <td>Dibuat oleh</td>
                        <td>:</td>
                        <td>{{ request()->session()->get('name') }}</td>
                    </tr>
                </table>
            </td>
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

<main style="margin-top: 40px">
    <table class="table" style="width: 100%">
        <thead>
        <tr>
            <th style="text-align: center">SAMSAT</th>
            <th style="text-align: center">DEALER</th>
            <th style="text-align: center">BELUM BBN</th>
            <th style="text-align: center">SUDAH BBN</th>
            <th style="text-align: center">TOTAL BBN</th>
        </tr>
        </thead>
        <tbody>
        @php
        $belumBBN = 0;
        $sudahBBN = 0;
        $total = 0;
        @endphp
        @foreach($data as $t)
            <tr>
                <td>{{ $t->samsat }}</td>
                <td>{{ $t->dealer }}</td>
                <td class="text-center">{{ $t->belum_bbn }}</td>
                <td class="text-center">{{ $t->sudah_bbn }}</td>
                <td class="text-center">{{ $t->total }}</td>
            </tr>
            {{ $belumBBN += $t->belum_bbn }}
            {{ $sudahBBN += $t->sudah_bbn }}
            {{ $total += $t->total }}
        @endforeach
        <tr class="color-gray">
            <th class="text-center" colspan="2">TOTAL</th>
            <th class="text-center">{{ $belumBBN }}</th>
            <th class="text-center">{{ $sudahBBN }}</th>
            <th class="text-center">{{ $total }}</th>
        </tr>
        </tbody>

    </table>
</main>


</body>
</html>