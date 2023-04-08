<?php

namespace App\Http\Controllers\Arsip;

use Exception;
use App\Models\MailIn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ReportInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('pages.arsip.report.in');
    }

    public function data(Request $request)
    {
        return DataTables::of(MailIn::filter(request(['start', 'end']))->latest()->get()->load(['category']))->make(true);
    }   
}
