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
            margin: 0cm 0cm;
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: left;
            line-height: 1.5cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1.5cm;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 0.5cm;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td, .table th {
            border: 1px solid #dddddd;
            /*text-align: left;*/
            padding: 8px;
        }

        .text-center {
            text-align: center;
        }

        .color-gray {
            background-color: #e4e4e4;
        }
    </style>
</head>
<body>
<header>
    <div style="margin: 0.5cm">
        <table style="width: 100%">
            <tr>
                <td>
                    <img src="{{ public_path('assets/img/logo-lg.png') }}" class="img-fluid mt-3" style="height: 70%" alt="Logo">
                </td>
                <td style="text-align: right; font-size: 20px; font-weight: bold">
                    LAPORAN NOTICE BBN PER SAMSAT
                </td>
            </tr>
        </table>
    </div>
</header>

<footer style="font-size: 15px">
    <table style="width: 100%; margin: 10px">
        <tr>
            <td style="text-align: left">
                &copy; <?php echo date("Y");?> {{ config('app.name') }}
            </td>
            <td style="text-align: right">
                <small>
                    DATE CREATED:
                    {{ date('d F Y H:i:s') }}
                </small>
            </td>
        </tr>
    </table>
</footer>

<main style="margin-top: 40px">
    <table class="table" style="width: 100%">
        <thead>
        <tr>
            <th>SAMSAT</th>
            <th>DEALER</th>
            <th>BELUM BBN</th>
            <th>SUDAH BBN</th>
            <th>TOTAL BBN</th>
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