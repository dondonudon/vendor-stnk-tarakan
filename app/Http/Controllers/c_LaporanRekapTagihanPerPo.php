<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PDF;

class c_LaporanRekapTagihanPerPo extends Controller
{
    public function index() {
        return view('dashboard.report.rekap-tagihan-per-po.index');
    }

    public function po(Request $request) {
        if (isset($_GET['search'])) {
            $po['results'] = DB::table('po_mst')
                ->select(
                    'no_po as id',
                    DB::raw('CONCAT(DATE_FORMAT(tgl_po,"%d-%m-%Y")," - ",no_po) as text')
                )
                ->where('no_po','like','%'.$_GET['search'].'%')
                ->orderBy('tgl_po','desc')
                ->get();
            return $po;
        } else {
            $po['results'] = DB::table('po_mst')
                ->select(
                    'no_po as id',
                    DB::raw('CONCAT(DATE_FORMAT(tgl_po,"%d-%m-%Y")," - ",no_po) as text')
                )
                ->orderBy('tgl_po','desc')
                ->get();
            return $po;
        }
    }

    public function data($noPO) {
        return DB::table('po_trns')
            ->select(
                'ms_dealer.nama as dealer', 'po_mst.no_po',
                'users.name as berkas',
                DB::raw('CONCAT(wilayah_provinsi.name," - ",wilayah_kota.name) as wilayah'),
                'po_mst.tgl_po as tanggal',
                'po_trns.nama_stnk','po_trns.no_pol','po_trns.kode_kendaraan','po_trns.no_mesin',
                'po_trns.harga_notice_bbn','po_trns.pnbp','po_trns.harga_jasa','po_trns.pph',
                DB::raw('((po_trns.harga_notice_bbn+po_trns.pnbp+po_trns.harga_jasa)-po_trns.pph) as subtotal')
            )
            ->join('po_mst','po_trns.no_po','=','po_mst.no_po')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->where([
                ['po_mst.no_po','=',$noPO],
            ])
            ->orderBy('dealer','asc')
            ->get();
    }

    public function list(Request $request) {
        $noPO = $request->no_po;

        return $this->data($noPO);
    }

    public function exportExcel($dealer) {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1','CV. '.config('app.name'));
            $sheet->mergeCells('A1:G1');

            $sheet->fromArray(['NAMA STNK','NO POLISI','TYPE','NOMOR MESIN','HARGA NOTICE','PNBP','JASA','PPN','SUBTOTAL'],'','A3');

            $trn = $this->data($dealer);
            $notice=0; $pnbp=0; $jasa=0; $pph=0; $total=0; $i = 4;
            foreach ($trn as $t) {
                $sheet->fromArray([
                    $t->nama_stnk,
                    $t->no_pol,
                    $t->kode_kendaraan,
                    $t->no_mesin,
                    $t->harga_notice_bbn,
                    $t->pnbp,
                    $t->harga_jasa,
                    $t->pph,
                    $t->subtotal,
                ],'','A'.$i);
                $notice += $t->harga_notice_bbn;
                $pnbp += $t->pnbp;
                $jasa += $t->harga_jasa;
                $pph += $t->pph;
                $total += $t->subtotal;
                $i++;
            }
            $sheet->setCellValue('A'.$i,'TOTAL');
            $sheet->setCellValue('E'.$i,$notice);
            $sheet->setCellValue('F'.$i,$pnbp);
            $sheet->setCellValue('G'.$i,$jasa);
            $sheet->setCellValue('H'.$i,$pph);
            $sheet->setCellValue('I'.$i,$total);
            $sheet->mergeCells('A'.$i.':D'.$i);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            $sheet->getColumnDimension('I')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            $response =  new StreamedResponse(
                function () use ($writer) {
                    $writer->save('php://output');
                }
            );
            $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            $response->headers->set('Content-Disposition', 'attachment;filename="Export-laporan_rekap_tagihan_per_po.xlsx"');
            $response->headers->set('Cache-Control','max-age=0');
            return $response;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function exportPDF($dealer) {
        $trn['data'] = $this->data($dealer);
        $trn['company'] = DB::table('sys_profile')->get()->keyBy('name');
        try {
            $pdf = PDF::loadView('dashboard.report.rekap-tagihan-per-po.pdf',$trn)->setPaper('a4','landscape');
            return $pdf->stream('report-rekap-tagihan-per-po.pdf');
        } catch (\Exception $ex) {
            return response()->json([$ex]);
        }
    }
}
