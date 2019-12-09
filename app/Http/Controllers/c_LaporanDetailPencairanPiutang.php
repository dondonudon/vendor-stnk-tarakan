<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PDF;

class c_LaporanDetailPencairanPiutang extends Controller
{
    public function index() {
        return view('dashboard.report.detail-pencairan-piutang.index');
    }

    public function data($start,$end) {
        return DB::table('po_mst')
            ->select(
                'tgl_po','ms_dealer.nama',
                DB::raw('CONCAT(wilayah_provinsi.name," - ",wilayah_kota.name) AS daerah'),
                DB::raw('COUNT(po_trns.no_po) as jumlah'),
                'total as notice','po_mst.no_po',
                DB::raw('( total + ( SUM(po_trns.pnbp) + ( ( SUM(po_trns.harga_jasa) * COUNT(po_trns.no_po) ) - ( SUM(po_trns.harga_jasa)*2/100 ) ))) AS pencairan'),
                DB::raw('"" as tgl_tagihan'), DB::raw('"" as serah_stnk'), DB::raw('"" as tgl_proses_cabang')
            )
            ->join('po_trns','po_mst.no_po','=','po_trns.no_po')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->whereBetween('tgl_po',[$start,$end])
            ->orderBy('tgl_po','asc')
            ->groupBy('po_mst.no_po','tgl_po','ms_dealer.nama','wilayah_provinsi.name','wilayah_kota.name','po_mst.total')
            ->get();
    }

    public function list(Request $request) {
        $start = $request->start;
        $end = $request->end;

        return $this->data($start,$end);
    }

    public function exportExcel($start,$end) {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1','CV. '.config('app.name'));
            $sheet->mergeCells('A1:L1');

            $sheet->fromArray(
                ['TGL PO','NAMA','DAERAH','JUMLAH','NOTICE','NO PO','PENCAIRAN','TGL TAGIHAN','SERAH STNK','TGL PROSES CABANG'],
                '',
                'A3'
            );

            $trn = $this->data($start,$end);
            $pencairan=0; $i = 4;
            foreach ($trn as $t) {
                $sheet->fromArray([
                    $t->tgl_po,
                    $t->nama,
                    $t->daerah,
                    $t->jumlah,
                    $t->notice,
                    $t->no_po,
                    $t->pencairan,
                    $t->tgl_tagihan,
                    $t->serah_stnk,
                    $t->tgl_proses_cabang,
                ],'','A'.$i);
                $pencairan += $t->pencairan;
                $i++;
            }
            $sheet->setCellValue('A'.$i,'TOTAL');
            $sheet->setCellValue('G'.$i,$pencairan);
            $sheet->mergeCells('A'.$i.':F'.$i);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            $sheet->getColumnDimension('I')->setAutoSize(true);
            $sheet->getColumnDimension('J')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            $response =  new StreamedResponse(
                function () use ($writer) {
                    $writer->save('php://output');
                }
            );
            $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            $response->headers->set('Content-Disposition', 'attachment;filename="Export-laporan_detail_pencairan_piutang.xlsx"');
            $response->headers->set('Cache-Control','max-age=0');
            return $response;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function exportPDF($start,$end) {
        try {
            $trn['data'] = $this->data($start,$end);
            $pdf = PDF::loadView('dashboard.report.detail-pencairan-piutang.pdf',$trn)->setPaper('a4','landscape');
            return $pdf->stream('report-rekap-tagihan-per-po.pdf');
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
