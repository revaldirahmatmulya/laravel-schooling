<?php

namespace App\Http\Controllers\Sarpras;

use App\Enums\ProcurementStatus;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Procurement;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ProcurementController extends Controller
{
    public function index()
    {
        return view('pages.sarpras.procurement.index');
    }

    public function data()
    {
        return DataTables::of(Procurement::orderBy('created_at', 'desc')->get()->load('item')->append('tanggal'))
            ->make(true);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::all();

        if ($suppliers->count() == 0) {
            Alert::warning('Peringatan', 'Silahkan tambahkan supplier terlebih dahulu');
            return redirect()->route('sarpras.procurement.index');
        }

        if ($items->count() == 0) {
            Alert::warning('Peringatan', 'Silahkan daftarkan barang terlebih dahulu');
            return redirect()->route('sarpras.procurement.index');
        }

        return view(
            'pages.sarpras.procurement.add',
            [
                'suppliers' => $suppliers,
                'items' => $items,
            ]
        );
    }

    public function show(Procurement $procurement)
    {
        if ($procurement->status == ProcurementStatus::Pending) {
            Alert::warning('Peringatan', 'Pengadaan barang belum disetujui');
            return redirect()->route('sarpras.procurement.index');
        }
        return view('pages.sarpras.procurement.show', ['procurement' => $procurement->load(['supplier', 'item', 'item.category'])]);
    }

    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'item' => ['required'],
                'supplier' => ['required'],
                'amount' => ['required', 'numeric'],
                'price' => ['required', 'numeric'],
                'total_price' => ['required', 'numeric'],
            ],
            customAttributes: [
                'item_name' => __('attributes.item'),
                'category' => __('attributes.category'),
                'supplier' => __('attributes.supplier'),
                'item_unit' => __('attributes.unit'),
                'amount' => __('attributes.amount'),
                'price' => __('attributes.price'),
                'total_price' => "Total Harga",
            ],
        )->validate();

        DB::transaction(function () use ($request) {

            $insert = Procurement::create([
                'item_id' => $request->item,
                'supplier_id' => $request->supplier,
                'amount' => $request->amount,
                'price' => $request->price,
                'total_price' => $request->total_price,
                'status' => ProcurementStatus::Pending,
                'description' => $request->description,
            ]);

            if ($insert) {
                Alert::toast('Data berhasil diajukan', 'success');
            } else {
                Alert::toast('Data gagal diajukan', 'error');
            }
        });

        return redirect()->route('sarpras.procurement.index');
    }

    public function edit(Procurement $procurement)
    {
        if ($procurement->status != ProcurementStatus::Pending) {
            Alert::toast('Data sudah tidak dapat diedit', 'error');
            return redirect()->route('sarpras.procurement.index');
        }
        $suppliers = Supplier::all();
        $items = Item::all();

        return view(
            'pages.sarpras.procurement.edit',
            [
                'suppliers' => $suppliers,
                'items' => $items,
                'procurement' => $procurement
            ]
        );
    }

    public function update(Request $request, Procurement $procurement)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'item' => ['required'],
                'supplier' => ['required'],
                'amount' => ['required', 'numeric'],
                'price' => ['required', 'numeric'],
                'total_price' => ['required', 'numeric'],
            ],
            customAttributes: [
                'item' => __('attributes.item'),
                'supplier' => __('attributes.supplier'),
                'amount' => __('attributes.amount'),
                'price' => __('attributes.price'),
                'total_price' => "Total Harga",
            ],
        )->validate();


        $update = $procurement->update([
            'item_id' => $request->item,
            'supplier_id' => $request->supplier,
            'amount' => $request->amount,
            'price' => $request->price,
            'total_price' => $request->total_price,
            'description' => $request->description,
        ]);

        if ($update) {
            Alert::toast('Data berhasil diajukan', 'success');
        } else {
            Alert::toast('Data gagal diajukan', 'error');
        }

        return redirect()->route('sarpras.procurement.index');
    }

    public function destroy(Procurement $procurement)
    {
        $delete = $procurement->delete();

        if ($delete) {
            $response = array(
                'status' => 'success',
                'message' => 'Pengadaan Barang berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Pengadaan Barang tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }

    public function receipt(Request $request, Procurement $procurement)
    {
        $validator = Validator::make(
            data: request()->all(),
            rules: [
                'receipt' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            ],
            customAttributes: [
                'receipt' => __('attributes.receipt'),
            ],
        );

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back();
        }

        if ($request->hasFile('receipt')) {
            if ($procurement->receipt) {
                Storage::delete($procurement->receipt);
            }
            $receipt = Storage::put('public/procurement/receipt', $request->file('receipt'));
            $update = $procurement->update(['receipt' => $receipt]);
            if ($update) {
                Alert::success('Success', 'Bukti berhasil diunggah');
            } else {
                Alert::error('Error', 'Bukti gagal diunggah');
            }
            return redirect()->route('sarpras.procurement.detail', $procurement->id);
        }

        Alert::error('Error', 'Bukti gagal diunggah');
    }

    public function complete(Procurement $procurement)
    {
        DB::transaction(function () use ($procurement) {
            $update = $procurement->update(['status' => ProcurementStatus::Completed]);

            Item::where('id', $procurement->item_id)->increment('amount', $procurement->amount);

            if ($update) {
                Alert::success('Success', 'Pengadaan berhasil diselesaikan');
            } else {
                Alert::error('Error', 'Pengadaan gagal diselesaikan');
            }
        });
        return redirect()->route('sarpras.procurement.detail', $procurement->id);
    }
}
