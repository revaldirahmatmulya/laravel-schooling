<?php

namespace App\Http\Controllers\Finance;

use App\Enums\ProcurementStatus;
use App\Http\Controllers\Controller;
use App\Models\Procurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SubmissionController extends Controller
{
    public function indexProcurement(){
        return view('pages.finance.procurement.index');
    }

    public function dataProcurement(){
        return DataTables::of(Procurement::orderBy('created_at', 'desc')->get()->load('item')->append('tanggal'))
        ->make(true);
    }

    public function showProcurement(Procurement $procurement){
        return view('pages.finance.procurement.show',['procurement' => $procurement->load(['supplier', 'item','item.category'])]);
    }

    public function rejectDetail(Procurement $procurement){
        return view('pages.finance.procurement.reject',['procurement' => $procurement]);
    }

    public function approveProcurement(Procurement $procurement){
        $update = $procurement->update([
            'status' => ProcurementStatus::Approved
        ]);

        if ($update) {
            $response = array(
                'status' => 'success',
                'message' => 'Pengadaan Barang berhasil disetujui',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Pengadaan Barang tidak berhasil disetujui!',
            );
        }  

        echo json_encode($response);

    }

    public function rejectProcurement(Request $request, Procurement $procurement){

        Validator::make(
            data: $request->all(),
            rules: [
                'reason' => ['required'],
            ],
            customAttributes: [
                'reason' => __('attributes.reason'),
            ]
        )->validate();

        $update = $procurement->update([
            'status' => ProcurementStatus::Rejected,
            'reason' => $request->reason
        ]);

        if ($update) {
            Alert::toast('Pengadaan Barang berhasil ditolak', 'success');
        }else{
            Alert::toast('Pengadaan Barang tidak berhasil ditolak', 'error');
        }

        return redirect()->route('finance.procurement.index');

       
    }

    public function resetProcurement(Request $request, Procurement $procurement){
            
            $update = $procurement->update([
                'status' => ProcurementStatus::Pending,
                'reason' => null
            ]);
    
            if ($update) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Pengadaan Barang berhasil direset',
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Pengadaan Barang tidak berhasil direset!',
                );
            }  
    
            echo json_encode($response);
    }
}
