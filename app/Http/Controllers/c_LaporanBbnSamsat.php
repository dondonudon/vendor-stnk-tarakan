<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
//use Meneses\LaravelMpdf\LaravelMpdf;
//use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class c_LaporanBbnSamsat extends Controller
{
    public function index() {
        return view('dashboard.report.bbn-per-samsat.index');
    }

    public function list() {
        $trn = DB::table('po_trns')
            ->select(
                'ms_samsat.nama as samsat',
                'ms_dealer.nama as dealer',
                DB::raw('SUM(case when po_trns.status_bbn_proses = 1 then 1 else 0 end) as "sudah_bbn"'),
                DB::raw('SUM(case when po_trns.status_bbn_proses = 0 then 1 else 0 end) as "belum_bbn"'),
                DB::raw('COUNT(po_trns.id) as "total"')
            )
            ->join('po_mst','po_trns.no_po','=','po_mst.no_po')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->groupBy('samsat','dealer')
            ->orderBy('samsat','asc')
            ->get();

        return $trn;
    }

    public function exportExcel() {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray(['SAMSAT','DELAER','BELUM BBN','SUDAH BBN','TOTAL'],'','A1');

            $trn = $this->list();
            $belumBBN = 0; $sudahBBN = 0; $total = 0; $i = 2;
            foreach ($trn as $t) {
                $sheet->fromArray([
                    $t->dealer,
                    $t->samsat,
                    $t->belum_bbn,
                    $t->sudah_bbn,
                    $t->total
                ],'','A'.$i);

                $belumBBN += $t->belum_bbn;
                $sudahBBN += $t->sudah_bbn;
                $total += $t->total;
                $i++;
            }
            $sheet->setCellValue('A'.$i,'TOTAL');
            $sheet->setCellValue('C'.$i,$belumBBN);
            $sheet->setCellValue('D'.$i,$sudahBBN);
            $sheet->setCellValue('E'.$i,$total);
            $sheet->mergeCells('A'.$i.':B'.$i);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            $response =  new StreamedResponse(
                function () use ($writer) {
                    $writer->save('php://output');
                }
            );
            $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            $response->headers->set('Content-Disposition', 'attachment;filename="Export-laporan_bbn_per_samsat.xlsx"');
            $response->headers->set('Cache-Control','max-age=0');
            return $response;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function exportPDF() {
        try {
            $trn['data'] = $this->list();

            $pdf = PDF::loadView('dashboard.report.bbn-per-samsat.pdf',$trn);
            return $pdf->stream('report-bbn-per-samsat.pdf');
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
