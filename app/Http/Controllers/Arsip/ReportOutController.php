<?php

namespace App\Http\Controllers\Arsip;

use Exception;
use App\Models\MailOut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ReportOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('pages.arsip.report.out');
    }

    public function data(Request $request)
    {
        return DataTables::of(MailOut::filter(request(['start', 'end']))->get()->load(['category']))->make(true);
    }    
}
