<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDF;
use Symfony\Component\HttpFoundation\StreamedResponse;

class c_LaporanBbnDealer extends Controller
{
    public function index() {
        return view('dashboard.report.bbn-per-dealer.index');
    }

    public function data($dealer,$status) {
        return DB::table('po_trns')
            ->select(
                'ms_dealer.nama as dealer', 'po_mst.no_po',
                DB::raw('COUNT(po_trns.status_bbn_proses) as total'),
                'users.name as berkas',
                DB::raw('CONCAT(wilayah_provinsi.name," - ",wilayah_kota.name) as wilayah'),
                'po_mst.total as notice', 'po_mst.tgl_po as tanggal'
            )
            ->join('po_mst','po_trns.no_po','=','po_mst.no_po')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->where([
                ['po_trns.status_bbn_proses','=',$status],
                ['po_mst.id_dealer','=',$dealer],
            ])
            ->groupBy('po_mst.no_po','dealer','berkas','wilayah','notice','tanggal')
            ->orderBy('dealer','asc')
            ->get();
    }

    public function list(Request $request) {
        $dealer = $request->dealer;
        $status = $request->status;

        return $this->data($dealer,$status);
    }

    public function exportExcel($dealer,$status) {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1','CV. '.config('app.name'));
            $sheet->mergeCells('A1:G1');

            $sheet->fromArray(['DELAER','NOMOR PO','JUMLAH','BERKAS','WILAYAH','NOTICE','TANGGAL'],'','A3');

            $trn = $this->data($dealer,$status);
            $total = 0; $notice = 0; $i = 4;
            foreach ($trn as $t) {
                $sheet->fromArray([
                    $t->dealer,
                    $t->no_po,
                    $t->total,
                    $t->berkas,
                    $t->wilayah,
                    $t->notice,
                    $t->tanggal,
                ],'','A'.$i);

                $total += $t->total;
                $notice += $t->notice;
                $i++;
            }
            $sheet->setCellValue('A'.$i,'TOTAL');
            $sheet->setCellValue('C'.$i,$total);
            $sheet->setCellValue('F'.$i,$notice);
            $sheet->mergeCells('A'.$i.':B'.$i);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            $response =  new StreamedResponse(
                function () use ($writer) {
                    $writer->save('php://output');
                }
            );
            $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            $response->headers->set('Content-Disposition', 'attachment;filename="Export-laporan_bbn_per_dealer.xlsx"');
            $response->headers->set('Cache-Control','max-age=0');
            return $response;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function exportPDF($dealer,$status) {
        try {
            $trn['data'] = $this->data($dealer,$status);

            $pdf = PDF::loadView('dashboard.report.bbn-per-dealer.pdf',$trn)->setPaper('a4','landscape');
            return $pdf->stream('report-bbn-per-periode.pdf');
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
