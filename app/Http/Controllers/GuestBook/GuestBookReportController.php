<?php

namespace App\Http\Controllers\GuestBook;

use Exception;
use App\Models\GuestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GuestBookReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.bukutamu.report.index');
    }

    public function data(Request $request)
    {
        return DataTables::of(GuestBook::filter(request(['start', 'end']))->get()->append('tanggal'))->make(true);
    }

    public function ExportExcel($customer_data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($customer_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Laporan Buku Tamu.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }


    public function export($start= null, $end=null){
        // return [$start, $end];
        $filter = [
            'start' => $start == 'null' ? null : $start,
            'end' => $end == 'null' ? null : $end,
        ];
        // return $filter;
        // return GuestBook::filter($filter)->get()->append('tanggal');
        $data = GuestBook::filter($filter)->get()->append('tanggal');
        // return $data->count();
        if ($data->count() > 0) {
            $data_array [] = array("Nama","Email","Telepon","Instansi","Keperluan","Tanggal");
            foreach($data as $data_item)
            {
                $data_array[] = array(
                    'Nama' =>$data_item->name,
                    'Email' => $data_item->email,
                    'Telepon' => $data_item->phone,
                    'Instansi' => $data_item->instance,
                    'Keperluan' => $data_item->necessary,
                    'Tanggal' =>$data_item->tanggal
                );
            }
            $this->ExportExcel($data_array);
        }else{
            echo "<script>window.close();</script>";
        }
    }

    
}
