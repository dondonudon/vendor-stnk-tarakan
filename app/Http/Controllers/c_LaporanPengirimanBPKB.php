<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PDF;

class c_LaporanPengirimanBPKB extends Controller
{
    public function index() {
        return view('dashboard.report.pengiriman-bpkb.index');
    }

    public function data($start,$end,$dealer) {
        $dataset = DB::table('po_bpkb_dealer')
            ->select(
                'po_trns.nama_stnk', 'po_trns.no_pol','po_trns.no_mesin','ms_dealer.nama as dealer',
                DB::raw('CONCAT(wilayah_provinsi.name," - ",wilayah_kota.name) as wilayah')
            )
            ->join('po_trns','po_bpkb_dealer.id_trn','=','po_trns.id')
            ->join('po_mst','po_bpkb_dealer.no_po','=','po_mst.no_po')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->leftJoin('wilayah_provinsi','ms_dealer.provinsi','=','wilayah_provinsi.id')
            ->leftJoin('wilayah_kota','ms_dealer.kota','=','wilayah_kota.id')
            ->whereBetween('tgl_validasi',[$start,$end]);
        if ($dealer == 'all') {
            return $dataset->orderBy('ms_dealer.nama','asc')->get();
        } else {
            return $dataset->where('po_mst.id_dealer','=',$dealer)
                ->orderBy('ms_dealer.nama','asc')->get();
        }
    }

    public function list(Request $request) {
        $start = $request->start;
        $end = $request->end;
        $dealer = $request->dealer;

        return $this->data($start,$end,$dealer);
    }

    public function exportExcel($start,$end,$dealer) {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        try {
            $trn = $this->data($start,$end,$dealer);
            $dtDealer = array();
            $dtWilayah = array();
            foreach ($trn as $d) {
                if (!in_array($d->dealer,$dtDealer)) {
                    array_push($dtDealer,$d->dealer);
                }
                if (!in_array($d->wilayah,$dtWilayah)) {
                    array_push($dtWilayah,$d->wilayah);
                }
            }

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1','CV. '.config('app.name'));
            $sheet->setCellValue('A2','SERAH TERIMA BPKB '.join(', ',$dtDealer));
            $sheet->setCellValue('A3','WILAYAH '.join(', ',$dtWilayah));
            $sheet->setCellValue('A4','TANGGAL '.date('d F Y',strtotime($start)).' - '.date('d F Y',strtotime($end)));
            $sheet->mergeCells('A1:D1');
            $sheet->mergeCells('A2:D2');
            $sheet->mergeCells('A3:D3');
            $sheet->mergeCells('A4:D4');

            $sheet->fromArray(['NO','NAMA','NOMOR MESIN','NO. PLAT'],'','A6');

            $notice=0; $pnbp=0; $jasa=0; $pph=0; $total=0; $i = 7; $no=1;
            foreach ($trn as $t) {
                $sheet->fromArray([
                    $no,
                    $t->nama_stnk,
                    $t->no_mesin,
                    $t->no_pol,
                ],'','A'.$i);
                $i++;
                $no++;
            }

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getStyle('A6:D'.($i-1))->applyFromArray($styleArray);

            $writer = new Xlsx($spreadsheet);
            $response =  new StreamedResponse(
                function () use ($writer) {
                    $writer->save('php://output');
                }
            );
            $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            $response->headers->set('Content-Disposition', 'attachment;filename="laporan-penerimaan-bpkb-oleh-dealer.xlsx"');
            $response->headers->set('Cache-Control','max-age=0');
            return $response;
        } catch (\Exception $ex) {
//            return response()->json($ex);
            dd($ex);
        }
    }

    public function exportPDF($start,$end,$dealer) {
        $trn = [
            'data' => $this->data($start,$end,$dealer),
            'company' => DB::table('sys_profile')->get()->keyBy('name'),
            'start' => $start,
            'end' => $end,
            'dealer' => [],
            'wilayah' => [],
        ];
        foreach ($trn['data'] as $d) {
            if (!in_array($d->dealer,$trn['dealer'])) {
                array_push($trn['dealer'],$d->dealer);
            }
            if (!in_array($d->wilayah,$trn['wilayah'])) {
                array_push($trn['wilayah'],$d->wilayah);
            }
        }
        try {
            $pdf = PDF::loadView('dashboard.report.pengiriman-bpkb.pdf',$trn)->setPaper('a4','portrait');
            return $pdf->stream('report-pengiriman-bpkb.pdf');
        } catch (\Exception $ex) {
            dd($ex);
        }
    }
}
